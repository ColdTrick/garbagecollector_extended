<?php

namespace ColdTrick\GarbageCollectorExtended;

class GarbageCollector {
	
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
	public static function collect($hook, $type, $returnvalue, $params) {
		if (elgg_get_plugin_setting('enable_gc', 'garbagecollector_extended') !== 'yes') {
			return;
		}
		
		elgg_register_plugin_hook_handler('permissions_check', 'all', '\Elgg\Values::getTrue');
		
		$dbprefix = elgg_get_config('dbprefix');
		
		// overrule access settigns
		$ia = elgg_get_ignore_access();
		elgg_set_ignore_access(true);
		
		// cleanup entities
		if ($entity_guids = garbagecollector_extended_get_orphaned_entities()) {
			echo elgg_echo('garbagecollector_extended:cleanup', ['entities']);
		
			foreach ($entity_guids as $guid) {
				$entity = get_entity($guid);
				if ($entity) {
					$entity->delete();
				}
			}
		
			echo elgg_echo('garbagecollector_extended:done') . '\n';
		}
		
		// cleanup access collections
		if ($acl_ids = garbagecollector_extended_get_orphaned_access_collections()) {
			echo elgg_echo('garbagecollector_extended:cleanup', ['access collections']);
		
			foreach ($acl_ids as $id) {
				delete_access_collection($id);
			}
		
			echo elgg_echo('garbagecollector_extended:done') . '\n';
		}
		
		// cleanup annotations
		if ($anno_ids = garbagecollector_extended_get_orphaned_annotations()) {
			echo elgg_echo('garbagecollector_extended:cleanup', ['annotations']);
		
			foreach ($anno_ids as $id) {
				elgg_delete_annotation_by_id($id);
			}
		
			echo elgg_echo('garbagecollector_extended:done') . '\n';
		}
		
		// cleanup metadata
		if ($meta_ids = garbagecollector_extended_get_orphaned_metadata()) {
			echo elgg_echo('garbagecollector_extended:cleanup', ['metadata']);
		
			foreach ($meta_ids as $id) {
				// We need to manualy delete metadata as the Elgg functions don't work because this is orphaned metadata
				// also we need to delete this one by one because of potential long query strings
				$sql = 'DELETE FROM ' . $dbprefix . 'metadata';
				$sql .= ' WHERE id = ' . $id;
					
				delete_data($sql);
			}
		
			echo elgg_echo('garbagecollector_extended:done') . '\n';
		}
		
		// cleanup private settings
		if ($private_ids = garbagecollector_extended_get_orphaned_private_settings()) {
			echo elgg_echo('garbagecollector_extended:cleanup', ['private settings']);
		
			foreach ($private_ids as $id) {
				// We need to manualy delete private settings as Elgg doesn't have a function fot this
				// also we need to delete this one by one because of potential long query strings
				$sql = 'DELETE FROM ' . $dbprefix . 'private_settings';
				$sql .= ' WHERE id = ' . $id;
					
				delete_data($sql);
			}
		
			echo elgg_echo('garbagecollector_extended:done') . '\n';
		}
		
		// cleanup relationships
		if ($rel_ids = garbagecollector_extended_get_orphaned_relationships()) {
			echo elgg_echo('garbagecollector_extended:cleanup', ['relationships']);
		
			foreach ($rel_ids as $id) {
				delete_relationship($id);
			}
		
			echo elgg_echo('garbagecollector_extended:done') . '\n';
		}
		
		// cleanup river
		if ($river_ids = garbagecollector_extended_get_orphaned_river()) {
			echo elgg_echo('garbagecollector_extended:cleanup', ['river items']);
			elgg_delete_river(['ids' => $river_ids]);
		
			echo elgg_echo('garbagecollector_extended:done') . '\n';
		}
		
		// because we cleaned up a lot, do metastrings again
		garbagecollector_orphaned_metastrings();
		
		// restore access settings
		elgg_set_ignore_access($ia);
		
		elgg_unregister_plugin_hook_handler('permissions_check', 'all', '\Elgg\Values::getTrue');
	}
}