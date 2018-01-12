<?php
/**
 * Sample extension to show how adding menu items in iTop
 * This extension does nothing really useful but shows how to use the three possible
 * types of menu items:
 * 
 * - An URL to any web page
 * - A Javascript function call
 * - A separator (horizontal line in the menu)
 */
class AddMenuSampleExtension implements iPopupMenuExtension
{
	/**
	 * Get the list of items to be added to a menu.
	 *
	 * This method is called by the framework for each menu.
	 * The items will be inserted in the menu in the order of the returned array.
	 * @param int $iMenuId The identifier of the type of menu, as listed by the constants MENU_xxx
	 * @param mixed $param Depends on $iMenuId, see the constants defined above
	 * @return object[] An array of ApplicationPopupMenuItem or an empty array if no action is to be added to the menu
	 */
	public static function EnumItems($iMenuId, $param)
	{
		$aResult = array();
		
		switch($iMenuId) // type of menu in which to add menu items
		{
			/**
			 * Insert an item into the Actions menu of a list
			 * $param is a DBObjectSet containing the list of objects
			 */
			case iPopupMenuExtension::MENU_OBJLIST_ACTIONS:
			break;
			
			/**
			 * Insert an item into the Toolkit menu of a list
			 * $param is a DBObjectSet containing the list of objects
			 */	
			case iPopupMenuExtension::MENU_OBJLIST_TOOLKIT:
			break;
			
			/**
			 * Insert an item into the Actions menu on an object's details page
			 * $param is a DBObject instance: the object currently displayed
			 */	
			case iPopupMenuExtension::MENU_OBJDETAILS_ACTIONS:
                if ($param instanceof UserRequest)
                {
                    $login = $_SESSION['auth_user'];
                    $lSearch = DBObjectSearch::FromOQL("SELECT Person AS p JOIN UserLocal AS ul ON ul.contactid = p.id WHERE ul.login = '".$login."'");
                    $lSet = new DBObjectSet($lSearch);
                    if ($lSet->Count() != 0) {
                        $agent_phone = $lSet->Fetch()->Get('phone');
                        $uId = $param->GetKey();
                        $uSearch = DBObjectSearch::FromOQL("SELECT Person AS p JOIN UserRequest AS ur ON ur.caller_id = p.id WHERE ur.id = ($uId)");
                        $pSet = new DBObjectSet($uSearch);
                        if ($pSet->Count() != 0) {
                            $person = $pSet->Fetch();
                            $customer_phone = $person->Get('phone');
                            $customer_name = $person->Get('first_name').' '.$person->Get('name');
                            $aResult[] = new SeparatorPopupMenuItem();
                            $sModuleDir = basename(dirname(__FILE__));
                            $sJSFileUrl = utils::GetAbsoluteUrlModulesRoot().$sModuleDir.'/js/call.js';
                            $aResult[] = new JSPopupMenuItem('CallToCustomer', 'Звонов клиенту '.$customer_name, "CallToCustomer('".$agent_phone."','".$customer_phone."')", array($sJSFileUrl));
                            $aResult[] = new SeparatorPopupMenuItem();
                        }
                    }
                }
                if ($param instanceof Incident)
                {
                    $login = $_SESSION['auth_user'];
                    $lSearch = DBObjectSearch::FromOQL("SELECT Person AS p JOIN UserLocal AS ul ON ul.contactid = p.id WHERE ul.login = '".$login."'");
                    $lSet = new DBObjectSet($lSearch);
                    if ($lSet->Count() != 0) {
                        $agent_phone = $lSet->Fetch()->Get('phone');
                        $uId = $param->GetKey();
                        $uSearch = DBObjectSearch::FromOQL("SELECT Person AS p JOIN UserRequest AS ur ON ur.caller_id = p.id WHERE ur.id = ($uId)");
                        $pSet = new DBObjectSet($uSearch);
                        if ($pSet->Count() != 0) {
                            $person = $pSet->Fetch();
                            $customer_phone = $person->Get('phone');
                            $customer_name = $person->Get('name');
                            $aResult[] = new SeparatorPopupMenuItem();
                            $sModuleDir = basename(dirname(__FILE__));
                            $sJSFileUrl = utils::GetAbsoluteUrlModulesRoot().$sModuleDir.'/js/call.js';
                            $aResult[] = new JSPopupMenuItem('CallToCustomer', 'Звонов клиенту '.$customer_name, "CallToCustomer('".$agent_phone."','".$customer_phone."')", array($sJSFileUrl));
                            $aResult[] = new SeparatorPopupMenuItem();
                        }
                    }
                }

			// Only for Contact: (i.e. Teams and Persons)
			if ($param instanceof Contact)
			{
				// add a separator
				$aResult[] = new SeparatorPopupMenuItem(); // Note: separator does not work in iTop 2.0 due to Trac #698, fixed in 2.0.1
				
				// Add a new menu item that triggers a custom JS function defined in our own javascript file: js/call.js
				$sModuleDir = basename(dirname(__FILE__));
				$sJSFileUrl = utils::GetAbsoluteUrlModulesRoot().$sModuleDir.'/js/call.js';
				$aResult[] = new JSPopupMenuItem('_Custom_JS_', 'Custom JS Function...', "MyCustomJSFunction('".addslashes($param->GetName())."')", array($sJSFileUrl));
			}
			break;
			
			/**
			 * Insert an item into the Dashboard menu
			 * The dashboad menu is shown on the top right corner of the page when
			 * a dashboard is being displayed.
			 * $param is a Dashboard instance: the dashboard currently displayed
			 */	
			case iPopupMenuExtension::MENU_DASHBOARD_ACTIONS:
			break;
			
			/**
			 * Insert an item into the User menu (upper right corner of the page)
			 * $param is null
			 */
			case iPopupMenuExtension::MENU_USER_ACTIONS:
			break;
		
		}
		return $aResult;
	}
}

