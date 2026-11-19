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

	// oEmbeds (YouTube, Vimeo…) scale to the column they sit in instead of keeping
	// the fixed width wp_embed_defaults() asks the provider for ($content_width).
	add_theme_support( 'responsive-embeds' );

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
 * Reads config/media.php ('media.sizes'). Entries prefixed 'woocommerce_' are
 * handled in inc/woocommerce.php instead.
 *
 * @return void
 */
function ground_register_thumbnails() {

	global $content_width;

	$core_slots = array( 'thumbnail', 'medium', 'medium_large', 'large' );

	// Registers custom image sizes.
	foreach ( (array) ground_config( 'media.sizes' ) as $name => $size ) {
		if ( str_starts_with( $name, 'woocommerce_' ) ) {
			continue;
		}

		if ( ! isset( $size['width'], $size['height'] ) ) {
			trigger_error( sprintf( 'Error: image size "%s" is missing width or height.', $name ), E_USER_WARNING );
			continue;
		}

		$width = (int) $size['width'];
		$height = ( (int) $size['height'] ) ?: 9999; // 0 means width-only; 9999 is WordPress's idiom for it.
		$crop = ! empty( $size['crop'] );

		add_image_size( $name, $width, $height, $crop );

		// add_image_size() decides which file is generated, but for these four
		// the dimensions reported in markup come from the options — mirror them
		// or the markup advertises one size while serving another.
		if ( in_array( $name, $core_slots, true ) ) {
			add_filter( "pre_option_{$name}_size_w", static fn() => $width );
			add_filter( "pre_option_{$name}_size_h", static fn() => $height );

			if ( 'thumbnail' === $name ) {
				add_filter( 'pre_option_thumbnail_crop', static fn() => $crop ? 1 : 0 );
			}
		}
	}

	// Sets the maximum allowed content width.
	if ( ! isset( $content_width ) ) {
		$content_width = ground_config( 'media.content_width' );
	}

	// Sets compression quality for every output format, WebP included — after
	// Modern Image Formats, which pins WebP to its own value at priority 10.
	add_filter( 'wp_editor_set_quality', function ( $arg ) {
		return ground_config( 'media.quality' );
	}, 20 );

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
	global $wp_rewrite;

	// Registers custom post types.
	foreach ( ground_config( 'post-types.post_types' ) as $name => $post_type ) {
		if ( ! isset( $post_type['args'] ) ) {
			continue;
		}

		register_post_type( $name, $post_type['args'] );

		$object = get_post_type_object( $name );
		$slug = $object->rewrite['slug'] ?? '';

		// Without an archive the listing is a page (templates/template-{post_type}.php).
		// When it shares the post type's slug, its /page/N/ would be read as a
		// single named "page": this rule, ahead of the post type's, sends it to
		// the page. The page is the slug found in the URL, not a fixed one, so the
		// rule holds when WPML translates the post type's slug.
		if ( $slug && $object->public && ! $object->has_archive ) {
			add_rewrite_rule(
				"({$slug})/{$wp_rewrite->pagination_base}/?([0-9]{1,})/?$",
				'index.php?pagename=$matches[1]&paged=$matches[2]',
				'top'
			);
		}
	}

	// Registers custom taxonomies.
	foreach ( ground_config( 'post-types.taxonomies' ) as $name => $taxonomy ) {
		if ( isset( $taxonomy['object_type'], $taxonomy['args'] ) ) {
			register_taxonomy( $name, $taxonomy['object_type'], $taxonomy['args'] );
		}
	}

}

add_action( 'init', 'ground_register_post_types', 2 );
