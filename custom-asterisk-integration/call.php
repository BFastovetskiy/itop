<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/approot.inc.php');
require_once(APPROOT.'/core/metamodel.class.php');
require_once(APPROOT.'/application/startup.inc.php');
require_once(__DIR__ . '/vendor/autoload.php');

$agent = 'sip/'.$_REQUEST['agent'];
$customer = $_REQUEST['customer'];

use PAMI\Client\Impl\ClientImpl;
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
    $client_asterisk = new ClientImpl($options);
    $client_asterisk->registerEventListener(new A($client_asterisk));
    $client_asterisk->open();
    $time = time();
    usleep(1000);
    $action_id = md5(uniqid());
    $action = new OriginateAction($agent);
    $action->setContext('from-internal');
    $action->setPriority('1');
    $action->setCallerId('Call to Customer');
    $action->setExtension($customer);
    $action->setAsync(false);
    $action->setActionID($action_id);
    $client_asterisk->send($action);

    while(true)
    {
        $orgresp = $client_asterisk->process();
    }
    $a->close();
} catch (Exception $e) {
    IssueLog::Error('custom-asterisk-integration: '.$e->getMessage());
}

?>