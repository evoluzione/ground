<?php
/**
 * Localization
 *
 * Load the theme’s translated strings
 */
function ground_load_theme_textdomain() {
	load_theme_textdomain( 'ground', GROUND_TEMPLATE_PATH . '/languages' );
}

add_action( 'after_setup_theme', 'ground_load_theme_textdomain' );

/**
 * Remove special characters from uploaded files
 *
 * Converts all accent characters to ASCII characters.
 *
 * @param string $filename The filename to be sanitized.
 * @return string The sanitized filename.
 */
function ground_sanitize_uploads( $filename ) {
	if ( ground_config( 'media.sanitize_file_name' ) ) {
		return remove_accents( $filename );
	} else {
		return $filename;
	}
}

add_filter( 'sanitize_file_name', 'ground_sanitize_uploads', 10 );

/**
 * Custom body class
 *
 * @param string|string[] $classes Space-separated string or array of class names to add to the class list.
 * @return string|string[]
 */
function ground_body_class( $classes ) {

	if ( ground_config( 'theme.debug' ) ) {
		$classes[] = 'debug-screens';
	}

	return $classes;
}

add_filter( 'body_class', 'ground_body_class' );

/**
 * Archive title without prefix ("Category:", "Tag:", "Author:")
 */
function ground_remove_archive_title_prefixes( $title, $original_title ) {
	return $original_title;
}

add_filter( 'get_the_archive_title', 'ground_remove_archive_title_prefixes', 10, 2 );

/**
 * Filters the CSS classes applied to a menu item.
 *
 * @param array   $classes    An array of the CSS classes that are applied to the menu item's <li> element.
 * @param WP_Post $menu_item  The current menu item.
 * @param stdClass $args      An object of wp_nav_menu() arguments.
 * @param int     $depth      Depth of menu item. Used for padding.
 * @return array  Modified array of CSS classes.
 */
function ground_nav_menu_css_class( $classes, $menu_item, $args, $depth ) {

	$remove_default_class = $args->remove_default_class ?? false;
	$item_class = $args->item_class ?? '';
	$item_class_depth = $args->{'item_class_' . $depth} ?? '';
	$item_active_class = $args->item_active_class ?? '';
	$item_parent_class = $args->item_parent_class ?? '';
	$item_ancestor_class = $args->item_ancestor_class ?? '';

	if ( $remove_default_class === true ) {
		$classes = array();
	} elseif ( is_array( $remove_default_class ) ) {
		$classes = array_diff( $classes, $remove_default_class );
	}

	if ( $item_class ) {
		$classes[] = $item_class;
	}

	if ( $item_class_depth ) {
		$classes[] = $item_class_depth;
	}

	if ( $menu_item->current && $item_active_class ) {
		$classes[] = $item_active_class;
	}

	if ( $menu_item->current_item_parent && $item_parent_class ) {
		$classes[] = $item_parent_class;
	}

	if ( $menu_item->current_item_ancestor && $item_ancestor_class ) {
		$classes[] = $item_ancestor_class;
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'ground_nav_menu_css_class', 1, 4 );

/**
 * Filters the CSS classes applied to a submenu.
 *
 * @param array    $classes An array of the CSS classes that are applied to the submenu's <ul> element.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 * @param int      $depth   Depth of menu item. Used for padding.
 * @return array   Modified array of CSS classes.
 */
function ground_nav_menu_submenu_css_class( $classes, $args, $depth ) {

	$remove_default_class = $args->remove_default_class ?? false;
	$submenu_class = $args->submenu_class ?? '';
	$submenu_class_depth = $args->{'submenu_class_' . $depth} ?? '';

	if ( $remove_default_class === true ) {
		$classes = array();
	} elseif ( is_array( $remove_default_class ) ) {
		$classes = array_diff( $classes, $remove_default_class );
	}

	if ( $submenu_class ) {
		$classes[] = $submenu_class;
	}

	if ( $submenu_class_depth ) {
		$classes[] = $submenu_class_depth;
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'ground_nav_menu_submenu_css_class', 10, 3 );

/**
 * Filters the CSS classes applied to a menu link.
 *
 * @param array    $atts   The HTML attributes applied to the menu item's <a> element, empty strings are ignored.
 * @param WP_Post  $item   The current menu item.
 * @param stdClass $args   An object of wp_nav_menu() arguments.
 * @param int      $depth  Depth of menu item. Used for padding.
 * @return array   Modified array of HTML attributes.
 */
function ground_nav_menu_link_css_class( $atts, $item, $args, $depth ) {
	$remove_default_class = $args->remove_default_class ?? false;
	$link_class = $args->link_class ?? '';
	$link_class_depth = $args->{'link_class_' . $depth} ?? '';
	$link_active_class = $args->link_active_class ?? '';
	$link_parent_class = $args->link_parent_class ?? '';
	$link_ancestor_class = $args->link_ancestor_class ?? '';

	if ( $remove_default_class === true ) {
		$atts['class'] = '';
	} elseif ( is_array( $remove_default_class ) ) {
		$existing_classes = explode( ' ', $atts['class'] );
		$atts['class'] = implode( ' ', array_diff( $existing_classes, $remove_default_class ) );
	}

	if ( $link_class ) {
		$atts['class'] .= ' ' . $link_class;
	}

	if ( $link_class_depth ) {
		$atts['class'] .= ' ' . $link_class_depth;
	}

	if ( $item->current && $link_active_class ) {
		$atts['class'] .= ' ' . $link_active_class;
	}

	if ( $item->current_item_parent && $link_parent_class ) {
		$atts['class'] .= ' ' . $link_parent_class;
	}

	if ( $item->current_item_ancestor && $link_ancestor_class ) {
		$atts['class'] .= ' ' . $link_ancestor_class;
	}

	$atts['class'] = trim( $atts['class'] );

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'ground_nav_menu_link_css_class', 10, 4 );

/**
 * Save ACF local JSON
 *
 * @return string The custom path for saving ACF JSON files.
 */
function ground_acf_json_save_point() {
	return GROUND_TEMPLATE_PATH . '/config/acf';
}

add_filter( 'acf/settings/save_json', 'ground_acf_json_save_point' );

/**
 * Load ACF local JSON
 *
 * @param array $paths The original paths array provided by ACF.
 * @return array The modified paths array with the custom path added.
 */
function ground_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = GROUND_TEMPLATE_PATH . '/config/acf';
	return $paths;
}

add_filter( 'acf/settings/load_json', 'ground_acf_json_load_point' );