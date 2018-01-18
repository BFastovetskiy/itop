<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/approot.inc.php');
require_once(APPROOT.'/core/metamodel.class.php');
require_once(APPROOT.'/application/startup.inc.php');
require_once(__DIR__ . '/vendor/autoload.php');

use PAMI\Client\Impl\ClientImpl;
use PAMI\Listener\IEventListener;
use PAMI\Message\Event\EventMessage;
use PAMI\Message\Action\OriginateAction;
use PAMI\Message\Action\StatusAction;

class A implements IEventListener
{

    public function __construct($cli)
    {
        $this->cli = $cli;

    }

    public function handle(EventMessage $event)
    {
        if ($strevt == 'DialBegin') {
            echo "DialBegin event --- \n";
        }
        if ($strevt == 'DialEnd') {
            echo "Dial end event --- \n";
        }

        if ($strevt == 'Hangup') {
            echo "Hangup event --- \n";
        }
    }
}

    $sAgent = 'sip/'.$_REQUEST['agent'];
    $sCustomer = $_REQUEST['customer'];

    try {
        // read Asterisk options from options.conf
        $oOptions = MetaModel::GetModuleSetting('custom-asterisk-integration', 'options', array());

        // create Asterisk client
        $oAsterisk = new ClientImpl($oOptions);
        $oAsterisk->registerEventListener(new A($oAsterisk));
        // connection
        $oAsterisk->open();
        // create a timestamp
        $oTime = time();

        while(true)
        {
            usleep(1000);
            $action_id = md5(uniqid());

            $response = $oAsterisk->send(new StatusAction());

            $action = new OriginateAction($sAgent);
            $action->setContext('from-internal');
            $action->setPriority('1');
            $action->setCallerId('Call to Customer');
            $action->setExtension($sCustomer);
            $action->setAsync(false);
            $action->setActionID($action_id);
            $oAsterisk->send($action);
            $orgresp = $oAsterisk->send($originateMsg);
            $orgStatus = $orgresp->getKeys()['response'];
            $oAsterisk->process();
        }
        $oAsterisk->close();
    }
    catch (Exception $e)
    {
        IssueLog::Error('custom-asterisk-integration: '.$e->getMessage());
    }

?>