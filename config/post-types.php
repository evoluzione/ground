<?php
return [ 
	'post_types' => [ 
		[ 
			'name' => 'ground_catalog',
			'args' => [ 
				'rewrite' => [ 
					'slug' => __( 'catalog', 'ground-child' ),
					'with_front' => true,
				],
				'supports' => [ 
					'title',
					'editor',
					'excerpt',
					'thumbnail',
					'comments',
					'revisions',
					'page-attributes',
				],
				'labels' => [ 
					'name' => _x( 'Products', 'Post Type General Name', 'ground-child' ),
					'singular_name' => _x( 'Product', 'Post Type Singular Name', 'ground-child' ),
				],
				'has_archive' => true,
				'public' => true,
				'show_in_rest' => false,
				'menu_position' => 5,
				'menu_icon' => 'dashicons-welcome-widgets-menus',
				'exclude_from_search' => false,
			]
		],
	],
	'taxonomies' => [ 
		[ 
			'name' => 'ground_catalog_taxonomy',
			'object_type' => 'ground_catalog',
			'args' => [ 
				'hierarchical' => true,
				'public' => true,
				'show_admin_column' => true,
				'rewrite' => [ 
					'slug' => __( 'catalog-category', 'ground-child' ),
					'hierarchical' => true,
					'with_front' => true,
				],
			]
		],
	],
];