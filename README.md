# iTop
## Added the new objects in CMDB

### Many thanks

Many thanks to the Russian community iTop. Although they did not answer my questions... They encouraged me to develop my own customization of the product. On the site http://itop-itsm.ru a large number of good and quality advice.

### Objects:

1. WebProxy - an object can include multiple WebApplications.
2. WebProxyCluster - an object can include multiple WebProxy
3. LnkWebProxyToWebApplication - The object as the implementation link for several DatabaseSchema on the several WebApplication
4. LnkDatabaseSchemaToWebApplication - The object as the implementation link for several WebProxy on the several WebApplication
5. Added new classes a the trigger action and the event action for Telegram notification (ActionTelegram & EventNotificationTelegram)
6. Added to DatabaseSchema the impact on WebApplications 
7. Add cross link WebApplication on WebApplication
8. Added translation into Russian to the Advanced Approval Module
9. iTop the module of auto appointment executor. Supports working schedules.
10. Added to the iTop module integration with Asterisk. Only outgoing calls.
11. iTop workflow module (implemented). Available only on request.
12. Added integration module with Zabbix. Integration is partial, it is possible to only close the event in monitoring after the incident closure in iTop

### Plans:

1. ~~Added to DatabaseSchema the impact on WebApplications~~
2. ~~Add cross link WebApplication on WebApplication~~
3. Add new CMDB object - DBCluster
4. Add objects to the Docker environment
5. ~~Add new CMDB trigger action for notification with Telegram~~
6. ~~Add new CMDB trigger action for create/update objects in monitoring system Zabbix~~
7. ~~Added to the iTop module integration with Asterisk~~

### Other

With questions and suggestions, you can contact me via Telegram @BorisFastovetskiy.

I will accept from you any thanks :)