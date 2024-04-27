<?php
function ground_theme_support() {

	// Enables featured image.
	add_theme_support( 'post-thumbnails' );

	// Html5 markup. This feature allows the use of HTML5 markup for the comment forms, search forms, comment lists and gallery.
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
		'style',
		'script'
	) );

	// Allows plugins and themes to manage the document title tag
	add_theme_support( 'title-tag' );

	// Add excerpt support for pages
	add_post_type_support( 'page', 'excerpt' );

	// Enables RSS posts and comments.
	if ( ground_config( 'theme.automatic-feed-links' ) ) {
		add_theme_support( 'automatic-feed-links' );
	}




	// Add Gutenberg block support
	// TODO: Verificare
	//add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-spacing' );



	// Add WooCommerce support
	// TODO: Verificare
	// add_theme_support( 'woocommerce', array(
	// 	'thumbnail_image_width' => 150,
	// 	'gallery_thumbnail_image_width' => 200, // TODO: Verificare se esiste
	// 	'single_image_width' => 300,
	// 	'product_grid' => array(
	// 		'default_rows' => 3,
	// 		'min_rows' => 2,
	// 		'max_rows' => 8,
	// 		'default_columns' => 4,
	// 		'min_columns' => 2,
	// 		'max_columns' => 5,
	// 	),
	// ) );
	// WooCommerce features
	// TODO: Verificare se utilizzarle e metterle anche nel config
	//add_theme_support( 'wc-product-gallery-zoom' );
	//add_theme_support( 'wc-product-gallery-lightbox' );
	//add_theme_support( 'wc-product-gallery-slider' );

}

add_action( 'after_setup_theme', 'ground_theme_support' );

/**
 * Register menus
 */
function ground_register_menus() {

	$locations = [];

	foreach ( ground_config( 'menus.menus' ) as $menu ) {
		$locations[ $menu['location'] ] = $menu['label'];
	}

	register_nav_menus( $locations );
}

add_action( 'init', 'ground_register_menus' );

/**
 * Thumbnails setup
 */
function ground_register_thumbnails() {

	// Registers a new image size.
	foreach ( ground_config( 'media.sizes' ) as $size ) {
		if ( isset( $size['name'] ) && isset( $size['width'] ) && isset( $size['height'] ) ) {
			$crop = isset( $size['crop'] ) ? $size['crop'] : false;
			add_image_size( $size['name'], $size['width'], $size['height'], $crop );
		} else {
			trigger_error( 'Error: Mandatory values (name, width, height) are missing in one of the image sizes.', E_USER_WARNING );
		}
	}

	// Set the maximum allowed width for any content, like oEmbeds and images added to posts.
	if ( ! isset( $content_width ) ) {
		$content_width = ground_config( 'media.content_width' );
	}

	// Set JPEG compression quality.
	add_filter( 'jpeg_quality', function ($arg) {
		return ground_config( 'media.quality' );
	} );

}

add_action( 'after_setup_theme', 'ground_register_thumbnails' );

/**
 * Register sidebars
 *
 * @return void
 */

function ground_register_sidebars() {

	$defaults = array(
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget__title text-2xl">',
		'after_title' => '</h2>'
	);

	foreach ( ground_config( 'sidebars.sidebars' ) as $sidebar ) {
		$args = wp_parse_args( $sidebar, $defaults );
		register_sidebar( $args );
	}

}

add_action( 'widgets_init', 'ground_register_sidebars' );

/**
 * Register post types
 */
function ground_register_post_types() {

	// Register post types
	foreach ( ground_config( 'post-types.post_types' ) as $post_type ) {
		if ( $post_type['name'] && $post_type['args'] ) {
			register_post_type( $post_type['name'], $post_type['args'] );
		}
	}

	// Register taxonomies
	foreach ( ground_config( 'post-types.taxonomies' ) as $taxonomy ) {
		if ( $taxonomy['name'] && $taxonomy['object_type'] && $taxonomy['args'] ) {
			register_taxonomy( $taxonomy['name'], $taxonomy['object_type'], $taxonomy['args'] );
		}
	}

}

add_action( 'init', 'ground_register_post_types', 2 );
