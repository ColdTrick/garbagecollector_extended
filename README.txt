= Garbage Collector Extended =
Cleanup orphaned data in your Elgg database

== Contents ==
1. Disclaimer
2. Features
3. Version history

== 1 Disclaimer ==
This plugin will cleanup orphaned data in your Elgg database. 
This could cause problems. Please make sure you have a backup of your database before you enable this plugin. 

This plugin won't work without the garbagecollector plugin enabled!

== 2. Feaures ==
Cleanup the following Elgg tables:
- access_collections
- annotations
- entities
- metadata
- private_settings
- entity_relationships
- river

The following tables are cleaned up by Elgg by default
- groups_entity
- metastring
- objects_entity
- sites_entity
- users_entity

== 3. Version hostory ==
1.0 (2011-10-19):

- initial version