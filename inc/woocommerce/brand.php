<?php

/**
 * Register taxonomy
 */
function ground_register_taxonomy_product_brand() {

	$labels = array(
		'name'          => _x( 'Brand', 'Post Type General Name', 'ground' ),
		'singular_name' => _x( 'Brand', 'Post Type General Name', 'ground' ),
		'menu_name'     => __( 'Brand', 'ground' ),
	);

	$rewrite = array(
		'slug'         => __( 'product-brand', 'ground' ),
		'hierarchical' => true,
		'with_front'   => true,
	);

	$args = array(
		'hierarchical'      => true,
		'public'            => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'labels'            => $labels,
		'rewrite'           => $rewrite,
	);

	register_taxonomy( 'product_brand', 'product', $args );

}

add_action( 'init', 'ground_register_taxonomy_product_brand', 1 );
