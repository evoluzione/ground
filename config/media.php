<?php
return [
	'placeholder_url' => GROUND_TEMPLATE_DIRECTORY_URI . '/assets/img/placeholder.svg',
	'quality' => 82,
	'content_width' => 1920,
	'sanitize_file_name' => true,
	'icon_set' => 'lucide',
	'sizes' => [
		[ 'name' => 'thumbnail', 'width' => 200, 'height' => 200 ],
		[ 'name' => 'small', 'width' => 480, 'height' => 480 ],
		[ 'name' => 'medium', 'width' => 768, 'height' => 768 ],
		[ 'name' => 'medium_large', 'width' => 1280, 'height' => 720 ],
		[ 'name' => 'large', 'width' => 1920, 'height' => 1080 ],
		[ 'name' => '1-1-small', 'width' => 480, 'height' => 480 ],
		[ 'name' => '1-1-medium', 'width' => 900, 'height' => 900 ],
		[ 'name' => '1-1-large', 'width' => 1200, 'height' => 1200 ],
		[ 'name' => '4-3-small', 'width' => 640, 'height' => 480 ],
		[ 'name' => '4-3-medium', 'width' => 960, 'height' => 720 ],
		[ 'name' => '4-3-large', 'width' => 1600, 'height' => 1200 ],
		[ 'name' => '16-9-small', 'width' => 960, 'height' => 540 ],
		[ 'name' => '16-9-medium', 'width' => 1280, 'height' => 720 ],
		[ 'name' => '16-9-large', 'width' => 1920, 'height' => 1080 ],
	],
	'woocommerce' => [
		'thumbnail' => [ 'width' => 300, 'height' => 300, 'crop' => true ],  // Shop/loop, categories, cart, checkout, emails, widgets
		'single' => [ 'width' => 600, 'height' => 0, 'crop' => false ], // Single product main image
		'gallery_thumbnail' => [ 'width' => 100, 'height' => 100, 'crop' => true ],  // Single product gallery thumbnails
	],
];
