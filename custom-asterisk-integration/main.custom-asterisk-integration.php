<?php
class AddMenuSampleExtension implements iPopupMenuExtension
{
	public static function EnumItems($menu_id, $param)
	{
        $aResult = array();
		
		switch($menu_id)
		{
			case iPopupMenuExtension::MENU_OBJLIST_ACTIONS:
			break;
			
			case iPopupMenuExtension::MENU_OBJLIST_TOOLKIT:
			break;
			
			case iPopupMenuExtension::MENU_OBJDETAILS_ACTIONS:
                if (($param instanceof UserRequest) || ($param instanceof Incident))
                {
                    try {
                        $oAgent = UserRights::GetContactObject();
                        $oCaller = MetaModel::GetObject('Person', $param->Get('caller_id'));

                        if (is_null($oAgent)) {
                            IssueLog::Warning('CallToCustomerExtension: current user has no contact: ' . UserRights::GetUserId());
                            return $aResult;
                        } elseif (is_null($oCaller)) {
                            IssueLog::Error('CallToCustomerExtension: ticket has no caller: ' . $param->Get('ref'));
                            return $aResult;
                        } elseif (!$oCaller->Get('phone')) {
                            IssueLog::Error('CallToCustomerExtension: caller person has no phone: ' . $oCaller->GetKey());
                            return $aResult;
                        }

                        $sJsFileUrl = utils::GetAbsoluteUrlModulesRoot().basename(dirname(__FILE__)).'/js/call.js';
                        $sJsCode = sprintf("CallToCustomer('%s','%s')", $oAgent->Get('phone'), $oCaller->Get('phone'));
                        $sLabel = Dict::Format('Звонок клиету ', $oCaller->GetName());

                        $aResult[] = new SeparatorPopupMenuItem();
                        $aResult[] = new JSPopupMenuItem('CallToCustomer', $sLabel, $sJsCode, array($sJsFileUrl));
                        $aResult[] = new SeparatorPopupMenuItem();
                    }
                    catch (Exception $ex)
                    {
                        IssueLog::Error($ex);
                        return $aResult;
                    }
                }
			break;
			
			case iPopupMenuExtension::MENU_DASHBOARD_ACTIONS:
			break;
			
			case iPopupMenuExtension::MENU_USER_ACTIONS:
			break;
		
		}
		return $aResult;
	}
}

