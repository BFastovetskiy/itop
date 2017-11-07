<?php

class EventNotificationTelegram extends EventNotification
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "core/cmdb,view_in_gui",
			"key_type" => "autoincrement",
			"name_attcode" => "",
			"state_attcode" => "",
			"reconc_keys" => array(),
			"db_table" => "priv_event_telegram",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
			"order_by_default" => array('date' => false)
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeString("bot_id", array("allowed_values"=>null, "sql"=>"bot_id", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeString("chat_id", array("allowed_values"=>null, "sql"=>"chat_id", "default_value"=>null, "is_null_allowed"=>true, "depends_on"=>array())));

		// Display lists
		MetaModel::Init_SetZListItems('details', array('date', 'userinfo', 'message', 'trigger_id', 'action_id', 'object_id', 'bot_id', 'chat_id'));
		MetaModel::Init_SetZListItems('list', array('date', 'message', 'bot_id', 'chat_id'));

		// Search criteria
		//MetaModel::Init_SetZListItems('standard_search', array('name')); // Criteria of the std search form
		//MetaModel::Init_SetZListItems('advanced_search', array('name')); // Criteria of the advanced search form
	}

}
?>