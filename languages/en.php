<?php

	$english = array(
		'garbagecollector_extended' => "Garbage collector extended",
		
		// settings
		'garbagecollection_extended:settings:disclaimer' => "<b>DISCLAIMER:</b> This plugin will cleanup orphaned data in your Elgg database. This could cause problems. Please make sure you have a backup of your database before you enable this plugin. Below you can find a indication of how many items will be removed from your database.<br /><br />This plugin won't work without the <b>garbagecollector</b> plugin enabled!",
		
		'garbagecollection_extended:settings:enable_gc' => "Enable extended garbage collection:",
		
		'garbagecollection_extended:settings:stats:access_collections' => "Orphaned access collections: %s",
		'garbagecollection_extended:settings:stats:annotations' => "Orphaned annotations: %s",
		'garbagecollection_extended:settings:stats:entities' => "Orphaned entities: %s",
		'garbagecollection_extended:settings:stats:metadata' => "Orphaned metadata: %s",
		'garbagecollection_extended:settings:stats:private_settings' => "Orphaned private settings: %s",
		'garbagecollection_extended:settings:stats:relationships' => "Orphaned relationships: %s",
		'garbagecollection_extended:settings:stats:river' => "Orphaned river items: %s",
		
		// cleanup
		'garbagecollector_extended:cleanup' => "Cleaning up orphaned %s: ",
		'garbagecollector_extended:done' => "DONE",
	);
	
	add_translation("en", $english);