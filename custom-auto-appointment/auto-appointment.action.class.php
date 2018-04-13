<?php

require_once(APPROOT.'/core/asynctask.class.inc.php');

class AutoAppointment extends ActionNotification
{
	const FIRST_MIN_VALUE = 999999999999;

	public static function Init()
	{
		$aParams = array
		(
			"category" => "core/cmdb,application",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array('name'),
			"db_table" => "priv_action_auto_appointment",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		// Display lists
		MetaModel::Init_SetZListItems('details', array('name', 'description', 'status', 'trigger_list'));
		MetaModel::Init_SetZListItems('list', array('name', 'status'));
		// Search criteria
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status'));
	}

	public function DoExecute($oTrigger, $aContextArgs)
	{
		// Получение типа класса
		$sClassName = $aContextArgs['this->object()']->Get('finalclass');

        // проверяем на соответствие типов
        if ($sClassName != 'UserRequest' and $sClassName != 'Incident') return;

        // проверка существования классов
        if (!class_exists('UserRequest'))
        {
            throw new Exception('Could not create a ticket after the service of type '.$sClassName.': unknown class "UserRequest"');
        }
        else if (!class_exists('Incident'))
        {
            throw new Exception('Could not create a ticket after the service of type '.$sClassName.': unknown class "Incident"');
        }

        // Получение ID тикета, услугии, подкатегории услуги
		$iTicketId = $aContextArgs['this->object()']->GetKey();
		$iServiceId = $aContextArgs['this->object()']->Get('service_id');
		$iSubServiceId = $aContextArgs['this->object()']->Get('servicesubcategory_id');

		// The search a team of executors
		$oSet = new DBObjectSet(DBObjectSearch::FromOQL('SELECT AutoAppointmentRule AS r WHERE r.subservice_id = ('.$iSubServiceId.') AND service_id = ('.$iServiceId.')'));
		$iCount = $oSet->Count();
		if ($iCount == 0) return;
		$bResult = false;
        $iTeamLeaderId = null;
		for ($i = 0;  $i < $iCount; $i++)
		{
			$oTemplateRule = $oSet->Fetch();
			$iTeamId = $oTemplateRule->Get('team_id');
            $sFilter = $oTemplateRule->Get('filter');
            $iTeamLeaderId = $this->GetLeaderTeam($iTeamId);
            
            if (!empty($sFilter)) {
                $bResult = $this->CheckFilter($sFilter, $iTicketId);
                if ($bResult) break;
			}
		}

		// The search a executors
		$oSearch = DBObjectSearch::FromOQL("SELECT Person AS p JOIN lnkPersonToTeam AS l ON l.person_id = p.id WHERE l.role_name != 'Team leader' AND l.team_id=($iTeamId)");
		$oSet = new DBObjectSet($oSearch);
		if ($oSet->Count() == 0) return;

		$iAgentId = 0;
		$iMin = self::FIRST_MIN_VALUE;

		/*
         * var Person $oPerson
         */
		while ($oPerson = $oSet->Fetch())
		{
			if (!$oPerson->CheckCompatibleDate(date("Y-m-d H:i:s"))) continue;
			$iPersonId = $oPerson->GetKey();
			$oUserSearch = DBObjectSearch::FromOQL("SELECT Ticket AS t WHERE t.agent_id = ($iPersonId) AND (t.operational_status != 'closed' OR t.operational_status != 'resolved') ");
			$oUserSet = new DBObjectSet($oUserSearch);
			if ($oUserSet->Count() < $iMin)
			{
				$iMin = $oUserSet->Count();
				$iAgentId = $oPerson->GetKey();
			}
		}

		if ($iAgentId == 0)
			$iAgentId = $iTeamLeaderId;

		// update ticket
		$sOQL = 'SELECT '.$sClassName.' WHERE id = :id';
		$oSearch = DBObjectSearch::FromOQL($sOQL);
		$oSet = new DBObjectSet($oSearch, array(), array('id' => $iTicketId));
		$oTicket = $oSet->fetch();
		$oTicket->Set('agent_id', $iAgentId);
		$oTicket->Set('team_id', $iTeamId);
		$oTicket->ApplyStimulus('ev_assign');
        $oTicket->DBUpdate();

		if (MetaModel::IsLogEnabledNotification())
		{
			$oLog = new EventNotificationAutoAppointment();
			if ($this->IsBeingTested())
				$oLog->Set('message', 'Тестирование');
			else
				$oLog->Set('message', 'Исполнитель назначен');
			$oLog->Set('userinfo', UserRights::GetUser());
			$oLog->Set('trigger_id', $oTrigger->GetKey());
			$oLog->Set('action_id', $this->GetKey());
			$oLog->Set('object_id', $aContextArgs['this->object()']->GetKey());
			$oLog->Set('agent_id', $iAgentId);
			$oLog->Set('servicesubcategory_id', $iSubServiceId);
			$oLog->DBInsert();
		}
	}

    /**
     * Summary of GetTeamLeader
     * @param integer $iTeamId
     * @return integer
     */
    private function GetLeaderTeam($iTeamId) {
        $iTeamLeaderId = 0;
        $oSetTeamLeader = new DBObjectSet(DBObjectSearch::FromOQL("SELECT lnkPersonToTeam AS t WHERE t.role_name = 'Team leader' AND t.team_id=(".$iTeamId.")"));
        if ($oSetTeamLeader->Count() > 0) {
            $iTeamLeaderId  = $oSetTeamLeader->Fetch()->Get('person_id');
        }
        return $iTeamLeaderId;
    }

    private function CheckFilter($sFilter, $iTicketId) {
        $bResult = false;
        $oSet = new DBObjectSet(DBObjectSearch::FromOQL('SELECT TemplateExtraData WHERE obj_key = ('.$iTicketId.')'));
        $iCount = $oSet->Count();
        if ($iCount === 0) return $bResult;

        $oExtraData = $oSet->Fetch();
        $aRawData = unserialize($oExtraData->Get('data'));
        $aKeys = explode(";", $sFilter);

        foreach ($aKeys as $aKey) {
            $sKey = explode(":", $aKey)[0];
            $sValue = explode(":", $aKey)[1];
            $bResult = ($aRawData['user_data'][$sKey] == $sValue);
        }

        return $bResult;
    }
}
?>
