<?php
return [ 
	"debug" => isset( $_GET['debug'] ) && $_GET['debug'] == 'true' && is_user_logged_in() ?? false,
	'automatic-feed-links' => true,
	'theme-color' => '#fafafa',
];