<?php
return [
	'placeholder_url' => GROUND_TEMPLATE_DIRECTORY_URI . '/assets/img/placeholder.svg',
	'quality' => 82,
	'content_width' => 1920,
	'sanitize_file_name' => true,
	'icon_set' => 'lucide',

	// Keyed by the registered size name, so this file mirrors what the media
	// library actually holds. 'height' => 0 caps the width only, 'crop'
	// defaults to false. Editing anything here needs a `wp media regenerate`.
	'sizes' => [

		// WordPress core slots. Their dimensions also live in wp_options, which
		// is where WordPress reads them when it writes width/height into markup
		// — theme-support.php mirrors these values there so the two can't drift.
		'thumbnail' => [ 'width' => 200, 'height' => 200 ],
		'medium' => [ 'width' => 768, 'height' => 768 ],
		'medium_large' => [ 'width' => 1280, 'height' => 720 ],
		'large' => [ 'width' => 1920, 'height' => 1080 ],

		// Theme sizes.
		'small' => [ 'width' => 480, 'height' => 480 ],
		'1-1-small' => [ 'width' => 480, 'height' => 480 ],
		'1-1-medium' => [ 'width' => 900, 'height' => 900 ],
		'1-1-large' => [ 'width' => 1200, 'height' => 1200 ],
		'4-3-small' => [ 'width' => 640, 'height' => 480 ],
		'4-3-medium' => [ 'width' => 960, 'height' => 720 ],
		'4-3-large' => [ 'width' => 1600, 'height' => 1200 ],
		'16-9-small' => [ 'width' => 960, 'height' => 540 ],
		'16-9-medium' => [ 'width' => 1280, 'height' => 720 ],
		'16-9-large' => [ 'width' => 1920, 'height' => 1080 ],

		// WooCommerce registers these itself; declaring them here hands their
		// dimensions to this file and removes WooCommerce's own controls for
		// them (see inc/woocommerce.php).
		'woocommerce_thumbnail' => [ 'width' => 300, 'height' => 300, 'crop' => true ],  // Shop/loop, categories, cart, checkout, emails, widgets
		'woocommerce_single' => [ 'width' => 600, 'height' => 0 ], // Single product main image
		'woocommerce_gallery_thumbnail' => [ 'width' => 100, 'height' => 100, 'crop' => true ],  // Single product gallery thumbnails
	],
];
