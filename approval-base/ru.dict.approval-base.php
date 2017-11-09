<?php

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Approval:Tab:Title' => 'Статус согласования',
	'Approval:Tab:Start' => 'Начало',
	'Approval:Tab:End' => 'Окончание',
	'Approval:Tab:StepEnd-Limit' => 'Ограничение по времени (неявный результат)',
	'Approval:Tab:StepEnd-Theoretical' => 'Временной лимит (продолжительность ограничена в %1$s минут)',
	'Approval:Tab:StepSumary-Ongoing' => 'Ожидание ответов',
	'Approval:Tab:StepSumary-OK' => 'Согласовано',
	'Approval:Tab:StepSumary-KO' => 'Отклонить',
	'Approval:Tab:StepSumary-OK-Timeout' => 'Согласовано (по таймауту)',
	'Approval:Tab:StepSumary-KO-Timeout' => 'Отклонено (по таймауту)',
	'Approval:Tab:StepSumary-Idle' => 'Ожидание',
	'Approval:Tab:StepSumary-Skipped' => 'Пропущено',
	'Approval:Tab:End-Abort' => 'Процесс утверждения был пройден %1$s при %2$s',

	'Approval:Tab:StepEnd-Condition-FirstReject' => 'Этот шаг заканчивается при первом отказе или если 100% одобрено',
	'Approval:Tab:StepEnd-Condition-FirstApprove' => 'Этот шаг заканчивается при первом одобрении или если 100% отклонено',
	'Approval:Tab:StepEnd-Condition-FirstReply' => 'Этот шаг заканчивается при первом ответе',

	'Approval:Tab:Error' => 'Произошла ошибка во время процесса утверждения: %1$s',

	'Approval:Error:Email' => 'Не удалось отправить электронное письмо (%1$s)',

	'Approval:Comment-Label' => 'Ваш комментарий',
	'Approval:Comment-Tooltip' => 'Обязательный для отказа, необязательный для утверждения',
	'Approval:Comment-Mandatory' => 'Необходимо дать комментарий об отказе',
	'Approval:Action-Approve' => 'Согласовано',
	'Approval:Action-Reject' => 'Отклонить',
	'Approval:Action-ApproveOrReject' => 'Согласовать/Отказать',
	'Approval:Action-Abort' => 'Обход процесса утверждения',

	'Approval:Form:Title' => 'Согласование',
	'Approval:Form:Ref' => 'Процесс утверждения для %1$s',

	'Approval:Form:ApproverDeleted' => 'К сожалению, запись, соответствующая вашей личности, была удалена.',
	'Approval:Form:ObjectDeleted' => 'К сожалению, объект утверждения удален.',

	'Approval:Form:AnswerGivenBy' => 'Извините, ответ уже предоставлен \'%1$s\'', 
	'Approval:Form:AlreadyApproved' => 'К сожалению, процесс уже завершен с результатом: Утверждено.',
	'Approval:Form:AlreadyRejected' => 'К сожалению, процесс уже завершен с результатом: Отклонено.',

	'Approval:Form:StepApproved' => 'К сожалению, эта фаза завершена с результатом: Утверждено. Процесс утверждения продолжается...',
	'Approval:Form:StepRejected' => 'К сожалению, эта фаза завершена с результатом: Отклонено. Процесс утверждения продолжается...',

	'Approval:Abort:Explain' => 'You have requested to <b>bypass</b> the approval process. This will stop the process and none of the approvers will be allowed to give their answer anymore.',

	'Approval:Form:AnswerRecorded-Continue' => 'Ваш ответ записан. Процесс утверждения продолжается.',
	'Approval:Form:AnswerRecorded-Approved' => 'Ваш ответ был записан: процесс утверждения теперь завершен с результатом СОГЛАСОВАНО.',
	'Approval:Form:AnswerRecorded-Rejected' => 'Ваш ответ был записан: процесс утверждения теперь завершен с результатом ОТКЛОНЕНО.',

	'Approval:Approved-On-behalf-of' => 'Согласовано %1$s от имени %2$s',
	'Approval:Rejected-On-behalf-of' => 'Отклонено %1$s от имени %2$s',
	'Approval:Approved-By' => 'Согласовано  %1$s',
	'Approval:Rejected-By' => 'Отклонено %1$s',

	'Approval:Ongoing-Title' => 'Текущие разрешения',
	'Approval:Ongoing-Title+' => 'Процедуры утверждения объектов класса %1$s',
	'Approval:Ongoing-FilterMyApprovals' => 'Показывать элементы, для которых требуется мое одобрение',
	'Approval:Ongoing-NothingCurrently' => 'Нет постоянного одобрения.',

	'Approval:Remind-Btn' => 'Отправить напоминание...',
	'Approval:Remind-DlgTitle' => 'Отправка напоминания',
	'Approval:Remind-DlgBody' => 'Следующие контакты будут уведомлены повторно:',
	'Approval:ReminderDone' => 'Напоминание будет отправлено %1$d контактам.',
	'Approval:Reminder-Subject' => '%1$s (напоминание)',

	'Approval:Portal:Title' => 'Элементы, ожидающие вашего согласования',
	'Approval:Portal:Title+' => 'Выберите элементы для утверждения и использую кнопки, расположенных в нижней части страницы.',
	'Approval:Portal:NoItem' => 'В настоящее время нет ожидающих утверждений',
	'Approval:Portal:WithSelected' => 'Выбрано...',
	'Approval:Portal:Btn:Approve' => 'Согласовать...',
	'Approval:Portal:Btn:Reject' => 'Отклонить...',
	'Approval:Portal:CommentPlaceholder' => 'Введите комментарий (обязательный в случае отказа)',
	'Approval:Portal:Success' => 'Ваши отзывы записаны.',
	'Approval:Portal:Dlg:Approve' => 'Подтвердите, что вы хотите одобрить  <em><span class="approval-count">?</span></em> элемент(ов)',
	'Approval:Portal:Dlg:Btn:Approve' => 'Согласовать',
	'Approval:Portal:Dlg:Reject' => 'Подтвердите, что вы хотите отклонить <em><span class="approval-count">?</span></em> элемент(ов)',
	'Approval:Portal:Dlg:Btn:Reject' => 'Отклонить',
));
