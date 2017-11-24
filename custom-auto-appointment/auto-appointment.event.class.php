<?php

class EventNotificationAutoAppointment extends EventNotification
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
			"db_table" => "priv_event_auto_appointment",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
			"order_by_default" => array('date' => false)
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		MetaModel::Init_AddAttribute(new AttributeExternalKey("agent_id", array("targetclass"=>'Person', "allowed_values"=>null, "sql"=>'agent_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));
		MetaModel::Init_AddAttribute(new AttributeExternalKey("servicesubcategory_id", array("targetclass"=>'ServiceSubcategory', "allowed_values"=>null, "sql"=>'servicesubcategory_id', "is_null_allowed"=>false, "on_target_delete"=>DEL_AUTO, "depends_on"=>array(), "display_style"=>'select', "always_load_in_tables"=>false)));

		// Display lists
		MetaModel::Init_SetZListItems('details', array('date', 'userinfo', 'message', 'trigger_id', 'action_id', 'object_id', 'agent_id', 'servicesubcategory_id'));
		MetaModel::Init_SetZListItems('list', array('date', 'message', 'agent_id', 'servicesubcategory_id'));

		// Search criteria
		//MetaModel::Init_SetZListItems('standard_search', array('name')); // Criteria of the std search form
		//MetaModel::Init_SetZListItems('advanced_search', array('name')); // Criteria of the advanced search form
	}

}
?>