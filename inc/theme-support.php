<?php
/**
 * Adds theme support features.
 *
 * @return void
 */
function ground_theme_support() {

	// Enables featured images.
	add_theme_support( 'post-thumbnails' );

	// Enables HTML5 markup support.
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
		'style',
		'script'
	) );

	// Allows plugins and themes to manage the document title tag.
	add_theme_support( 'title-tag' );

	// Add excerpt support for pages.
	add_post_type_support( 'page', 'excerpt' );

	// Enables RSS posts and comments.
	if ( ground_config( 'theme.automatic-feed-links' ) ) {
		add_theme_support( 'automatic-feed-links' );
	}

	// Gutenberg editor features.
	// TODO: Verificare se utilizzarle e metterle anche nel config
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-spacing' );

}

add_action( 'after_setup_theme', 'ground_theme_support' );

/**
 * Registers navigation menus.
 *
 * @return void
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
 * Registers custom thumbnail sizes and sets media configurations.
 *
 * @return void
 */
function ground_register_thumbnails() {

	// Registers custom image sizes.
	foreach ( ground_config( 'media.sizes' ) as $size ) {
		if ( isset( $size['name'], $size['width'], $size['height'] ) ) {
			$crop = $size['crop'] ?? false;
			add_image_size( $size['name'], $size['width'], $size['height'], $crop );
		} else {
			trigger_error( 'Error: Mandatory values (name, width, height) are missing in one of the image sizes.', E_USER_WARNING );
		}
	}

	// Sets the maximum allowed content width.
	if ( ! isset( $content_width ) ) {
		$content_width = ground_config( 'media.content_width' );
	}

	// Set JPEG compression quality.
	add_filter( 'jpeg_quality', function ( $arg ) {
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
 * Registers custom post types and taxonomies.
 *
 * @return void
 */
function ground_register_post_types() {

	// Registers custom post types.
	foreach ( ground_config( 'post-types.post_types' ) as $post_type ) {
		if ( isset( $post_type['name'], $post_type['args'] ) ) {
			register_post_type( $post_type['name'], $post_type['args'] );
		}
	}

	// Registers custom taxonomies.
	foreach ( ground_config( 'post-types.taxonomies' ) as $taxonomy ) {
		if ( isset( $taxonomy['name'], $taxonomy['object_type'], $taxonomy['args'] ) ) {
			register_taxonomy( $taxonomy['name'], $taxonomy['object_type'], $taxonomy['args'] );
		}
	}

}

add_action( 'init', 'ground_register_post_types', 2 );
