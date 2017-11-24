<?php
SetupWebPage::AddModule(
	__FILE__,
	'custom-auto-appointment/1.0.0',
	array(
		'label' => 'Auto appointment UserRequests & Incidents',
		'category' => 'business',
		'dependencies' => array(			
		),
		'mandatory' => false,
		'visible' => true,
		'datamodel' => array(
			'auto-appointment.event.class.php',
			'auto-appointment.action.class.php',
			'model.custom-auto-appointment.php'
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