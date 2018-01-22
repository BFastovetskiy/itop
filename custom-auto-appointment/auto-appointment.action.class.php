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
		// Object type checking
		$sClassName = $aContextArgs['this->object()']->Get('finalclass');
		if ($sClassName != 'UserRequest' and $sClassName != 'Incident') return;

        if (!class_exists('UserRequest'))
        {
            throw new Exception('Не возможно создать экземпляр класса "'.$sClassName.'"');
            return;
        }
        else if (!class_exists('Incident'))
        {
            throw new Exception('Не возможно создать экземпляр класса "'.$sClassName.'"');
            return;
        }

		// Get Ticket, Service and Subcategory
		$oTicket = $aContextArgs['this->object()'];
		$iTicketId = $oTicket->GetKey();
		$iServiceId = $oTicket->Get('service_id');
		$iSubServiceId = $oTicket->Get('servicesubcategory_id');
		$sTicketStatus = $oTicket->Get('status');

		// The search a approval rule
		if (class_exists('ApprovalRule'))
		{
        $oSearch = DBObjectSearch::FromOQL("SELECT ServiceSubcategory AS ss WHERE ss.id = ($iSubServiceId) AND ss.approvalrule_id != 0");
        $oSet = new DBObjectSet($oSearch);
        $iCountApprovalRule = $oSet->Count();

		if ((($iCountApprovalRule != 0) && ($sTicketStatus == 'new')) ||
			(($iCountApprovalRule != 0) && ($sTicketStatus == 'rejected'))) return;
		}

		// The search a team of executors
		$oSearch = DBObjectSearch::FromOQL("SELECT AutoAppointmentRule AS r WHERE r.subservice_id = ($iSubServiceId) AND service_id = ($iServiceId)");
		$oSet = new DBObjectSet($oSearch);
		$iCount = $oSet->Count();
		if ($iCount == 0) return;
		$bResult = false;
		for ($i = 0;  $i < $iCount; $i++)
		{
			$oTemplateRule = $oSet->Fetch();
			$iTeamId = $oTemplateRule->Get('team_id');
            $sFilter = $oTemplateRule->Get('filter');

			if (!empty($sFilter))
			{
			$oSearch = DBObjectSearch::FromOQL("SELECT TemplateExtraData WHERE obj_key = ($iTicketId)");
			$oSet2 = new DBObjectSet($oSearch);
			$oExtraData = $oSet2->Fetch();
			$aRawData = unserialize($oExtraData->Get('data'));
			$aKeys = explode(";", $sFilter);

			foreach ($aKeys as $aKey)
			{
				$sKey = explode(":", $aKey)[0];
				$sValue = explode(":", $aKey)[1];
				$bResult = ($aRawData['user_data'][$sKey] == $sValue);
			}

			if ($bResult) break;
			}
		}

		// The search a executors
		$oSearch = DBObjectSearch::FromOQL("SELECT Person AS p JOIN lnkPersonToTeam AS l ON l.person_id = p.id WHERE l.team_id=$iTeamId");
		$oSet = new DBObjectSet($oSearch);
		if ($oSet->Count() == 0) return;

		$iAgentId = 0;
		$iMin = self::FIRST_MIN_VALUE;
		while ($oPerson = $oSet->Fetch())
		{
			$iPersonId = $oPerson->GetKey();
			$oUserSearch = DBObjectSearch::FromOQL("SELECT $sClassName AS ur WHERE ur.agent_id = ($iPersonId) AND (ur.status != 'closed' AND ur.status != 'resolved')");
			$oUserSet = new DBObjectSet($oUserSearch);
			if ($oUserSet->Count() < $iMin)
			{
				$iMin = $oUserSet->Count();
				$iAgentId = $oPerson->GetKey();
			}
		}

		// update ticket 
		$sOQL = 'SELECT '.$sClassName.' WHERE id = :id';
		$oSearch = DBObjectSearch::FromOQL($sOQL);
		$oSet = new DBObjectSet($oSearch, array(), array('id' => $iTicketId));
		$oTicket = $oSet->fetch();
		$oTicket->Set('agent_id', $iAgentId);
		$oTicket->Set('team_id', $iTeamId);
		$oTicket->DBUpdate();
		$oTicket->ApplyStimulus('ev_assign');


		if (MetaModel::IsLogEnabledNotification())
		{
			$oLog = new EventNotificationAutoAppointment();
			if ($this->IsBeingTested())
				$oLog->Set('message', 'Тестирование');
			else
				$oLog->Set('message', 'Назначен исполнитель по '.$sClassName);
			$oLog->Set('userinfo', UserRights::GetUser());
			$oLog->Set('trigger_id', $oTrigger->GetKey());
			$oLog->Set('action_id', $this->GetKey());
			$oLog->Set('object_id', $aContextArgs['this->object()']->GetKey());
			$oLog->Set('agent_id', $iAgentId);
			$oLog->Set('servicesubcategory_id', $iSubServiceId);
			$oLog->DBInsertNoReload();
		}
		else
			$oLog = null;
		if ($oLog)
			$oLog->DBUpdate();
	}
}
?>
