<?php
return [ 
	"debug" => ( isset( $_GET['debug'] ) && $_GET['debug'] === 'true' && is_user_logged_in() ) ? true : false,
	"debug_breakpoints" => current_user_can( 'administrator' ),
	'automatic-feed-links' => true,
	'theme-color' => '#fafafa',
];