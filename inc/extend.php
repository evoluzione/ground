<?php
/**
 * Localization
 *
 * Load the theme's translated strings.
 *
 * Deliberately calls load_textdomain() with the exact file path instead of
 * load_theme_textdomain(): since WP 6.5 the latter only registers the path
 * and defers the actual file load to _load_textdomain_just_in_time(), which
 * — for a language directory that lives *inside* the theme (as ours does) —
 * looks for an unprefixed "{$locale}.mo" instead of our "{$domain}-{$locale}.mo"
 * naming (produced by `wp i18n make-mo`), so it silently never finds the file.
 *
 * @return void
 */
function ground_load_theme_textdomain() {
	load_textdomain( 'ground', GROUND_TEMPLATE_DIRECTORY . '/languages/ground-' . determine_locale() . '.mo' );
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

	if ( ground_is_debug() ) {
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

/**
 * Stops Settings → Media from saving the image size options.
 *
 * The sizes come from config/media.php, so WordPress refuses the writes.
 *
 * @param array $allowed Options each settings page is allowed to save.
 * @return array
 */
function ground_lock_media_size_options( $allowed ) {
	$allowed['media'] = array_values( array_diff(
		$allowed['media'] ?? array(),
		array( 'thumbnail_size_w', 'thumbnail_size_h', 'thumbnail_crop', 'medium_size_w', 'medium_size_h', 'large_size_w', 'large_size_h' )
	) );

	return $allowed;
}

add_filter( 'allowed_options', 'ground_lock_media_size_options' );

/**
 * Hides the fields the filter above has already disabled.
 *
 * options-media.php prints them as raw markup, so there is no API to remove
 * them and this stays cosmetic: if the selectors ever miss, the fields come
 * back visible but still unsaveable.
 *
 * @return void
 */
function ground_hide_media_size_settings() {
	?>
	<style>
		.form-table tr:has(:is(#thumbnail_size_w, #medium_size_w, #large_size_w)),
		h2.title:has(+ p + .form-table #thumbnail_size_w),
		h2.title:has(+ p + .form-table #thumbnail_size_w) + p {
			display: none;
		}
	</style>
	<?php
}

add_action( 'admin_head-options-media.php', 'ground_hide_media_size_settings' );

/**
 * Pages and orders a post type's archives as its 'listing' says.
 *
 * 'listing' is an optional key of a post type in config/post-types.php, with
 * 'per_page' and 'orderby'. It applies to the post type's archive and to the
 * archives of its taxonomies; a taxonomy shared by two post types follows the
 * first one in the config.
 *
 * This has to happen here: the main query runs before the template is chosen,
 * and WordPress sends a 404 when a paginated main query finds nothing. With
 * its own posts per page (Settings → Reading) a term archive would end on a
 * different page than the page listing the post type, which reads the same
 * 'listing'.
 *
 * @param WP_Query $query The query being set up.
 * @return void
 */
function ground_listing_main_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	foreach ( ground_config( 'post-types.post_types' ) as $name => $post_type ) {
		$listing = $post_type['listing'] ?? [];

		if ( ! $listing ) {
			continue;
		}

		// Asked about no taxonomy, is_tax() answers for any of them.
		$taxonomies = get_object_taxonomies( $name );

		if ( ! $query->is_post_type_archive( $name ) && ! ( $taxonomies && $query->is_tax( $taxonomies ) ) ) {
			continue;
		}

		if ( isset( $listing['per_page'] ) ) {
			$query->set( 'posts_per_page', $listing['per_page'] );
		}

		if ( isset( $listing['orderby'] ) ) {
			$query->set( 'orderby', $listing['orderby'] );
		}

		return;
	}
}

add_action( 'pre_get_posts', 'ground_listing_main_query' );
