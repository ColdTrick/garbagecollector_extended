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

<div>
	<?php 
		echo elgg_echo("garbagecollection_extended:settings:enable_gc");
		echo "&nbsp;" . elgg_view("input/select", array("name" => "params[enable_gc]", "options_values" => $noyes_options, "value" => $plugin->enable_gc));
	?>
</div>
<?php 
echo elgg_view("garbagecollector_extended/counters");
