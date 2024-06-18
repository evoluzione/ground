<?php
return [ 
	'placeholder_url' => GROUND_TEMPLATE_URL . '/assets/img/no-image.svg',
	'quality' => 82,
	'content_width' => 1920,
	'sanitize_file_name' => true,
	'sizes' => [ 
		[ 
			'name' => "thumbnail",
			'width' => 200,
			'height' => 200,
			'crop' => true,
		],
		[ 
			'name' => "small",
			'width' => 480,
			'height' => 480,
			'crop' => true,
		],
		[ 
			'name' => "medium",
			'width' => 768,
			'height' => 768,
			'crop' => true,
		],
		[ 
			'name' => "medium_large",
			'width' => 1280,
			'height' => 720,
			'crop' => true,
		],
		[ 
			'name' => "large",
			'width' => 1920,
			'height' => 1080,
			'crop' => true,
		],
		[ 
			'name' => "1-1-small",
			'width' => 480,
			'height' => 480,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "1-1-medium",
			'width' => 900,
			'height' => 900,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "1-1-large",
			'width' => 1200,
			'height' => 1200,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "3-4-small",
			'width' => 480,
			'height' => 640,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "3-4-medium",
			'width' => 900,
			'height' => 1200,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "3-4-large",
			'width' => 1200,
			'height' => 1600,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "4-3-small",
			'width' => 640,
			'height' => 480,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "4-3-medium",
			'width' => 960,
			'height' => 720,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "4-3-large",
			'width' => 1600,
			'height' => 1200,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "16-9-small",
			'width' => 960,
			'height' => 540,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "16-9-medium",
			'width' => 1280,
			'height' => 720,
			'crop' => array(
				'center',
				'center'
			),
		],
		[ 
			'name' => "16-9-large",
			'width' => 1920,
			'height' => 1080,
			'crop' => array(
				'center',
				'center'
			),
		],
	]
];