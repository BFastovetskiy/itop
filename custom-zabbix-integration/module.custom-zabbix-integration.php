<?php
//
// iTop module definition file
//

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'custom-zabbix-integration/0.0.1',

	array(
		// Identification
		//
		'label' => 'Integrate iTop with Zabbix (v.0.0.1)',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
            'itop-incident-mgmt-itil/2.4.0',
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'model.custom-zabbix-integration.php',
            'zabbix-event-close.php'
		),
		'webservice' => array(

		),
		'data.struct' => array(

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
                'zabbix_host' => 'url',
                'zabbix_user' => 'user',
                'zabbix_user_password' => 'password',
            )
		),
	)
);


?>
