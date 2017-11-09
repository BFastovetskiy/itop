<?php

Dict::Add('RU RU', 'Russian', 'Русский', array(
	// Dictionary entries go here
	'Menu:Ongoing approval' => 'Запросы, ожидающие утверждения',
	'Menu:Ongoing approval+' => 'Запросы, ожидающие утверждения',
	'Approbation:ApprovalSubject' => 'Необходимо Ваше согласование для $object->ref$',
	'Approbation:ApprovalBody' => '<p>Уважаемый $approver->friendlyname$, просьба согласовать или откланить запрос $object->ref$</p>
				      <b>Заявитель:</b>$object->caller_id_friendlyname$<br>
				      <b>Тема:</b>$object->title$<br>
				      <b>Группа услуг:</b>$object->service_name$<br>
				      <b>Услуга:</b>$object->servicesubcategory_name$<br>
				      <b>Описание:</b>				     
				      <pre>$object->description$</pre>
				      <b>Дополнительная информация:</b>
				      <pre>$object->head(public_log)$</pre>',
	'Approbation:FormBody' => '<p>Уважаемый $approver->friendlyname$, просьба согласовать или откланить запрос</p>',
	'Approbation:ApprovalRequested' => 'Необходимо Ваше согласование',
	'Approbation:Introduction' => '<p>Уважаемый $approver->friendlyname$, просьба согласовать или откланить запрос $object->friendlyname$</p>',


));

//
// Class: ApprovalRule
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:ApprovalRule' => 'Правило согласования',
	'Class:ApprovalRule+' => '',
	'Class:ApprovalRule/Attribute:name' => 'Название',
	'Class:ApprovalRule/Attribute:name+' => '',
	'Class:ApprovalRule/Attribute:description' => 'Описание',
	'Class:ApprovalRule/Attribute:description+' => '',
	'Class:ApprovalRule/Attribute:level1_rule' => 'Первый этап согласования',
	'Class:ApprovalRule/Attribute:level1_rule+' => '',
	'Class:ApprovalRule/Attribute:level1_default_approval' => 'Автоматически согласован, если нет ответа на первом этапе',
	'Class:ApprovalRule/Attribute:level1_default_approval+' => '',
	'Class:ApprovalRule/Attribute:level1_default_approval/Value:no' => 'Нет',
	'Class:ApprovalRule/Attribute:level1_default_approval/Value:no+' => 'Нет',
	'Class:ApprovalRule/Attribute:level1_default_approval/Value:yes' => 'Да',
	'Class:ApprovalRule/Attribute:level1_default_approval/Value:yes+' => 'Да',
	'Class:ApprovalRule/Attribute:level1_timeout' => 'Время на согласование на первом этапе (часов)',
	'Class:ApprovalRule/Attribute:level1_timeout+' => '',
	'Class:ApprovalRule/Attribute:level2_rule' => 'Второй этап согласования',
	'Class:ApprovalRule/Attribute:level2_rule+' => '',
	'Class:ApprovalRule/Attribute:level2_default_approval' => 'Автоматически согласован, если нет ответа на втором этапе',
	'Class:ApprovalRule/Attribute:level2_default_approval+' => '',
	'Class:ApprovalRule/Attribute:level2_default_approval/Value:no' => 'Нет',
	'Class:ApprovalRule/Attribute:level2_default_approval/Value:no+' => 'Нет',
	'Class:ApprovalRule/Attribute:level2_default_approval/Value:yes' => 'Да',
	'Class:ApprovalRule/Attribute:level2_default_approval/Value:yes+' => 'Да',
	'Class:ApprovalRule/Attribute:level2_timeout' => 'Время на согласование на втором этапе (часов)',
	'Class:ApprovalRule/Attribute:level2_timeout+' => '',
	'Class:ApprovalRule/Attribute:servicesubcategory_list' => 'Подкатегории услуг',
	'Class:ApprovalRule/Attribute:servicesubcategory_list+' => '',
	'Class:ApprovalRule/Attribute:coveragewindow_id' => 'Рабочий график',
	'Class:ApprovalRule/Attribute:coveragewindow_id+' => '',
	'Class:ApprovalRule/Attribute:coveragewindow_name' => 'Название рабочего графика',
	'Class:ApprovalRule/Attribute:coveragewindow_name+' => '',
));

//
// Class: ServiceSubcategory
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:ServiceSubcategory/Attribute:approvalrule_id' => 'Правило согласования',
	'Class:ServiceSubcategory/Attribute:approvalrule_id+' => '',
	'Class:ServiceSubcategory/Attribute:approvalrule_name' => 'Название правила согласования',
	'Class:ServiceSubcategory/Attribute:approvalrule_name+' => '',
	'ApprovalRule:baseinfo' => 'Общая информация',
	'ApprovalRule:Level1' => 'Первый этап согласования',
	'ApprovalRule:Level2' => 'Второй этап согласования',
	'Menu:ApprovalRule' => 'Правила согласования',
	'Menu:ApprovalRule+' => 'Все правила согласования',
));

?>
