<?php

$plugin = elgg_extract('entity', $vars);

$noyes_options = [
	'no' => elgg_echo('option:no'),
	'yes' => elgg_echo('option:yes'),
];

echo elgg_format_element('div', [], elgg_echo('garbagecollection_extended:settings:disclaimer'));

$setting = elgg_echo('garbagecollection_extended:settings:enable_gc');
$setting .= elgg_view('input/select', [
	'name' => 'params[enable_gc]',
	'options_values' => $noyes_options,
	'value' => $plugin->enable_gc,
	'class' => 'mls',
]);

echo elgg_format_element('div', [], $setting);

echo elgg_view('garbagecollector_extended/counters');
