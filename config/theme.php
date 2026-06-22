<?php
return [
	"debug" => ( isset( $_GET['debug'] ) && $_GET['debug'] === 'true' && current_user_can( 'manage_options' ) ) ? true : false,
	"debug_breakpoints" => current_user_can( 'manage_options' ),
	'automatic-feed-links' => true,
	'theme-color' => '#fafafa',
];