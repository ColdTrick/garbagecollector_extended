# Garbage Collector Extended 

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ColdTrick/garbagecollector_extended/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ColdTrick/garbagecollector_extended/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/coldtrick/garbagecollector_extended/v/stable.svg)](https://packagist.org/packages/coldtrick/garbagecollector_extended)
[![License](https://poser.pugx.org/coldtrick/garbagecollector_extended/license.svg)](https://packagist.org/packages/coldtrick/garbagecollector_extended)

Cleanup orphaned data in your Elgg database

# Disclaimer

This plugin will cleanup orphaned data in your Elgg database. 
This could cause problems. Please make sure you have a backup of your database before you enable this plugin. 

This plugin won't work without the garbagecollector plugin enabled!

# Features

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
