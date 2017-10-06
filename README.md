# iTop
## Added the new objects in CMDB

### Objects:

1. WebProxy - an object can include multiple WebApplications.
2. WebProxyCluster - an object can include multiple WebProxy
3. LnkWebProxyToWebApplication - The object as the implementation link for several DatabaseSchema on the several WebApplication
4. LnkDatabaseSchemaToWebApplication - The object as the implementation link for several WebProxy on the several WebApplication
5. Added to DatabaseSchema the impact on WebApplications
6. Add cross link WebApplication on WebApplication

### Palns:

1. ~~Added to DatabaseSchema the impact on WebApplications~~
2. ~~Add cross link WebApplication on WebApplication~~
3. Add new CMDB object - DBCluster
4. Add objects to the Docker environment