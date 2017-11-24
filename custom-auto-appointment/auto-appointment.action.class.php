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
		$class = $aContextArgs['this->object()']->Get('finalclass');
		if ($class != 'UserRequest' and $class != 'Incident') return;

		// Get Ticket, Service and Subcategory
		$ticketId = $aContextArgs['this->object()']->GetKey();
		$serviceId = $aContextArgs['this->object()']->Get('service_id');
		$subServiceId = $aContextArgs['this->object()']->Get('servicesubcategory_id');
		
		// The search a team of executors
		$oSearch = DBObjectSearch::FromOQL("SELECT AutoAppointmentRule AS r WHERE r.subservice_id = ($subServiceId) AND service_id = ($serviceId)");
		$oSet = new DBObjectSet($oSearch);
		if ($oSet->Count() == 0) return;
		$teamId = $oSet->Fetch()->Get('team_id');

		// The searc a executors
		$oSearch = DBObjectSearch::FromOQL("SELECT Person AS p JOIN lnkPersonToTeam AS l ON l.person_id = p.id WHERE l.team_id=$teamId");
		$oSet = new DBObjectSet($oSearch);
		if ($oSet->Count() == 0) return;
		
		$agentId = 0;
		$min = self::FIRST_MIN_VALUE;
		while ($oPerson = $oSet->Fetch())
		{
			$uRequest = DBObjectSearch::FromOQL("SELECT UserRequest AS ur WHERE ur.agent_id = ($oPerson->GetKey()) AND (ur.status != 'closed' OR ur.status != 'resolved') ");
			$uSet = new DBObjectSet($uRequest);
			if ($uSet->Count() < $min)
			{
				$min = $uSet->Count();
				$agentId = $oPerson->GetKey();
			}
		}

		// update ticket 
		$oql = 'SELECT '.$class.' WHERE id = :id';
		$oSearch = DBObjectSearch::FromOQL($oql);
		$oSet = new DBObjectSet($oSearch, array(), array('id' => $ticketId));
		$ticket = $oSet->fetch();
		$ticket->Set('agent_id', $agentId);
		$ticket->Set('team_id', $teamId);
		$ticket->Set('status', 'assigned');
		$ticket->DBUpdate();

		if (MetaModel::IsLogEnabledNotification())
		{
			$oLog = new EventNotificationAutoAppointment();
			if ($this->IsBeingTested())
			{
				$oLog->Set('message', 'Тестирование');
			}
			else
			{
				$oLog->Set('message', 'Исполнитель назначен');
			}
			$oLog->Set('userinfo', UserRights::GetUser());
			$oLog->Set('trigger_id', $oTrigger->GetKey());
			$oLog->Set('action_id', $this->GetKey());
			$oLog->Set('object_id', $aContextArgs['this->object()']->GetKey());
			$oLog->Set('agent_id', $agentId);
			$oLog->Set('servicesubcategory_id', $subServiceId);
			$oLog->DBInsertNoReload();
		}
		else
		{
			$oLog = null;
		}
		if ($oLog)
		{
			$oLog->DBUpdate();
		}
	}
}
?>
