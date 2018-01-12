<?php
class AddMenuSampleExtension implements iPopupMenuExtension
{
	public static function EnumItems($menu_id, $param)
	{
		$result = array();
		
		switch($menu_id)
		{
			case iPopupMenuExtension::MENU_OBJLIST_ACTIONS:
			break;
			
			case iPopupMenuExtension::MENU_OBJLIST_TOOLKIT:
			break;
			
			case iPopupMenuExtension::MENU_OBJDETAILS_ACTIONS:
                if ($param instanceof UserRequest)
                {
                    $active_user_login = $_SESSION['auth_user'];
                    $agent_search = DBObjectSearch::FromOQL("SELECT Person AS p JOIN UserLocal AS ul ON ul.contactid = p.id WHERE ul.login = '".$active_user_login."'");
                    $agent_set = new DBObjectSet($agent_search);
                    if ($agent_set->Count() != 0) {
						$agent = $agent_set->Fetch();
                        $agent_phone = $agent->Get('phone');
                        $customer_id = $param->GetKey();
                        $customer_search = DBObjectSearch::FromOQL("SELECT Person AS p JOIN UserRequest AS ur ON ur.caller_id = p.id WHERE ur.id = ($customer_id)");
                        $customer_set = new DBObjectSet($customer_search);
                        if ($customer_set->Count() != 0) {
                            $customer = $customer_set->Fetch();
                            $customer_phone = $customer->Get('phone');
                            $customer_name = $customer->Get('first_name').' '.$customer->Get('name');
                            $result[] = new SeparatorPopupMenuItem();
                            $module_directory = basename(dirname(__FILE__));
                            $js_file_url = utils::GetAbsoluteUrlModulesRoot().$module_directory.'/js/call.js';
                            $result[] = new JSPopupMenuItem('CallToCustomer', 'Звонок клиенту '.$customer_name, "CallToCustomer('".$agent_phone."','".$customer_phone."')", array($js_file_url));
                            $result[] = new SeparatorPopupMenuItem();
                        }
                    }
                }
                if ($param instanceof Incident)
                {
                    $active_user_login = $_SESSION['auth_user'];
                    $agent_search = DBObjectSearch::FromOQL("SELECT Person AS p JOIN UserLocal AS ul ON ul.contactid = p.id WHERE ul.login = '".$active_user_login."'");
                    $agent_set = new DBObjectSet($agent_search);
                    if ($agent_set->Count() != 0) {
						$agent = $agent_set->Fetch();
						$agent_phone = $agent->Get('phone');
                        $customer_id = $param->GetKey();
                        $customer_search = DBObjectSearch::FromOQL("SELECT Person AS p JOIN Incident AS ur ON ur.caller_id = p.id WHERE ur.id = ($customer_id)");
                        $customer_set = new DBObjectSet($customer_search);
                        if ($customer_set->Count() != 0) {
                            $customer = $customer_set->Fetch();
                            $customer_phone = $customer->Get('phone');
                            $customer_name = $customer->Get('name');
                            $result[] = new SeparatorPopupMenuItem();
                            $module_directory = basename(dirname(__FILE__));
                            $js_file_url = utils::GetAbsoluteUrlModulesRoot().$module_directory.'/js/call.js';
                            $result[] = new JSPopupMenuItem('CallToCustomer', 'Звонок клиенту '.$customer_name, "CallToCustomer('".$agent_phone."','".$customer_phone."')", array($js_file_url));
                            $result[] = new SeparatorPopupMenuItem();
                        }
                    }
                }
			break;
			
			case iPopupMenuExtension::MENU_DASHBOARD_ACTIONS:
			break;
			
			case iPopupMenuExtension::MENU_USER_ACTIONS:
			break;
		
		}
		return $result;
	}
}

