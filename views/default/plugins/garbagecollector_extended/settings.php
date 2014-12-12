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
		echo "&nbsp;" . elgg_view("input/select", array("name" => "params[enable_gc]", "options_values" => $noyes_options, "value" => $plugin->enable_gc));
	?>
</div>
<table class='elgg-table mbm'>
	<?php 
		echo "<tr><td>" . elgg_echo("garbagecollection_extended:settings:stats:access_collections") . ":</td><td>" . garbagecollector_extended_get_orphaned_access_collections(true) . "</td></tr>";
		echo "<tr><td>" . elgg_echo("garbagecollection_extended:settings:stats:annotations") . ":</td><td>" . garbagecollector_extended_get_orphaned_annotations(true) . "</td></tr>";
		echo "<tr><td>" . elgg_echo("garbagecollection_extended:settings:stats:entities") . ":</td><td>" . garbagecollector_extended_get_orphaned_entities(true) . "</td></tr>";
		echo "<tr><td>" . elgg_echo("garbagecollection_extended:settings:stats:metadata") . ":</td><td>" . garbagecollector_extended_get_orphaned_metadata(true) . "</td></tr>";
		echo "<tr><td>" . elgg_echo("garbagecollection_extended:settings:stats:private_settings") . ":</td><td>" . garbagecollector_extended_get_orphaned_private_settings(true) . "</td></tr>";
		echo "<tr><td>" . elgg_echo("garbagecollection_extended:settings:stats:relationships") . ":</td><td>" . garbagecollector_extended_get_orphaned_relationships(true) . "</td></tr>";
		echo "<tr><td>" . elgg_echo("garbagecollection_extended:settings:stats:river") . ":</td><td>" . garbagecollector_extended_get_orphaned_river(true) . "</td></tr>";
	?>
</table>