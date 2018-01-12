<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'custom-asterisk-integration/',
	array(
		// Identification
		//
		'label' => 'Integrate iTop with Asterisk (v.0.0.1)',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'main.custom-asterisk-integration.php'
		),
		'webservice' => array(
			
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			'options' => array(
				'host' => 'asterisk-server-address',
				'scheme' => 'tcp://',
				'port' => 5038,
				'username' => 'itop-user',
				'secret' => 'itop-user-password',
				'connect_timeout' => 10000,
				'read_timeout' => 100000
			)
		)
	)
);


?>
