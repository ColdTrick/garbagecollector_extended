<?php

// load libraries
require_once(dirname(__FILE__) . "/lib/functions.php");
require_once(dirname(__FILE__) . "/lib/hooks.php");

/**
 * initialization of plugin
 *
 * @return void
 */
function garbagecollector_extended_init() {
	
	if (elgg_get_plugin_setting("enable_gc", "garbagecollector_extended") == "yes") {
		elgg_register_plugin_hook_handler("permissions_check", "all", "garbagecollector_extended_permissions_hook");
		elgg_register_plugin_hook_handler("gc", "system", "garbagecollector_extended_gc_hook", 400);
	}
}

// register default Elgg event
elgg_register_event_handler("init", "system", "garbagecollector_extended_init");
