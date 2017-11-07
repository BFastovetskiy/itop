<?php
SetupWebPage::AddModule(
	__FILE__,
	'custom-action-telegram/1.0.0',
	array(
		'label' => 'Telegram Notification trigger',
		'category' => 'business',
		'dependencies' => array(			
		),
		'mandatory' => false,
		'visible' => true,
		'datamodel' => array(
			'telegram.event.class.php',
			'telegram.action.class.php'
		),
		'webservice' => array(
		),
		'data.struct' => array(
		),
		'data.sample' => array(
		),
		'doc.manual_setup' => '',
		'doc.more_information' => '', 
		'settings' => array(
		),
	)
);
?>