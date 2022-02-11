<?php

/**
 * Extend WordPress
 *
 * @package Ground
 */

/**
 * Register new image sizes
 */
function ground_thumbnail_size() {
	// Enables featured image.
	add_theme_support( 'post-thumbnails' );

	// WordPress default thumbnails.
	add_image_size( 'thumbnail', 200, 200, true );
	add_image_size( 'small', 480, 480, true );
	add_image_size( 'medium', 768, 768, true );
	add_image_size( 'medium_large', 1280, 720, true );
	add_image_size( 'large', 1920, 1080, true );

	// Custom ratio thumbnails.
	add_image_size( '1-1-small', 480, 480, array( 'center', 'center' ) );
	add_image_size( '1-1-medium', 900, 900, array( 'center', 'center' ) );
	add_image_size( '1-1-large', 1200, 1200, array( 'center', 'center' ) );

	add_image_size( '3-4-small', 480, 640, array( 'center', 'center' ) );
	add_image_size( '3-4-medium', 900, 1200, array( 'center', 'center' ) );
	add_image_size( '3-4-large', 1200, 1600, array( 'center', 'center' ) );

	add_image_size( '4-3-small', 640, 480, array( 'center', 'center' ) );
	add_image_size( '4-3-medium', 960, 720, array( 'center', 'center' ) );
	add_image_size( '4-3-large', 1600, 1200, array( 'center', 'center' ) );

	add_image_size( '16-9-small', 960, 540, array( 'center', 'center' ) );
	add_image_size( '16-9-medium', 1280, 720, array( 'center', 'center' ) );
	add_image_size( '16-9-large', 1920, 1080, array( 'center', 'center' ) );
}

add_action( 'after_setup_theme', 'ground_thumbnail_size' );

/**
 * Register menu
 */
function ground_register_menu() {
	// This feature enables menus support.
	add_theme_support( 'menus' );

	// Registers multiple custom navigation menus in the custom menu editor.
	$locations = array(
		'header-primary'   => __( 'Navigation header primary ', 'ground-admin' ),
		'header-secondary' => __( 'Navigation header secondary', 'ground-admin' ),
		'footer-primary'   => __( 'Navigation footer primary', 'ground-admin' ),
		'footer-secondary' => __( 'Navigation footer secondary', 'ground-admin' ),
		'footer-tertiary'  => __( 'Navigation footer tertiary', 'ground-admin' ),
		'panel-primary'    => __( 'Navigation panel primary', 'ground-admin' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'ground_register_menu' );


/**
 * Add support custom logo
 */
function ground_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true,
	);

	add_theme_support( 'custom-logo', $defaults );
}

add_action( 'after_setup_theme', 'ground_custom_logo_setup' );

/**
 * Content width
 *
 * It represents the maximum width of the content area excluding margin and padding
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1920;
}

/**
 * Localization
 *
 * Load the theme’s translated strings
 */
function ground_load_theme_textdomain() {
	load_theme_textdomain( 'ground-admin', GROUND_TEMPLATE_PATH . '/languages' );
	load_theme_textdomain( 'ground', GROUND_TEMPLATE_PATH . '/languages' );
}

add_action( 'after_setup_theme', 'ground_load_theme_textdomain' );

/**
 * Add excerpt support for pages
 */
function ground_page_excerpt() {
	add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init', 'ground_page_excerpt' );

/**
 * Excerpt with custom lenght
 *
 * Summary or description of a post with custom lenght
 *
 * @param integer          $length Optional. Excerpt length. Default is 100.
 * @param string           $after_text Optional. Characters to add at the end of the text. Default is "...".
 * @param int|WP_Post|null $post Optional. Post ID or post object. Default is global $post.
 */
function ground_excerpt( $length = 100, $after_text = '...', $post = null ) {

	if ( null !== $post ) {
		$_post = get_post( $post );
		if ( '' !== $_post->post_excerpt ) {
			$post_content = $_post->post_excerpt;
		} else {
			$post_content = $_post->post_content;
		}
		$content = wp_strip_all_tags( $post_content );
		$excerpt = mb_substr( $content, 0, $length, GROUND_CHARSET );
	} else {
		$content = get_the_excerpt();
		$excerpt = mb_substr( $content, 0, $length, GROUND_CHARSET );
	}

	if ( strlen( $content ) > $length ) {
		$excerpt = $excerpt . $after_text;
	}

	echo esc_html( $excerpt );
}

/**
 * Trim title length
 *
 * Show the first N title chars
 *
 * @param integer     $length Optional. Title length. Default is 10.
 * @param string      $after_text Optional. Characters to add at the end of the text. Default is "...".
 * @param int|WP_Post $post Optional. Post ID or WP_Post object. Default is global $post.
 */
function ground_trim_title( $length = 10, $after_text = '...', $post = 0 ) {

	$title = get_the_title( $post );

	if ( strlen( $title ) > $length ) {
		$title = mb_substr( $title, 0, $length, GROUND_CHARSET );
		echo esc_html( $title . $after_text );
	} else {
		echo esc_html( $title );
	}
}

/**
 * Remove special characters from uploaded files
 *
 * Converts all accent characters to ASCII characters.
 *
 * @param string $filename The filename to be sanitized.
 * @return string The sanitized filename.
 */
function ground_sanitize_uploads( $filename ) {
	return remove_accents( $filename );
}

add_filter( 'sanitize_file_name', 'ground_sanitize_uploads', 10 );

/**
 * Html5 markup
 *
 * This feature allows the use of HTML5 markup for the comment forms, search forms, comment lists and gallery.
 */
function ground_markup() {
	$markup = array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style',
	);

	add_theme_support( 'html5', $markup );
}

add_action( 'after_setup_theme', 'ground_markup' );

/**
 * Add WooCommerce support
 */
function ground_add_woocommerce_support() {
	add_theme_support(
		'woocommerce',
		// array(
		// 'thumbnail_image_width'         => 200,
		// 'gallery_thumbnail_image_width' => 200,
		// 'single_image_width'            => 900,
		// )
	);
}

add_action( 'after_setup_theme', 'ground_add_woocommerce_support' );

/**
 * Remove Paragraph Tags From Around Images
 *
 * @param string $content The content to be cleaned.
 * @return string The cleaned content.
 */
function ground_remove_p_around_img( $content ) {
	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}

add_filter( 'the_content', 'ground_remove_p_around_img' );

/**
 * Remove the maximum image width in a ‘srcset’ attribute.
 *
 * @param int $max_width The maximum image width to be included in the 'srcset'. Default '2048'.
 */
function ground_remove_max_srcset_image_width( $max_width ) {
	return false;
}

add_filter( 'max_srcset_image_width', 'ground_remove_max_srcset_image_width' );

/**
 * Remove width and height attributes from inserted images
 *
 * @param string $html The html to be cleaned.
 * @return string The cleaned html
 */
function ground_remove_img_size( $html ) {
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	return $html;
}

add_filter( 'post_thumbnail_html', 'ground_remove_img_size', 10 );
add_filter( 'image_send_to_editor', 'ground_remove_img_size', 10 );

/**
 * Gets the featured image of a specifific post
 *
 * @param string           $size Image size name.
 * @param int|WP_Post|null $post Optional. Post ID or post object. Default is global $post.
 * @param boolean          $url Optional. Return url or image array. Default return url.
 * @param boolean          $echo Optional. Echo returned url. Default echo the url.
 * @return array|string
 */
function ground_image( $size = 'thumbnail', $post = null, $url = true, $echo = true ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), $size );
	$image = ( $url ) ? $image[0] : $image;
	if ( $echo ) {
		echo esc_html( $image );
	} else {
		return $image;
	}
}

/**
 * Get icons
 *
 * @param string  $name Name of the icon.
 * @param string  $additional_class Optional. Html class. Default is empty.
 * @param boolean $url Optional. Return url. Default is false.
 * @param string  $extension Optional. Default echo HTML.
 * @param string  $tag Optional. HTML tag wrapper.
 * @param boolean $return Optional. Return string instead echo.
 */
function ground_icon( $name = '', $additional_class = '', $url = false, $extension = 'svg', $tag = 'span', $return = false ) {
	if ( '' === $name ) {
		return;
	}
	if ( $url ) {
		return GROUND_TEMPLATE_URL . '/img/icons/' . $name . '.' . $extension;
	} else {
		$markup  = '<' . $tag . ' class="icon icon--' . $name . ' ' . $additional_class . '">';
		$markup .= file_get_contents( GROUND_TEMPLATE_PATH . '/img/icons/' . $name . '.' . $extension );
		$markup .= '</' . $tag . '>';

		if ( $return ) {
			return $markup;
		} else {
			echo $markup;
		}
	}
}

/**
 * Add attachment gallery attributes
 *
 * @param string $link Attachment page link.
 * @param int    $id Post ID or post object.
 * @return string
 */
function ground_gallery_modal( $link, $id ) {
	$image_attributes = wp_get_attachment_image_src( $id, 'full' );
	return str_replace( '<a href', '<a data-modal="gallery" data-modal-size="' . $image_attributes[1] . 'x' . $image_attributes[2] . '" data-router-disabled href', $link );
}

add_filter( 'wp_get_attachment_link', 'ground_gallery_modal', 10, 6 );

/**
 * Highlight archive and wp_nav_menu parents
 *
 * @param array   $classes Array of the CSS classes that are applied to the menu item's <li> element.
 * @param boolean $menu_item The current menu item.
 * @return array
 */
function ground_custom_parent_menu_item_classes( $classes = array(), $menu_item = false ) {
	global $post;
	$id = ( isset( $post->ID ) ? get_the_ID() : null );
	if ( isset( $id ) ) {
		$classes[] = ( get_post_type_archive_link( $post->post_type ) === $menu_item->url ) ? 'navigation__item--ancestor' : '';
	}
	return $classes;
}

add_filter( 'nav_menu_css_class', 'ground_custom_parent_menu_item_classes', 10, 2 );

/**
 * Custom body class
 *
 * @param string|string[] $classes Space-separated string or array of class names to add to the class list.
 * @return string|string[]
 */
function ground_body_class( $classes ) {

	if ( current_user_can( 'administrator' ) ) {
		$classes[] = 'debug-screens';
	}

	return $classes;
}

add_filter( 'body_class', 'ground_body_class' );

/**
 * Save ACF local JSON
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/
 * @param string $path ACF JSON path.
 * @return string
 */
function ground_acf_json_save_point() {
	return get_stylesheet_directory() . '/data/acf';
}

add_filter( 'acf/settings/save_json', 'ground_acf_json_save_point' );



/**
 * Load ACF local JSON
 *
 * @link https://www.advancedcustomfields.com/resources/local-json/
 * @param string $paths ACF JSON path.
 * @return string
 */
function ground_acf_json_load_point( $paths ) {

	unset( $paths[0] );
	$paths[] = get_stylesheet_directory() . '/data/acf';
	return $paths;

}

add_filter( 'acf/settings/load_json', 'ground_acf_json_load_point' );


/**
 * Oembed responsive
 *
 * @param string|false $cache The cached HTML result, stored in post meta.
 * @param string       $url The attempted embed URL.
 * @param array        $attr An array of shortcode attributes.
 * @param int          $post_ID Post ID.
 * @return string
 */
function ground_oembed_responsive( $cache, $url, $attr, $post_ID ) {

	if ( strpos( $url, 'vimeo.com' ) !== false || strpos( $url, 'youtube.com' ) !== false || strpos( $url, 'youtu.be' ) !== false ) {
		$class = 'aspect-w-16 aspect-h-9';
		return '<div class="' . $class . '">' . $cache . '</div>';
	}
}

add_filter( 'embed_oembed_html', 'ground_oembed_responsive', 99, 4 );

/**
 * Rename attachment slug
 *
 * @param int $post_ID Attachment ID.
 */
function ground_rename_attachment_slug( $post_ID ) {
	wp_update_post(
		array(
			'ID'        => $post_ID,
			'post_name' => uniqid( '-' ),
		)
	);
}

add_action( 'add_attachment', 'ground_rename_attachment_slug' );

/**
 * Echoes the highway ajax navigation view name tag
 */
function ground_view_name() {
	global $wp_query;

	if ( is_front_page() ) {
		$view_name = 'home';
	} elseif ( is_page_template( 'templates/template-ground_catalog.php' ) ) {
		$view_name = 'catalog';
	} elseif ( is_home() ) {
		$view_name = 'blog';
	} elseif ( is_search() ) {
		$view_name = 'search';
	} elseif ( is_archive() ) {
		$view_name = 'archive';
	} else {
		$view_name = 'page';
	}

	echo 'data-router-view="' . esc_html( $view_name ) . '"';
}

/**
 * Custom Breadcrumb using Yoast SEO Plugin
 *
 * @link https://fellowtuts.com/wordpress/custom-breadcrumb-navigation-yoast-seo/
 * @return void
 */
function ground_yoast_breadcrumb() {
	$crumb = array();
	$dom   = new DOMDocument();

	if ( yoast_breadcrumb( '', '', false ) ) {
		$dom->loadHTML( '<?xml encoding="' . get_bloginfo( 'charset' ) . '" ?>' . yoast_breadcrumb( '', '', false ) );
	}

	$items = $dom->getElementsByTagName( 'a' );

	foreach ( $items as $tag ) {
		$crumb[] = array(
			'text' => $tag->nodeValue,
			'href' => $tag->getAttribute( 'href' ),
		);
	}

	// Get the current page text and href.
	$items = new DOMXpath( $dom );
	$dom   = $items->query( '//*[contains(@class, "breadcrumb_last")]' );

	if ( $dom->item( 0 ) && $dom->item( 0 )->nodeValue ) {
		$crumb[] = array(
			'text' => $dom->item( 0 )->nodeValue,
			'href' => '',
		);
	}

	$html = '';
	if ( $crumb ) {
		$items = count( $crumb ) - 1;
		$html  = '<nav class="breadcrumb">';
		$html .= '<ol class="breadcrumb__list">';
		foreach ( $crumb as $k => $v ) {
			$html .= '<li class="breadcrumb__item">';
			if ( $k === $items ) { // If it's the last item then output the text only.
				$html .= $v['text'];
			} else { // Preceding items with URLs.
				$html .= sprintf( '<a class="breadcrumb__link" href="%s">%s</a>', $v['href'], $v['text'] );
			}
			$html .= '</li>';
		}
		$html .= '</ol>';
		$html .= '</nav>';
	}
	echo wp_kses_post( $html );
}

/**
 * Ajax search result
 */
function ground_ajax_search_data_fetch() {
	ob_start();
	get_template_part( 'partials/abstract-ajax-search' );
	return ob_get_clean();
}

add_action( 'wp_ajax_data_fetch', 'ground_ajax_search_data_fetch' );
add_action( 'wp_ajax_nopriv_data_fetch', 'ground_ajax_search_data_fetch' );

/**
 * WMPL - Switch Language
 */
function ground_language_switch() {
	ob_start();
	get_template_part( 'partials/switch-language' );
	return ob_get_clean();
}

/**
 * Write log in /wp-content/debug.log
 * Enable WP_DEBUG and WP_DEBUG_LOG
 *
 * @param mixed $log Logging data.
 */
function ground_log( $log ) {
	if ( true === WP_DEBUG && true === WP_DEBUG_LOG ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}

/**
 * Header, Add header switch type
 */
function ground_header_type() {

	if ( class_exists( 'WooCommerce' ) && is_checkout() ) {
		return;
	}

	$header_type = GROUND_HEADER_TYPE;
	switch ( $header_type ) {
		case 'menu':
			get_template_part( 'partials/headers/header', 'simple' );
			break;
		case 'menuCentered':
			get_template_part( 'partials/headers/header', 'logo-centered' );
			break;
		case 'megaMenu':
			get_template_part( 'partials/headers/header', 'mega-menu' );
			break;
		default:
			get_template_part( 'partials/headers/header', 'simple' );
	}

}

add_action( 'ground_header', 'ground_header_type', 10 );

/**
 * Footer, Add pre footer partials
 */
function ground_pre_footer() {
	get_template_part( 'partials/pre-footer' );
}

add_action( 'ground_footer', 'ground_pre_footer', 5 );

/**
 * Footer, Add newsletter partials
 */
function ground_newsletter() {
	get_template_part( 'partials/newsletter' );
}

add_action( 'ground_footer', 'ground_newsletter', 8 );

/**
 * Footer, Add footer switch type
 */
function ground_footer_type() {
	get_template_part( 'partials/footers/footer', 'simple' );
}

add_action( 'ground_footer', 'ground_footer_type', 10 );

/**
 * Register custom Sidebar archive post
 *
 * @return void
 */
function ground_widget_registration( $name, $id ) {
	register_sidebar(
		array(
			'name'          => $name,
			'id'            => $id,
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
		)
	);
}

function ground_multiple_widget_init() {
	ground_widget_registration( __( 'Sidebar archive post', 'ground' ), 'sidebar-archive-post' );
	ground_widget_registration( __( 'Sidebar footer primary', 'ground' ), 'sidebar-footer-primary' );
	ground_widget_registration( __( 'Sidebar footer secondary', 'ground' ), 'sidebar-footer-secondary' );
	ground_widget_registration( __( 'Sidebar footer tertiary', 'ground' ), 'sidebar-footer-tertiary' );
	ground_widget_registration( __( 'Sidebar footer quaternary', 'ground' ), 'sidebar-footer-quaternary' );
}

add_action( 'widgets_init', 'ground_multiple_widget_init' );

/**
 * Remove "Category:", "Tag:", "Author:" from the_archive_title
 *
 * @return void
 */

add_filter(
	'get_the_archive_title',
	function ( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_tax() ) { // for custom post types
			$title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}
		return $title;
	}
);
