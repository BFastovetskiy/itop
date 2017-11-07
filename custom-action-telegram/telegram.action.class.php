<?php

require_once(APPROOT.'/core/asynctask.class.inc.php');

class ActionTelegram extends ActionNotification
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "core/cmdb,application",
			"key_type" => "autoincrement",
			"name_attcode" => "name",
			"state_attcode" => "",
			"reconc_keys" => array('name'),
			"db_table" => "priv_action_telegram",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();

		MetaModel::Init_AddAttribute(new AttributeString("bot_id", array("allowed_values"=>null, "sql"=>"bot_id", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("chat_id", array("allowed_values"=>null, "sql"=>"chat_id", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeTemplateString("subject", array("allowed_values"=>null, "sql"=>"subject", "default_value"=>null, "is_null_allowed"=>false, "depends_on"=>array())));

		// Display lists
		MetaModel::Init_SetZListItems('details', array('name', 'description', 'status', 'bot_id', 'chat_id', 'subject', 'trigger_list'));
		MetaModel::Init_SetZListItems('list', array('name', 'status', 'bot_id', 'chat_id'));
		// Search criteria
		MetaModel::Init_SetZListItems('standard_search', array('name', 'status'));
	}

	public function DoExecute($oTrigger, $aContextArgs)
	{
		if (MetaModel::IsLogEnabledNotification())
		{
			$oLog = new EventNotificationTelegram();
			if ($this->IsBeingTested())
			{
				$oLog->Set('message', 'TEST - Notification sent ('.$this->Get('chat_id').')');
			}
			else
			{
				$oLog->Set('message', 'Notification pending');
			}
			$oLog->Set('userinfo', UserRights::GetUser());
			$oLog->Set('trigger_id', $oTrigger->GetKey());
			$oLog->Set('action_id', $this->GetKey());
			$oLog->Set('object_id', $aContextArgs['this->object()']->GetKey());
			$oLog->DBInsertNoReload();
		}
		else
		{
			$oLog = null;
		}

		try
		{
			$sRes = $this->_DoExecute($oTrigger, $aContextArgs, $oLog);
			if ($this->IsBeingTested())
			{
				$sPrefix = 'TEST ('.$this->Get('chat_id').') - ';
			}
			else
			{
				$sPrefix = '';
			}
			if ($oLog)
			{
				$oLog->Set('message', $sPrefix . $sRes);
			}
		}
		catch (Exception $e)
		{
			if ($oLog)
			{
				$oLog->Set('message', 'Error: '.$e->getMessage());
			}
		}
		if ($oLog)
		{
			$oLog->DBUpdate();
		}
	}

	protected function _DoExecute($oTrigger, $aContextArgs, &$oLog)
	{
		$sPreviousUrlMaker = ApplicationContext::SetUrlMakerClass();
		try
		{
			$botId   = MetaModel::ApplyParams($this->Get('bot_id'), $aContextArgs);
			$chatid  = MetaModel::ApplyParams($this->Get('chat_id'), $aContextArgs);
			$subject = MetaModel::ApplyParams($this->Get('subject'), $aContextArgs);
		}
		catch(Exception $e)
		{
  			ApplicationContext::SetUrlMakerClass($sPreviousUrlMaker);
  			throw $e;
  		}
		ApplicationContext::SetUrlMakerClass($sPreviousUrlMaker);
		
		if (!is_null($oLog))
		{
			if (isset($botId))    $oLog->Set('bot_id', $botId);
			if (isset($chatid))   $oLog->Set('chat_id', $chatid);
			if (isset($subject))  $oLog->Set('message', $subject);
		}

		try
		{
			$m_message = urlencode($subject);
			$url = "https://api.telegram.org/bot".$botId."/sendMessage?chat_id=".$chatid."&text=".$m_message;

			$ch = curl_init();
			$optArray = array(
					CURLOPT_URL => $url,
					CURLOPT_HEADER => false,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_SSL_VERIFYPEER => false
			);
			curl_setopt_array($ch, $optArray);
			$result = curl_exec($ch);
			curl_close($ch);

			return 'Notification sent result '.$result;
		}
		catch (Exception $e)
		{
			return 'Notification was not sent: '.$e;
		}
	}
}
?>
