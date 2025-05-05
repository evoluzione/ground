<?php
/**
 * Localization
 *
 * Load the theme's translated strings
 */
function ground_load_theme_textdomain() {
	load_theme_textdomain( 'ground', GROUND_TEMPLATE_DIRECTORY . '/languages' );
}

add_action( 'after_setup_theme', 'ground_load_theme_textdomain' );

/**
 * Sanitize uploaded filenames by removing special characters and accents.
 *
 * @param string $filename The original filename.
 * @return string The sanitized filename.
 */
function ground_sanitize_uploaded_filename( $filename ) {
    if ( ! ground_config( 'media.sanitize_file_name' ) ) {
        return $filename;
    }

    return remove_accents( $filename );
}

add_filter( 'sanitize_file_name', 'ground_sanitize_uploaded_filename', 9 );

/**
 * Custom body class
 *
 * @param string|string[] $classes Space-separated string or array of class names to add to the class list.
 * @return string|string[]
 */
function ground_body_class( $classes ) {

	if ( ground_config( 'theme.debug_breakpoints' ) ) {
		$classes[] = 'debug-screens';
	}

	return $classes;
}

add_filter( 'body_class', 'ground_body_class' );

/**
 * Removes the default prefix from archive titles (e.g., "Category:", "Tag:", "Author:").
 *
 * @param string $title          The archive title with the default prefix.
 * @param string $original_title The raw archive title without any prefix.
 * @return string                The cleaned archive title.
 */
function ground_remove_archive_title_prefixes( $title, $original_title ) {
	return $original_title;
}

add_filter( 'get_the_archive_title', 'ground_remove_archive_title_prefixes', 10, 2 );

/**
 * Filters the CSS classes applied to a menu item.
 *
 * @param array    $classes    An array of the CSS classes that are applied to the menu item's <li> element.
 * @param WP_Post  $menu_item  The current menu item.
 * @param stdClass $args       An object of wp_nav_menu() arguments. Supports 'merge_classes' (bool).
 * @param int      $depth      Depth of menu item. Used for padding.
 * @return array   Modified array of CSS classes.
 */
function ground_nav_menu_css_class( $classes, $menu_item, $args, $depth ) {
	$depth_key = $depth + 1;
	$remove_default_class = $args->remove_default_class ?? false;
	$merge_classes = $args->merge_classes ?? false;

	$item_class = $args->item_class ?? '';
	$item_class_depth = $args->{'item_class_' . $depth_key} ?? '';
	$item_active_class = $args->item_active_class ?? '';
	$item_active_class_depth = $args->{'item_active_class_' . $depth_key} ?? '';
	$item_parent_class = $args->item_parent_class ?? '';
	$item_parent_class_depth = $args->{'item_parent_class_' . $depth_key} ?? '';
	$item_ancestor_class = $args->item_ancestor_class ?? '';
	$item_ancestor_class_depth = $args->{'item_ancestor_class_' . $depth_key} ?? '';

	if ( $remove_default_class === true ) {
		$classes = array();
	} elseif ( is_array( $remove_default_class ) ) {
		$classes = array_diff( $classes, $remove_default_class );
	}

	if ( $merge_classes ) {
		if ( $menu_item->current ) {
			$classes[] = $item_active_class_depth ?: $item_active_class;
		} elseif ( $menu_item->current_item_parent ) {
			$classes[] = $item_parent_class_depth ?: $item_parent_class;
		} elseif ( $menu_item->current_item_ancestor ) {
			$classes[] = $item_ancestor_class_depth ?: $item_ancestor_class;
		} else {
			$classes[] = $item_class_depth ?: $item_class;
		}
	} else {
		if ( $item_class ) {
			$classes[] = $item_class;
		}
		if ( $item_class_depth ) {
			$classes[] = $item_class_depth;
		}
		if ( $menu_item->current ) {
			if ( $item_active_class ) {
				$classes[] = $item_active_class;
			}
			if ( $item_active_class_depth ) {
				$classes[] = $item_active_class_depth;
			}
		}
		if ( $menu_item->current_item_parent ) {
			if ( $item_parent_class ) {
				$classes[] = $item_parent_class;
			}
			if ( $item_parent_class_depth ) {
				$classes[] = $item_parent_class_depth;
			}
		}
		if ( $menu_item->current_item_ancestor ) {
			if ( $item_ancestor_class ) {
				$classes[] = $item_ancestor_class;
			}
			if ( $item_ancestor_class_depth ) {
				$classes[] = $item_ancestor_class_depth;
			}
		}
	}

	return array_filter( array_unique( $classes ) );
}

add_filter( 'nav_menu_css_class', 'ground_nav_menu_css_class', 1, 4 );

/**
 * Filters the CSS classes applied to a submenu.
 *
 * @param array    $classes An array of the CSS classes that are applied to the submenu's <ul> element.
 * @param stdClass $args    An object of wp_nav_menu() arguments. Supports 'merge_classes' (bool).
 * @param int      $depth   Depth of menu item. Used for padding.
 * @return array   Modified array of CSS classes.
 */
function ground_nav_menu_submenu_css_class( $classes, $args, $depth ) {
	$remove_default_class = $args->remove_default_class ?? false;
	$merge_classes = $args->merge_classes ?? false;
	$depth_key = $depth + 1;
	$submenu_class = $args->submenu_class ?? '';
	$submenu_class_depth = $args->{'submenu_class_' . $depth_key} ?? '';

	if ( $remove_default_class === true ) {
		$classes = array();
	} elseif ( is_array( $remove_default_class ) ) {
		$classes = array_diff( $classes, $remove_default_class );
	}

	if ( $merge_classes ) {
		$classes[] = $submenu_class_depth ?: $submenu_class;
	} else {
		if ( $submenu_class ) {
			$classes[] = $submenu_class;
		}
		if ( $submenu_class_depth ) {
			$classes[] = $submenu_class_depth;
		}
	}

	return array_filter( array_unique( $classes ) );
}

add_filter( 'nav_menu_submenu_css_class', 'ground_nav_menu_submenu_css_class', 10, 3 );

/**
 * Filters the CSS classes applied to a menu link.
 *
 * @param array    $atts   The HTML attributes applied to the menu item's <a> element, empty strings are ignored.
 * @param WP_Post  $item   The current menu item.
 * @param stdClass $args   An object of wp_nav_menu() arguments. Supports 'merge_classes' (bool).
 * @param int      $depth  Depth of menu item. Used for padding.
 * @return array   Modified array of HTML attributes.
 */
function ground_nav_menu_link_css_class( $atts, $item, $args, $depth ) {
	if ( ! is_array( $atts ) ) {
		$atts = [];
	}
	if ( ! is_object( $args ) || ! is_object( $item ) ) {
		return $atts;
	}
	$depth_key = $depth + 1;
	$remove_default_class = $args->remove_default_class ?? false;
	$merge_classes = $args->merge_classes ?? false;
	$link_class = $args->link_class ?? '';
	$link_class_depth = $args->{'link_class_' . $depth_key} ?? '';
	$link_active_class = $args->link_active_class ?? '';
	$link_active_class_depth = $args->{'link_active_class_' . $depth_key} ?? '';
	$link_parent_class = $args->link_parent_class ?? '';
	$link_parent_class_depth = $args->{'link_parent_class_' . $depth_key} ?? '';
	$link_ancestor_class = $args->link_ancestor_class ?? '';
	$link_ancestor_class_depth = $args->{'link_ancestor_class_' . $depth_key} ?? '';
	$current_classes = ! empty( $atts['class'] ) ? explode( ' ', $atts['class'] ) : [];
	
	if ( $remove_default_class === true ) {
		$current_classes = [];
	} elseif ( is_array( $remove_default_class ) ) {
		$current_classes = array_diff( $current_classes, $remove_default_class );
	}

	$new_classes = [];

	if ( $merge_classes ) {
		if ( $item->current ) {
			$new_classes[] = $link_active_class_depth ?: $link_active_class;
		} elseif ( $item->current_item_parent ) {
			$new_classes[] = $link_parent_class_depth ?: $link_parent_class;
		} elseif ( $item->current_item_ancestor ) {
			$new_classes[] = $link_ancestor_class_depth ?: $link_ancestor_class;
		} else {
			$new_classes[] = $link_class_depth ?: $link_class;
		}
	} else {
		if ( $link_class ) {
			$new_classes[] = $link_class;
		}
		if ( $link_class_depth ) {
			$new_classes[] = $link_class_depth;
		}
		if ( $item->current ) {
			if ( $link_active_class ) {
				$new_classes[] = $link_active_class;
			}
			if ( $link_active_class_depth ) {
				$new_classes[] = $link_active_class_depth;
			}
		}
		if ( $item->current_item_parent ) {
			if ( $link_parent_class ) {
				$new_classes[] = $link_parent_class;
			}
			if ( $link_parent_class_depth ) {
				$new_classes[] = $link_parent_class_depth;
			}
		}
		if ( $item->current_item_ancestor ) {
			if ( $link_ancestor_class ) {
				$new_classes[] = $link_ancestor_class;
			}
			if ( $link_ancestor_class_depth ) {
				$new_classes[] = $link_ancestor_class_depth;
			}
		}
	}

	$atts['class'] = esc_attr( implode( ' ', array_unique( array_filter( $new_classes ) ) ) );
	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'ground_nav_menu_link_css_class', 10, 4 );

/**
 * Save ACF local JSON
 *
 * @return string The custom path for saving ACF JSON files.
 */
function ground_acf_json_save_point() {
	return GROUND_TEMPLATE_DIRECTORY . '/config/acf';
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
	$paths[] = GROUND_TEMPLATE_DIRECTORY . '/config/acf';
	return $paths;
}

add_filter( 'acf/settings/load_json', 'ground_acf_json_load_point' );


/**
 * Removes the Site Icon from the WordPress Customizer.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer manager instance.
 * @return void
 */
function ground_remove_customizer_site_icon( $wp_customize ) {
	$wp_customize->remove_control( 'site_icon' );
	$wp_customize->remove_setting( 'site_icon' );
}

add_action( 'customize_register', 'ground_remove_customizer_site_icon', 20 );