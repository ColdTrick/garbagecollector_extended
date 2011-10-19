<?php

	// load libraries
	require_once(dirname(__FILE__) . "/lib/functions.php");
	require_once(dirname(__FILE__) . "/lib/hooks.php");
	
	function garbagecollector_extended_init(){
		
		if(get_plugin_setting("enable_gc", "garbagecollector_extended") == "yes"){
			register_plugin_hook("permissions_check", "all", "garbagecollector_extended_permissions_hook");
			register_plugin_hook("gc", "system", "garbagecollector_extended_gc_hook", 400);
		}
	}
	
	// register default Elgg event
	register_elgg_event_handler("init", "system", "garbagecollector_extended_init");