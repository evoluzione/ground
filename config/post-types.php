<?php
return [
	'post_types' => [
		[
			'name' => 'ground_catalog',
			'args' => [
				'rewrite' => [
					'slug' => sanitize_title( __( 'catalog', 'ground' ) ),
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
					'name' => _x( 'Products', 'Post Type General Name', 'ground' ),
					'singular_name' => _x( 'Product', 'Post Type Singular Name', 'ground' ),
				],
				'has_archive' => false,
				'public' => true,
				'show_in_rest' => true,
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
				'labels' => [
					'name' => _x( 'Product Categories', 'Taxonomy General Name', 'ground' ),
					'singular_name' => _x( 'Product Category', 'Taxonomy Singular Name', 'ground' ),
				],
				'rewrite' => [
					'slug' => sanitize_title( __( 'catalog-category', 'ground' ) ),
					'hierarchical' => true,
					'with_front' => true,
				],
			]
		],
	],
];
