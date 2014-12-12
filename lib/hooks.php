<?php
/**
 * Hooks for Garbage Collector Extended
 */

/**
 * handles the extended garbage collection 
 * 
 * @param string $hook        hookname
 * @param string $type        hooktype
 * @param mixed  $returnvalue current return value
 * @param mixed  $params      original parameters
 * 
 * @return void
 */
function garbagecollector_extended_gc_hook($hook, $type, $returnvalue, $params) {
	global $CONFIG;
	global $GARBAGECOLLECTOR_EXTENDED_GC;
	
	$GARBAGECOLLECTOR_EXTENDED_GC = true;
	
	// overrule access settigns
	$ia = elgg_get_ignore_access();
	elgg_set_ignore_access(true);
	
	// cleanup entities
	if ($entity_guids = garbagecollector_extended_get_orphaned_entities()) {
		echo vsprintf(elgg_echo("garbagecollector_extended:cleanup"), "entities");
		
		foreach ($entity_guids as $guid) {
			delete_entity($guid);
		}
		
		echo elgg_echo("garbagecollector_extended:done") . "\n";
	}
	
	// cleanup access collections
	if ($acl_ids = garbagecollector_extended_get_orphaned_access_collections()) {
		echo vsprintf(elgg_echo("garbagecollector_extended:cleanup"), "access collections");
		
		foreach ($acl_ids as $id) {
			delete_access_collection($id);
		}
		
		echo elgg_echo("garbagecollector_extended:done") . "\n";
	}
	
	// cleanup annotations
	if ($anno_ids = garbagecollector_extended_get_orphaned_annotations()) {
		echo vsprintf(elgg_echo("garbagecollector_extended:cleanup"), "annotations");
		
		foreach ($anno_ids as $id) {
			delete_annotation($id);
		}
		
		echo elgg_echo("garbagecollector_extended:done") . "\n";
	}
	
	// cleanup metadata
	if ($meta_ids = garbagecollector_extended_get_orphaned_metadata()) {
		echo vsprintf(elgg_echo("garbagecollector_extended:cleanup"), "metadata");
		
		foreach ($meta_ids as $id) {
			// We need to manualy delete metadata as the Elgg functions don't work because this is orphaned metadata
			// also we need to delete this one by one because of potential long query strings
			$sql = "DELETE FROM " . $CONFIG->dbprefix . "metadata";
			$sql .= " WHERE id = " . $id;
			
			delete_data($sql);
		}
		
		echo elgg_echo("garbagecollector_extended:done") . "\n";
	}
	
	// cleanup private settings
	if ($private_ids = garbagecollector_extended_get_orphaned_private_settings()) {
		echo vsprintf(elgg_echo("garbagecollector_extended:cleanup"), "private settings");
		
		foreach ($private_ids as $id) {
			// We need to manualy delete private settings as Elgg doesn't have a function fot this
			// also we need to delete this one by one because of potential long query strings
			$sql = "DELETE FROM " . $CONFIG->dbprefix . "private_settings";
			$sql .= " WHERE id = " . $id;
			
			delete_data($sql);
		}
		
		echo elgg_echo("garbagecollector_extended:done") . "\n";
	}
	
	// cleanup relationships
	if ($rel_ids = garbagecollector_extended_get_orphaned_relationships()) {
		echo vsprintf(elgg_echo("garbagecollector_extended:cleanup"), "relationships");
		
		foreach ($rel_ids as $id) {
			delete_relationship($id);
		}
		
		echo elgg_echo("garbagecollector_extended:done") . "\n";
	}
	
	// cleanup river
	if ($river_ids = garbagecollector_extended_get_orphaned_river()) {
		echo vsprintf(elgg_echo("garbagecollector_extended:cleanup"), "river items");
		
		foreach ($river_ids as $id) {
			remove_from_river_by_id($id);
		}
		
		echo elgg_echo("garbagecollector_extended:done") . "\n";
	}
	
	// because we cleaned up a lot, do metastrings again
	delete_orphaned_metastrings();
	
	// restore access settings
	elgg_set_ignore_access($ia);
	$GARBAGECOLLECTOR_EXTENDED_GC = false;
}

/**
 * make sure can_edit_entity returns true in case of extended garbage collection
 * 
 * @param string $hook        hookname
 * @param string $type        hooktype
 * @param mixed  $returnvalue current return value
 * @param mixed  $params      original parameters
 * 
 * @return boolean
 */
function garbagecollector_extended_permissions_hook($hook, $type, $returnvalue, $params) {
	global $GARBAGECOLLECTOR_EXTENDED_GC;
	
	if ($GARBAGECOLLECTOR_EXTENDED_GC === true) {
		return true;
	}
}
