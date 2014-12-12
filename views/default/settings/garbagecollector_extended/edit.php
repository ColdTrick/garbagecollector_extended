<?php

	$plugin = $vars["entity"];

	$noyes_options = array(
		"no" => elgg_echo("option:no"),
		"yes" => elgg_echo("option:yes")
	);
?>
<div>
	<?php echo elgg_echo("garbagecollection_extended:settings:disclaimer"); ?>
</div>
<br />
<div>
	<?php 
		echo elgg_echo("garbagecollection_extended:settings:enable_gc");
		echo "&nbsp;" . elgg_view("input/pulldown", array("internalname" => "params[enable_gc]", "options_values" => $noyes_options, "value" => $plugin->enable_gc));
	?>
</div>
<div>
	<?php 
		echo vsprintf(elgg_echo("garbagecollection_extended:settings:stats:access_collections"), array(garbagecollector_extended_get_orphaned_access_collections(true))) . "<br />";
		echo vsprintf(elgg_echo("garbagecollection_extended:settings:stats:annotations"), array(garbagecollector_extended_get_orphaned_annotations(true))) . "<br />";
		echo vsprintf(elgg_echo("garbagecollection_extended:settings:stats:entities"), array(garbagecollector_extended_get_orphaned_entities(true))) . "<br />";
		echo vsprintf(elgg_echo("garbagecollection_extended:settings:stats:metadata"), array(garbagecollector_extended_get_orphaned_metadata(true))) . "<br />";
		echo vsprintf(elgg_echo("garbagecollection_extended:settings:stats:private_settings"), array(garbagecollector_extended_get_orphaned_private_settings(true))) . "<br />";
		echo vsprintf(elgg_echo("garbagecollection_extended:settings:stats:relationships"), array(garbagecollector_extended_get_orphaned_relationships(true))) . "<br />";
		echo vsprintf(elgg_echo("garbagecollection_extended:settings:stats:river"), array(garbagecollector_extended_get_orphaned_river(true))) . "<br />";
	?>
</div>