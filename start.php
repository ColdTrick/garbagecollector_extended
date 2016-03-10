<?php

// load libraries
require_once(dirname(__FILE__) . '/lib/functions.php');

// register default Elgg event
elgg_register_event_handler('init', 'system', 'garbagecollector_extended_init');

/**
 * initialization of plugin
 *
 * @return void
 */
function garbagecollector_extended_init() {
	
	elgg_register_plugin_hook_handler('gc', 'system', '\ColdTrick\GarbageCollectorExtended\GarbageCollector::collect', 400);
	elgg_register_widget_type('garbagecollector_extended', elgg_echo('garbagecollector_extended:widgets:garbagecollector_extended:title'), elgg_echo('garbagecollector_extended:widgets:garbagecollector_extended:description'), ['admin']);
}
