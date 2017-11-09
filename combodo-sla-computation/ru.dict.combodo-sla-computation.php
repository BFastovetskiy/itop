<?php
// Copyright (C) 2010 Combodo SARL
//
//   This program is free software; you can redistribute it and/or modify
//   it under the terms of the GNU General Public License as published by
//   the Free Software Foundation; version 3 of the License.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of the GNU General Public License
//   along with this program; if not, write to the Free Software
//   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

/**
 * Localized data
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */
//
// Class: CoverageWindow
//

Dict::Add('RU RU', 'Russian', 'Русский', array(
	'Menu:CoverageWindows' => 'Время обслуживания',
	'Menu:CoverageWindows+' => 'Все время обслуживания',
	'Class:CoverageWindow' => 'Время обслуживания',
	'Class:CoverageWindow+' => '',
	'Class:CoverageWindow/Attribute:name' => 'Название',
	'Class:CoverageWindow/Attribute:name+' => '',
	'Class:CoverageWindow/Attribute:description' => 'Описание',
	'Class:CoverageWindow/Attribute:description+' => '',
	'Class:CoverageWindow/Attribute:friendlyname' => 'Отображаемое имя',
	'Class:CoverageWindow/Attribute:friendlyname+' => '',
	'Class:CoverageWindow/Attribute:interval_list' => 'Рабочие часы',
	'WorkingHoursInterval:StartTime' => 'Время начала:',
	'WorkingHoursInterval:EndTime' => 'Время окончания:',
	'WorkingHoursInterval:WholeDay' => 'Весь день:',
	'WorkingHoursInterval:RemoveIntervalButton' => 'Удалить интервал',
	'WorkingHoursInterval:DlgTitle' => 'Open hours interval edition',
	'Class:CoverageWindowInterval' => 'Интервал рабочего времени',
	'Class:CoverageWindowInterval/Attribute:coverage_window_id' => 'Время обслуживания',
	'Class:CoverageWindowInterval/Attribute:weekday' => 'Дни недели',
	'Class:CoverageWindowInterval/Attribute:weekday/Value:sunday' => 'Воскресенье',
	'Class:CoverageWindowInterval/Attribute:weekday/Value:monday' => 'Понедельник',
	'Class:CoverageWindowInterval/Attribute:weekday/Value:tuesday' => 'Вторник',
	'Class:CoverageWindowInterval/Attribute:weekday/Value:wednesday' => 'Среда',
	'Class:CoverageWindowInterval/Attribute:weekday/Value:thursday' => 'Четверг',
	'Class:CoverageWindowInterval/Attribute:weekday/Value:friday' => 'Пятница',
	'Class:CoverageWindowInterval/Attribute:weekday/Value:saturday' => 'Суббота',
	'Class:CoverageWindowInterval/Attribute:start_time' => 'Время начала',
	'Class:CoverageWindowInterval/Attribute:end_time' => 'Время окончания',
	
));

Dict::Add('RU RU', 'Russian', 'Русский', array(
	// Dictionary entries go here
	'Menu:Holidays' => 'Праздники',
	'Menu:Holidays+' => 'Все праздники и выходные',
	'Class:Holiday' => 'Праздник/Выходной день',
	'Class:Holiday+' => 'Все не рабочие дни',
	'Class:Holiday/Attribute:name' => 'Название',
	'Class:Holiday/Attribute:date' => 'Дата',
	'Class:Holiday/Attribute:calendar_id' => 'Календарь',
	'Class:Holiday/Attribute:calendar_id+' => 'Календарь, к которому относится данный праздник',
	'Coverage:Description' => 'Описание',
	'Coverage:StartTime' => 'Время начала',	
	'Coverage:EndTime' => 'Время окончания',

));


Dict::Add('RU RU', 'Russian', 'Русский', array(
	// Dictionary entries go here
	'Menu:HolidayCalendars' => 'Календарь праздников',
	'Menu:HolidayCalendars+' => 'Все календари праздников',
	'Class:HolidayCalendar' => 'Календарь праздников',
	'Class:HolidayCalendar+' => 'A group of holidays that other objects can relate to',
	'Class:HolidayCalendar/Attribute:name' => 'Название',
	'Class:HolidayCalendar/Attribute:holiday_list' => 'Праздники',
));
?>
