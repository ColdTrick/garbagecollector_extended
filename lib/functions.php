<?php

	function garbagecollector_extended_get_orphaned_access_collections($count = false){
		global $CONFIG;
		
		$result = false;
		
		if($count){
			$sql = "SELECT count(id) as count";
		} else {
			$sql = "SELECT *";
		}
		
		$sql .= " FROM " . $CONFIG->dbprefix . "access_collections";
		$sql .= " WHERE owner_guid <> 0";
		$sql .= " AND owner_guid NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= ")";
		
		if($count){
			$result = 0;
			if($data = get_data($sql)){
				$result = $data[0]->count;
			}
		} else {
			$result = get_data($sql, "garbagecollector_extended_id_only");
		}
		
		return $result;
	}
	
	function garbagecollector_extended_get_orphaned_annotations($count = false){
		global $CONFIG;
		
		$result = false;
		
		if($count){
			$sql = "SELECT count(id) as count";
		} else {
			$sql = "SELECT *";
		}
		
		$sql .= " FROM " . $CONFIG->dbprefix . "annotations";
		$sql .= " WHERE entity_guid NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= ")";
		$sql .= " OR (owner_guid <> 0";
		$sql .= " AND owner_guid NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= "))";
		
		if($count){
			$result = 0;
			if($data = get_data($sql)){
				$result = $data[0]->count;
			}
		} else {
			$result = get_data($sql, "garbagecollector_extended_id_only");
		}
		
		return $result;
	}
	
	function garbagecollector_extended_get_orphaned_entities($count = false){
		global $CONFIG;
		
		$result = false;
		
		if($count){
			$sql = "SELECT count(guid) as count";
		} else {
			$sql = "SELECT *";
		}
		
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= " WHERE owner_guid <> 0";
		$sql .= " AND owner_guid NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= ")";
		$sql .= " AND enabled = 'yes'";
		
		if($count){
			$result = 0;
			if($data = get_data($sql)){
				$result = $data[0]->count;
			}
		} else {
			$result = get_data($sql, "garbagecollector_extended_guid_only");
		}
		
		return $result;
	}
	
	function garbagecollector_extended_get_orphaned_metadata($count = false){
		global $CONFIG;
		
		$result = false;
		
		if($count){
			$sql = "SELECT count(id) as count";
		} else {
			$sql = "SELECT *";
		}
		
		$sql .= " FROM " . $CONFIG->dbprefix . "metadata";
		$sql .= " WHERE entity_guid NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= ")";
		$sql .= " OR (owner_guid <> 0";
		$sql .= " AND owner_guid NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= "))";
		
		if($count){
			$result = 0;
			if($data = get_data($sql)){
				$result = $data[0]->count;
			}
		} else {
			$result = get_data($sql, "garbagecollector_extended_id_only");
		}
		
		return $result;
	}
	
	function garbagecollector_extended_get_orphaned_private_settings($count = false){
		global $CONFIG;
		
		$result = false;
		
		if($count){
			$sql = "SELECT count(id) as count";
		} else {
			$sql = "SELECT *";
		}
		
		$sql .= " FROM " . $CONFIG->dbprefix . "private_settings";
		$sql .= " WHERE entity_guid NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= ")";
		
		if($count){
			$result = 0;
			if($data = get_data($sql)){
				$result = $data[0]->count;
			}
		} else {
			$result = get_data($sql, "garbagecollector_extended_id_only");
		}
		
		return $result;
	}
	
	function garbagecollector_extended_get_orphaned_relationships($count = false){
		global $CONFIG;
		
		$result = false;
		
		if($count){
			$sql = "SELECT count(id) as count";
		} else {
			$sql = "SELECT *";
		}
		
		$sql .= " FROM " . $CONFIG->dbprefix . "entity_relationships";
		$sql .= " WHERE guid_one NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= ")";
		$sql .= " OR guid_two NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= ")";
		
		if($count){
			$result = 0;
			if($data = get_data($sql)){
				$result = $data[0]->count;
			}
		} else {
			$result = get_data($sql, "garbagecollector_extended_id_only");
		}
		
		return $result;
	}
	
	function garbagecollector_extended_get_orphaned_river($count = false){
		global $CONFIG;
		
		$result = false;
		
		if($count){
			$sql = "SELECT count(id) as count";
		} else {
			$sql = "SELECT *";
		}
		
		$sql .= " FROM " . $CONFIG->dbprefix . "river";
		$sql .= " WHERE subject_guid NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= ")";
		$sql .= " OR object_guid NOT IN (";
		$sql .= "SELECT guid";
		$sql .= " FROM " . $CONFIG->dbprefix . "entities";
		$sql .= ")";
		
		if($count){
			$result = 0;
			if($data = get_data($sql)){
				$result = $data[0]->count;
			}
		} else {
			$result = get_data($sql, "garbagecollector_extended_id_only");
		}
		
		return $result;
	}
	
	function garbagecollector_extended_guid_only($row){
		return (int) $row->guid;
	}
	
	function garbagecollector_extended_id_only($row){
		return (int) $row->id;
	}