<?php
return [ 
	'styles' => [ 
		[ 
			'handle' => 'ground-styles',
			'src' => GROUND_TEMPLATE_DIRECTORY_URI . '/dist/css/ground-styles.min.css',
			'deps' => [],
			'ver' => GROUND_VERSION,
			'media' => 'all',
		],
	],
	'scripts' => [ 
		[ 
			'handle' => 'ground-scripts',
			'src' => GROUND_TEMPLATE_DIRECTORY_URI . '/dist/js/ground-scripts.min.js',
			'deps' => [ 'jquery' ],
			'ver' => GROUND_VERSION,
			'args' => [ 
				'strategy' => '', // May be either 'defer' or 'async'.
				'in_footer' => true,
			],
		],
	]
];