<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/approot.inc.php');
require_once(APPROOT.'/core/metamodel.class.php');
require_once(APPROOT.'/application/startup.inc.php');
require_once(__DIR__ . '/vendor/autoload.php');

$pAgent = 'sip/'.$_REQUEST['agent'];
$pCustomer = $_REQUEST['customer'];

use PAMI\Listener\IEventListener;
use PAMI\Message\Event\EventMessage;
use PAMI\Message\Action\OriginateAction;

class A implements IEventListener
{
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

try {
    $options = MetaModel::GetModuleSetting('custom-asterisk-integration', 'options', array());
    $a = new \PAMI\Client\Impl\ClientImpl($options);
    $a->registerEventListener(new A($a));
    $a->open();
    $time = time();
    usleep(1000);
    $actionid = md5(uniqid());
    $originateMsg = new OriginateAction($pAgent);
    $originateMsg->setContext('from-internal');
    $originateMsg->setPriority('1');
    $originateMsg->setCallerId('Call to Customer');
    $originateMsg->setExtension($pCustomer);
    $originateMsg->setAsync(false);
    $originateMsg->setActionID($actionid);
    $a->send($originateMsg);

    while(true)
    {
        $orgresp = $a->process();
    }
    $a->close();
} catch (Exception $e) {
    IssueLog::Error('custom-asterisk-integration: '.$e->getMessage());
}

?>