<?php
Dict::Add('RU RU', 'Russian', 'Русский', array(
	// Dictionary entries go here
	'Menu:Ongoing approval' => 'Запросы, ожидающие согласования',
	'Menu:Ongoing approval+' => 'Запросы, ожидающие согласования',
	'Approbation:PublicObjectDetails' => '<p>Уважаемый $approver->html(friendlyname)$, потребуется некоторое время для проведения процесса согласования заявки $object->html(ref)$</p>
				      <strong>Инициатор</strong>: $object->html(caller_id_friendlyname)$<br>
				      <strong>Заголовок</strong>: $object->html(title)$<br>
				      <strong>Услуга</strong>: $object->html(service_name)$<br>
				      <strong>Подкатегория услуг</strong>: $object->html(servicesubcategory_name)$<br>
				      <strong>Описание</strong>:<br>
				      $object->html(description)$<br>
				      <strong>Дополнительная информация</strong>:<br>
				      <div>$object->html(service_details)$</div>',
	'Approbation:FormBody' => '<p>Уважаемый $approver->html(friendlyname)$, потребуется некоторое время для проведения процесса согласования</p>',
	'Approbation:ApprovalRequested' => 'Требуется Ваше согласование',
	'Approbation:Introduction' => '<p>Уважаемый $approver->html(friendlyname)$, потребуется некоторое время для проведения процесса согласования $object->html(friendlyname)$</p>',


));

//
// Class: ApprovalRule
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:ApprovalRule' => 'Правила согласования',
	'Class:ApprovalRule+' => '',
	'Class:ApprovalRule/Attribute:name' => 'Название',
	'Class:ApprovalRule/Attribute:name+' => '',
	'Class:ApprovalRule/Attribute:description' => 'Описание',
	'Class:ApprovalRule/Attribute:description+' => '',
	'Class:ApprovalRule/Attribute:level1_rule' => 'Первый уровень согласования',
	'Class:ApprovalRule/Attribute:level1_rule+' => '',
	'Class:ApprovalRule/Attribute:level1_default_approval' => 'Автоматически одобрен, если нет ответа на первом уровне',
	'Class:ApprovalRule/Attribute:level1_default_approval+' => '',
	'Class:ApprovalRule/Attribute:level1_default_approval/Value:no' => 'Нет',
	'Class:ApprovalRule/Attribute:level1_default_approval/Value:no+' => 'Нет',
	'Class:ApprovalRule/Attribute:level1_default_approval/Value:yes' => 'Да',
	'Class:ApprovalRule/Attribute:level1_default_approval/Value:yes+' => 'Да',
	'Class:ApprovalRule/Attribute:level1_timeout' => 'Время ожидания завершения первого уровня согласования',
	'Class:ApprovalRule/Attribute:level1_timeout+' => '',
	'Class:ApprovalRule/Attribute:level1_exit_condition' => 'Окончание согласования',
	'Class:ApprovalRule/Attribute:level1_exit_condition+' => '',
	'Class:ApprovalRule/Attribute:level1_exit_condition/Value:first_reply' => 'заканчивается при первом ответе',
	'Class:ApprovalRule/Attribute:level1_exit_condition/Value:first_reply+' => 'Ответ определяет результат на первом уровне',
	'Class:ApprovalRule/Attribute:level1_exit_condition/Value:first_reject' => 'заканчивается на первом «Отклонить»',
	'Class:ApprovalRule/Attribute:level1_exit_condition/Value:first_reject+' => 'Все должны одобрить',
	'Class:ApprovalRule/Attribute:level1_exit_condition/Value:first_approve' => 'заканчивается на первом «Согласовано»',
	'Class:ApprovalRule/Attribute:level1_exit_condition/Value:first_approve+' => 'Должен согласовать хоть один участник',
	'Class:ApprovalRule/Attribute:level2_rule' => 'Второй уровень согласования',
	'Class:ApprovalRule/Attribute:level2_rule+' => '',
	'Class:ApprovalRule/Attribute:level2_default_approval' => 'Автоматически одобрен, если нет ответа на втором уровне',
	'Class:ApprovalRule/Attribute:level2_default_approval+' => '',
	'Class:ApprovalRule/Attribute:level2_default_approval/Value:no' => 'Нет',
	'Class:ApprovalRule/Attribute:level2_default_approval/Value:no+' => 'Нет',
	'Class:ApprovalRule/Attribute:level2_default_approval/Value:yes' => 'Да',
	'Class:ApprovalRule/Attribute:level2_default_approval/Value:yes+' => 'Да',
	'Class:ApprovalRule/Attribute:level2_timeout' => 'Время ожидания завершения второго уровня согласования',
	'Class:ApprovalRule/Attribute:level2_timeout+' => '',
	'Class:ApprovalRule/Attribute:level2_exit_condition' => 'Окончание согласования второго уровня',
	'Class:ApprovalRule/Attribute:level2_exit_condition+' => '',
	'Class:ApprovalRule/Attribute:level2_exit_condition/Value:first_reply' => 'заканчивается при первом ответе',
	'Class:ApprovalRule/Attribute:level2_exit_condition/Value:first_reply+' => 'Ответ определяет результат на втором уровне',
	'Class:ApprovalRule/Attribute:level2_exit_condition/Value:first_reject' => 'заканчивается на первом «Отклонить»',
	'Class:ApprovalRule/Attribute:level2_exit_condition/Value:first_reject+' => 'Все должны одобрить',
	'Class:ApprovalRule/Attribute:level2_exit_condition/Value:first_approve' => 'заканчивается на первом «Согласовано»',
	'Class:ApprovalRule/Attribute:level2_exit_condition/Value:first_approve+' => 'Должен согласовать хоть один участник',
	'Class:ApprovalRule/Attribute:servicesubcategory_list' => 'Подкатегория услуг',
	'Class:ApprovalRule/Attribute:servicesubcategory_list+' => '',
	'Class:ApprovalRule/Attribute:coveragewindow_id' => 'Окно обслуживания',
	'Class:ApprovalRule/Attribute:coveragewindow_id+' => '',
	'Class:ApprovalRule/Attribute:coveragewindow_name' => 'Название окна обслуживания',
	'Class:ApprovalRule/Attribute:coveragewindow_name+' => '',
));

//
// Class: ServiceSubcategory
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Class:ServiceSubcategory/Attribute:approvalrule_id' => 'Правила согласования',
	'Class:ServiceSubcategory/Attribute:approvalrule_id+' => '',
	'Class:ServiceSubcategory/Attribute:approvalrule_name' => 'Название правила согласования',
	'Class:ServiceSubcategory/Attribute:approvalrule_name+' => '',
	'ApprovalRule:baseinfo' => 'Основная информация',
	'ApprovalRule:Level1' => 'Первый уровень согласования',
	'ApprovalRule:Level2' => 'Второй уровень согласования',
	'Menu:ApprovalRule' => 'Правила согласования',
	'Menu:ApprovalRule+' => 'Все правила согласования',

));
