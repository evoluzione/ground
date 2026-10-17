<?php
return [
	'placeholder_url' => GROUND_TEMPLATE_DIRECTORY_URI . '/assets/img/placeholder.svg',
	'quality' => 82,
	'content_width' => 1920,
	'sanitize_file_name' => true,
	'icon_set' => 'lucide',

	// Keyed by registered size name. 'height' => 0 caps the width only, 'crop'
	// defaults to false. Changes here need a `wp media regenerate`.
	'sizes' => [

		// Core slots — theme-support.php mirrors these into wp_options too. 1536x1536 and 2048x2048 are core's own.
		'thumbnail' => [ 'width' => 150, 'height' => 150, 'crop' => true ],
		'medium' => [ 'width' => 300, 'height' => 300 ],
		'medium_large' => [ 'width' => 768, 'height' => 0 ],
		'large' => [ 'width' => 1024, 'height' => 1024 ],

		// Cropped families, one per ratio in use
		'1-1-small' => [ 'width' => 320, 'height' => 320, 'crop' => true ],
		'1-1-medium' => [ 'width' => 640, 'height' => 640, 'crop' => true ],
		'1-1-large' => [ 'width' => 1200, 'height' => 1200, 'crop' => true ],
		'4-3-small' => [ 'width' => 320, 'height' => 240, 'crop' => true ],
		'4-3-medium' => [ 'width' => 640, 'height' => 480, 'crop' => true ],
		'4-3-large' => [ 'width' => 1440, 'height' => 1080, 'crop' => true ],
		'16-9-small' => [ 'width' => 640, 'height' => 360, 'crop' => true ],
		'16-9-medium' => [ 'width' => 768, 'height' => 432, 'crop' => true ],
		'16-9-large' => [ 'width' => 1024, 'height' => 576, 'crop' => true ],
		'16-9-xlarge' => [ 'width' => 1920, 'height' => 1080, 'crop' => true ],

		// Registered by WooCommerce — see inc/woocommerce.php.
		'woocommerce_thumbnail' => [ 'width' => 300, 'height' => 300, 'crop' => true ],  // Shop/loop, categories, cart, checkout, emails, widgets
		'woocommerce_single' => [ 'width' => 600, 'height' => 0 ], // Single product main image
		'woocommerce_gallery_thumbnail' => [ 'width' => 100, 'height' => 100, 'crop' => true ],  // Single product gallery thumbnails
	],
];
