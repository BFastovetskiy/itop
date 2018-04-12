<?php

/**
 * ZabbixEventClose
 *
 *
 * @version 1.0
 * @author boris.fastovetskiy
 */

class ZabbixEventClose  implements iApplicationObjectExtension
{

    #region iApplicationObjectExtension Members

    /**
     * @param DBObject $oObject The target object
     * @return boolean True if something has changed for the target object
     */
    function OnIsModified($oObject)
    {
        return false;
    }

    /**
     *
     * @param DBObject $oObject The target object
     * @return string[] A list of errors message. An error message is made of one line and it can be displayed to the end-user.
     */
    function OnCheckToWrite($oObject)
    {
        // TODO: implement the function iApplicationObjectExtension::OnCheckToWrite
    }

    /**
     *
     * @param DBObject $oObject The target object
     * @return string[] A list of errors message. An error message is made of one line and it can be displayed to the end-user.
     */
    function OnCheckToDelete($oObject)
    {
        // TODO: implement the function iApplicationObjectExtension::OnCheckToDelete
    }

    /**
     *
     * @param DBObject $oObject The target object
     * @param CMDBChange|null $oChange A change context. Since 2.0 it is fine to ignore it, as the framework does maintain this information once for all the changes made within the current page
     * @return void
     */
    function OnDBUpdate($oObject, $oChange = null)
    {
        if (self::IsTargetObject($oObject)) {
            self::Start($oObject);
        }
    }

    /**
     * Invoked when an object is created into the database
     * The method is called right <b>after</b> the object has been written to the database.
     *
     * @param DBObject $oObject The target object
     * @param CMDBChange|null $oChange A change context. Since 2.0 it is fine to ignore it, as the framework does maintain this information once for all the changes made within the current page
     *
     * @return void
     */
    function OnDBInsert($oObject, $oChange = null)
    {
        // TODO: implement the function iApplicationObjectExtension::OnDBInsert
    }

    /**
     * Invoked when an object is deleted from the database
     * The method is called right <b>before</b> the object will be deleted from the database.
     *
     * @param DBObject $oObject The target object
     * @param CMDBChange|null $oChange A change context. Since 2.0 it is fine to ignore it, as the framework does maintain this information once for all the changes made within the current page
     *
     * @return void
     */
    function OnDBDelete($oObject, $oChange = null)
    {
        // TODO: implement the function iApplicationObjectExtension::OnDBDelete
    }

    #endregion

    /**
     * Check object then compatible
     * @param mixed $oObj
     * @return boolean
     */
    private static function IsTargetObject($oObj)
    {
        return get_class($oObj) === 'Incident' && $oObj->Get('status') === 'resolved' && !empty($oObj->Get('zabbix_ticket_id'));
    }

    private static function Start(Incident $oIncident)
    {
        try {
            $aOptions = MetaModel::GetModuleSetting('custom-zabbix-integration', 'options', array());
            $oZEC = new ZabbixEventCloser($aOptions['zabbix_host'], $aOptions['zabbix_user'], $aOptions['zabbix_user_password']);
            if ($oZEC->Login()) {
                $oZEC->CloseEvent($oIncident->Get('zabbix_ticket_id'), $oIncident->Get('solution'));
                $oZEC->Logout();
            }
            // TODO: необходимо добавлять информацию в историю
        }
        catch (Exception $e) {
            IssueLog::Error('custom-zabbix-integration: '.$e->getMessage().'\r\n');
        }
    }
}

class ZabbixEventCloser {

    private $user = null;
    private $password = null;
    private $url = null;
    private $session_key = null;

    public function __construct($url, $user, $password)
    {
        $this->url = $url;
        $this->user = $user;
        $this->password = $password;
    }

    public function Login() {
        $data = array(
            'jsonrpc' => '2.0',
            'method' => 'user.login',
            'params' => array(
                'user' => $this->user,
                'password' => $this->password
            ),
            'id' => 1
        );
        $this->session_key = $this->Call($data);
        return $this->isLoggedIn();
    }

    public function Logout()
    {
        $data = array(
            'jsonrpc' => '2.0',
            'method' => 'user.logout',
            'params' => array(),
            'auth' => $this->session_key,
            'id' => 3
        );
        $this->session_key = null;
        return $this->Call($data);
    }

    public function CloseEvent($zabbix_ticket_id, $message)
    {
        $data = array(
            'jsonrpc' => '2.0',
            'method' => 'event.acknowledge',
            'params' => array(
                'eventids' => explode(',', $zabbix_ticket_id),
                'message' => $message,
                'action' => 0
            ),
            'auth' => $this->session_key,
            'id' => 2
        );
        return $this->Call($data);
    }

    /**
     * Check result from Zabbix
     * @return boolean
     */
    public function isLoggedIn() {
        return !is_null($this->session_key);
    }

    /**
     * Send request to Zabbix
     * @param mixed $data
     * @return mixed
     */
    private function Call($data)
    {
        $result = null;
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode($data),
                'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
            )
        );

        try {
            $context  = stream_context_create($options);
            $result = file_get_contents($this->url, false, $context);
            $response = json_decode($result, true);
            if (empty($response['result']))
                IssueLog::Error('custom-zabbix-integration:'.$response['error']['data'].'\r\n');
            else
                $result = $response['result'];
        }
        catch (Exception $e) {
            IssueLog::Error('custom-zabbix-integration: '.$e->getMessage().'\r\n');
        }

        return $result;
    }
}