<?php
/**
 * Functions for Garbage Collector Extended
 */

/**
 * Return orphaned access collections
 *
 * @param boolean $count return count or rows
 *
 * @return int|array
 */
function garbagecollector_extended_get_orphaned_access_collections($count = false) {
	$dbprefix = elgg_get_config('dbprefix');
	
	$sql = $count ? "SELECT count(id) as count" : "SELECT *";
	
	$sql .= " FROM {$dbprefix}access_collections";
	$sql .= " WHERE owner_guid <> 0";
	$sql .= " AND owner_guid NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= ")";
	
	if ($count) {
		$data = get_data($sql);
		$result = $data ? $data[0]->count : 0;
	} else {
		$result = get_data($sql, 'garbagecollector_extended_id_only');
	}
	
	return $result;
}

/**
 * Return orphaned annotations
 *
 * @param boolean $count return count or rows
 *
 * @return int|array
 */
function garbagecollector_extended_get_orphaned_annotations($count = false) {
	$dbprefix = elgg_get_config('dbprefix');
	
	$sql = $count ? "SELECT count(id) as count" : "SELECT *";
		
	$sql .= " FROM {$dbprefix}annotations";
	$sql .= " WHERE entity_guid NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= ")";
	$sql .= " OR (owner_guid <> 0";
	$sql .= " AND owner_guid NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= "))";
	
	if ($count) {
		$data = get_data($sql);
		$result = $data ? $data[0]->count : 0;
	} else {
		$result = get_data($sql, "garbagecollector_extended_id_only");
	}
	
	return $result;
}

/**
 * Return orphaned entities
 *
 * @param boolean $count return count or rows
 *
 * @return int|array
 */
function garbagecollector_extended_get_orphaned_entities($count = false) {
	$dbprefix = elgg_get_config("dbprefix");
	
	$sql = $count ? "SELECT count(guid) as count" : "SELECT *";
	
	$sql .= " FROM {$dbprefix}entities";
	$sql .= " WHERE owner_guid <> 0";
	$sql .= " AND owner_guid NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= ")";
	$sql .= " AND enabled = 'yes'";
	
	if ($count) {
		$data = get_data($sql);
		$result = $data ? $data[0]->count : 0;
	} else {
		$result = get_data($sql, "garbagecollector_extended_guid_only");
	}
	
	return $result;
}

/**
 * Return orphaned metadata
 *
 * @param boolean $count return count or rows
 *
 * @return int|array
 */
function garbagecollector_extended_get_orphaned_metadata($count = false) {
	$dbprefix = elgg_get_config("dbprefix");
	
	$sql = $count ? "SELECT count(id) as count" : "SELECT *";
		
	$sql .= " FROM {$dbprefix}metadata";
	$sql .= " WHERE entity_guid NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= ")";
	$sql .= " OR (owner_guid <> 0";
	$sql .= " AND owner_guid NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= "))";
	
	if ($count) {
		$data = get_data($sql);
		$result = $data ? $data[0]->count : 0;
	} else {
		$result = get_data($sql, "garbagecollector_extended_id_only");
	}
	
	return $result;
}

/**
 * Return orphaned private settings
 *
 * @param boolean $count return count or rows
 *
 * @return int|array
 */
function garbagecollector_extended_get_orphaned_private_settings($count = false) {
	$dbprefix = elgg_get_config("dbprefix");
	
	$sql = $count ? "SELECT count(id) as count" : "SELECT *";
		
	$sql .= " FROM {$dbprefix}private_settings";
	$sql .= " WHERE entity_guid NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= ")";
	
	if ($count) {
		$data = get_data($sql);
		$result = $data ? $data[0]->count : 0;
	} else {
		$result = get_data($sql, "garbagecollector_extended_id_only");
	}
	
	return $result;
}

/**
 * Return orphaned relationships
 *
 * @param boolean $count return count or rows
 *
 * @return int|array
 */
function garbagecollector_extended_get_orphaned_relationships($count = false) {
	$dbprefix = elgg_get_config("dbprefix");
	
	$sql = $count ? "SELECT count(id) as count" : "SELECT *";
		
	$sql .= " FROM {$dbprefix}entity_relationships";
	$sql .= " WHERE guid_one NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= ")";
	$sql .= " OR guid_two NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= ")";
	
	if ($count) {
		$data = get_data($sql);
		$result = $data ? $data[0]->count : 0;
	} else {
		$result = get_data($sql, "garbagecollector_extended_id_only");
	}
	
	return $result;
}

/**
 * Return orphaned river items
 *
 * @param boolean $count return count or rows
 *
 * @return int|array
 */
function garbagecollector_extended_get_orphaned_river($count = false) {
	$dbprefix = elgg_get_config("dbprefix");
	
	$sql = $count ? "SELECT count(id) as count" : "SELECT *";
	
	$sql .= " FROM {$dbprefix}river";
	$sql .= " WHERE subject_guid NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= ")";
	$sql .= " OR object_guid NOT IN (";
	$sql .= "SELECT guid";
	$sql .= " FROM {$dbprefix}entities";
	$sql .= ")";
	
	if ($count) {
		$data = get_data($sql);
		$result = $data ? $data[0]->count : 0;
	} else {
		$result = get_data($sql, 'garbagecollector_extended_id_only');
	}
	
	return $result;
}

/**
 * Return guid from data row
 *
 * @param stdClass $row row data
 *
 * @return int
 */
function garbagecollector_extended_guid_only($row) {
	return (int) $row->guid;
}

/**
 * Return id from data row
 *
 * @param stdClass $row row data
 *
 * @return int
 */
function garbagecollector_extended_id_only($row) {
	return (int) $row->id;
}
