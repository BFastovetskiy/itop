# READ ME

## Русский (Russian)

Работает это чудо следующим образом:

1. Модуль для Itop добавляет дополнительное скрытое поле к инциденту.
2. Zabbix сервере запускает iTop REST API для создания нового инцидента и передает Zabbix EventId и CMDB elementId.
3. При самовосстановлении Zabbix сервер вызывает еще раз iTop REST API и номер созданного ранее инцидента и закрывает инцидент.
4. Если инженер 2 линии поддержки закрывает инцидент в iTop модуль вызывает Zabbix REST API с указанием события eventId переданного при создании (сохранен в скрытом поле инцидента).

Правда есть пара проблем.
- Скриптов для Zabbix нет. Их придется писать самостоятельно.
- Модуль разрабатывался для версии iTop 2.4.*. С более новыми версиями не тестировался.

## English (English)

1. Module for Itop append additional hidden field to incident.
2. Zabbix server was running Itop rest api over http for create new incident with send Zabbix eventId and CMDB elementId
3. If the event in zabbix transform to close and incident in itop is open then zabbix running itop rest api for close incident with response text ~ "self recovery"
4. If engineer 2 support lines close incident in itop then my module for itop execute rest api zabbix for shutdown event in zabbix (eventId saved in incident hidden field)

There are a few problems
- No scripts for Zabbix.
- Module compatibility checked, only with version 2.4.1
