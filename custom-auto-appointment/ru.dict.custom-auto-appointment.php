<?php

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:AutoAppointment' => 'Триггер автоматического назначения исполнителя',
	'Class:AutoAppointment+' => '',

	'Class:EventNotificationAutoAppointment' => 'Отчет об автоматическом назначении исполнителя',
	'Class:EventNotificationAutoAppointment+' => '',	
	'Class:EventNotificationAutoAppointment/Attribute:agent_id' => 'Исполнитель',
	'Class:EventNotificationAutoAppointment/Attribute:agent_id+' => '',
	'Class:EventNotificationAutoAppointment/Attribute:servicesubcategory_id' => 'Услуга',
	'Class:EventNotificationAutoAppointment/Attribute:servicesubcategory_id+' => '',

	'Class:AutoAppointmentRule' => 'Правило автоматического назначения исполнителя',
	'Class:AutoAppointmentRule+' => '',
	'Class:AutoAppointmentRule/Attribute:name' => 'Название',
	'Class:AutoAppointmentRule/Attribute:name+' => '',
	'Class:AutoAppointmentRule/Attribute:org_id' => 'Организация',
	'Class:AutoAppointmentRule/Attribute:org_id+' => '',
	'Class:AutoAppointmentRule/Attribute:team_id' => 'Группа исполнителей',
	'Class:AutoAppointmentRule/Attribute:team_id+' => '',
	'Class:AutoAppointmentRule/Attribute:service_id' => 'Группа услуг',
	'Class:AutoAppointmentRule/Attribute:service_id+' => '',
	'Class:AutoAppointmentRule/Attribute:subservice_id' => 'Услуга',
	'Class:AutoAppointmentRule/Attribute:subservice_id+' => '',
	'Menu:AutoAppointmentRule' => 'Правила автоматического назначения исполнителя',
	'Menu:AutoAppointmentRule+' => 'Все правила автоматического назначения исполнителя',
	
));
?>
