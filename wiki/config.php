<?php
Config::set('wiki', array(
    'active' => true,
    'path' => 'modules',
    'topmenu' => true,
    'search' => array("Wiki Pages" => "WikiPage"),
    'dependencies' => array(
        'cebe/markdown' => '1.1.*'
    ),
    'liveedit' => true,
	'hooks' => array(
		'wiki',
	),
	'shortcode' => array(
		'video' => array(
			'default_width' => 640,
			'default_height' => 359,
		)
	)
));

// enable WikiPage in rest module
Config::append('system.rest_allow',array("WikiPage"));

// enable wikiPage to be mapped to forms
Config::append('form.mapping', [
 	'WikiPage'
]);
