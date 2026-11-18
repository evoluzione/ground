<?php
/**
 * Retrieves a configuration value from a config file.
 *
 * @param string $configPath The dot notation for the config key (e.g., "app.debug").
 *
 * @return mixed The corresponding value, or null if the file does not exist or the config is invalid.
 */
function ground_config( $configPath ) {
	static $configs = [];

	$pathParts = explode( '.', $configPath );
	$fileName = array_shift( $pathParts );

	if ( ! array_key_exists( $fileName, $configs ) ) {
		$filePath = GROUND_TEMPLATE_DIRECTORY . '/config/' . $fileName . '.php';
		$config = is_file( $filePath ) ? include $filePath : null;

		// A missing or invalid file is memoized as null too.
		$configs[ $fileName ] = is_array( $config ) ? $config : null;
	}

	// Plain assignments: arrays are copy-on-write, so nothing is copied here.
	$data = $configs[ $fileName ];

	foreach ( $pathParts as $key ) {
		if ( ! is_array( $data ) || ! array_key_exists( $key, $data ) ) {
			return null;
		}
		$data = $data[ $key ];
	}

	return $data;
}

/**
 * Checks whether debug mode is active.
 *
 * Always active on local/development environments. On staging/production,
 * only active for admins that explicitly opt in via ?debug=true.
 *
 * @return bool
 */
function ground_is_debug() {
	if ( in_array( wp_get_environment_type(), [ 'local', 'development' ], true ) ) {
		return true;
	}

	return current_user_can( 'manage_options' ) && isset( $_GET['debug'] ) && $_GET['debug'] === 'true';
}

/**
 * Excerpt with custom length.
 *
 * Plain text: tags and shortcodes are stripped, whitespace collapsed. A text
 * longer than $length is cut back to the last whole word before $after_text.
 *
 * @param int             $length     Optional. The maximum excerpt length in characters. Default is 100.
 * @param string          $after_text Optional. Characters to add at the end of the excerpt. Default is '...'.
 * @param int|WP_Post     $post       Optional. Post ID or post object. Default is global $post.
 * @param bool            $echo       Optional. If true, echoes the excerpt; otherwise, returns it. Default is true.
 *
 * @return string|void    The excerpt if $echo is false, otherwise echoes it.
 */
function ground_excerpt( $length = 100, $after_text = '...', $post = null, $echo = true ) {

	$post = get_post( $post );
	$excerpt = '';

	if ( $post ) {
		$charset = get_bloginfo( 'charset' );

		// Shortcodes are stripped rather than executed, as core does in
		// wp_trim_excerpt(): expanding them only to truncate is wasted work.
		$source = ( '' !== $post->post_excerpt ) ? $post->post_excerpt : strip_shortcodes( $post->post_content );

		// Entities are decoded before cutting, so each counts as one character
		// and none is cut in half (&am…); esc_html() re-encodes them on output.
		$excerpt = html_entity_decode( wp_strip_all_tags( $source, true ), ENT_QUOTES | ENT_HTML5, $charset );

		if ( mb_strlen( $excerpt, $charset ) > $length ) {
			$word_ends_at_cut = mb_substr( $excerpt, $length, 1, $charset ) === ' ';
			$excerpt = mb_substr( $excerpt, 0, $length, $charset );

			// Back up to the last whole word, unless the cut already falls between
			// two words or the first word alone is too long.
			$last_space = $word_ends_at_cut ? false : mb_strrpos( $excerpt, ' ', 0, $charset );
			if ( $last_space ) {
				$excerpt = mb_substr( $excerpt, 0, $last_space, $charset );
			}

			$excerpt = rtrim( $excerpt, ' ,.;:-' ) . $after_text;
		}

		$excerpt = apply_filters( 'ground_excerpt', $excerpt, $length, $after_text, $post );
	}

	if ( ! $echo ) {
		return esc_html( $excerpt );
	}

	echo esc_html( $excerpt );
}

/**
 * Retrieves and processes an image (featured or attachment).
 *
 * @param array $args {
 *     Optional. An array of parameters for retrieving the image.
 *
 *     @type string|int[] $size           Image size. Accepts any registered image size name or an array of width and height values. Default is 'large'.
 *     @type string|array $attr           Query string or array of attributes. Empty by default, so WordPress decides 'loading' and 'fetchpriority' itself; pass them only to override that. See https://developer.wordpress.org/reference/functions/wp_get_attachment_image/#parameters
 *     @type WP_Post|int|null $post       The post object or ID from which the image should be fetched. Default is null.
 *     @type string $placeholder          URL to a fallback image if no image is found. Default is fetched via ground_config('media.placeholder_url').
 *     @type bool $return_url             Whether to fetch the image URL instead of an HTML img tag. Default is false.
 *     @type int|string $attachment_id    WordPress attachment ID for the image. Default is empty.
 *     @type bool $responsive             Whether to include 'srcset' and 'sizes' attributes for responsive images. Default is true.
 *     @type bool $echo                   Whether to echo the output or return it. Default is true.
 * }
 *
 * @return string|null The image HTML or URL, or null if 'echo' is true.
 */
function ground_image( $args = [] ) {

	$defaults = [
		'size' => 'large',
		// No 'loading' by default: declaring it hands WordPress a claim about the
		// viewport, and 'lazy' told it every image was below the fold — which
		// switched off its own optimisation. Left alone, core makes the first
		// images eager, gives the first fetchpriority="high", and lazies the rest.
		'attr' => [],
		'post' => null,
		'placeholder' => ground_config( 'media.placeholder_url' ),
		'return_url' => false,
		'attachment_id' => '',
		'responsive' => true,
		'echo' => true
	];
	$args = array_replace_recursive( $defaults, $args );

	$size = $args['size'];
	// Accepts a query string too, as wp_get_attachment_image() does; the
	// placeholder below writes into it as an array.
	$attr = wp_parse_args( $args['attr'] );
	$post = $args['post'];
	$placeholder = $args['placeholder'];
	$return_url = $args['return_url'];
	$attachment_id = $args['attachment_id'];
	$responsive = $args['responsive'];
	$echo = $args['echo'];

	if ( $return_url ) {
		$image = ! empty( $attachment_id )
			? wp_get_attachment_image_url( $attachment_id, $size )
			: get_the_post_thumbnail_url( $post, $size );
	} elseif ( ! empty( $attachment_id ) ) {
		$image = wp_get_attachment_image( $attachment_id, $size, false, $attr );
	} else {
		$image = get_the_post_thumbnail( $post, $size, $attr );
	}

	// The *_url() functions return false when there's nothing to return.
	$image = $image ?: '';

	// Remove 'srcset' and 'sizes' attributes if not responsive
	if ( ! $responsive && ! empty( $image ) ) {
		$image = preg_replace( '/\s+(srcset|sizes)=[\'"][^\'"]+[\'"]/i', '', $image );
	}

	// Handle default fallback image
	if ( empty( $image ) && ! empty( $placeholder ) && $return_url ) {
		$image = $placeholder;
	} elseif ( empty( $image ) && ! empty( $placeholder ) ) {

		if ( is_array( $size ) ) {
			$attr['width'] = $size[0];
			$attr['height'] = $size[1];
		} else {
			// Includes both core sizes (thumbnail/medium/large) and those
			// registered via add_image_size(); $_wp_additional_image_sizes omits the core ones.
			$sizes = wp_get_registered_image_subsizes();
			if ( isset( $sizes[ $size ] ) ) {
				$attr['width'] = $sizes[ $size ]['width'];
				$attr['height'] = $sizes[ $size ]['height'];
			}
		}

		// The placeholder stands in for an image that isn't there: without an
		// alt the reader would announce its file name. Empty marks it decorative;
		// the caller's alt, when given, wins.
		$attr += [ 'alt' => '' ];

		$image = '<img src="' . esc_url( $placeholder ) . '"';
		foreach ( $attr as $key => $value ) {
			if ( $value === null || ( $value === '' && $key !== 'alt' ) ) {
				continue;
			}
			$image .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
		}
		$image .= ' />';
	}

	if ( ! $echo ) {
		return $image;
	}

	// A URL is raw until escaped; the <img> markup is already escaped.
	echo $return_url ? esc_url( $image ) : $image;
}

/**
 * Retrieves an SVG icon with custom attributes and returns or echoes it.
 *
 * @param array $args {
 *     Optional. An array of arguments.
 *
 *     @type string $name     The name of the SVG file, without extension. Required.
 *     @type array  $attr     Attributes to set on the <svg> element; null removes one the file has. Default is
 *                            ['class' => 'inline']. Icons are decorative by default (aria-hidden="true"): pass
 *                            'aria-label' for one that carries meaning on its own, and it gets role="img" instead.
 *     @type string $icon_set The folder under assets/icons/. Default is ground_config('media.icon_set').
 *     @type string $path     A folder to read the file from instead of the icon set (trailing slash included). Default is ''.
 *     @type bool   $echo     Whether to echo the SVG markup instead of returning it. Default is true.
 * }
 * @return string|void The SVG markup if $echo is false; void otherwise or when the file can't be read.
 */
function ground_icon( $args = [] ) {
	static $cache = [];

	$defaults = [
		'name' => '',
		'attr' => [
			'class' => 'inline'
		],
		'icon_set' => ground_config( 'media.icon_set' ),
		'echo' => true,
		'path' => '',
	];

	$args = array_replace_recursive( $defaults, $args );

	if ( empty( $args['name'] ) ) {
		return;
	}

	$attr = $args['attr'];

	// Decorative unless labelled: next to text or inside a labelled control the
	// icon would only add noise to what a screen reader announces.
	$attr += isset( $attr['aria-label'] )
		? [ 'role' => 'img' ]
		: [ 'aria-hidden' => 'true' ];

	$echo = $args['echo'];
	$path = $args['path'] ?: GROUND_TEMPLATE_DIRECTORY . '/assets/icons/' . $args['icon_set'] . '/';
	$file_path = $path . $args['name'] . '.svg';

	if ( ! is_readable( $file_path ) ) {
		return;
	}

	// Check the cache
	$cache_key = md5( $file_path . json_encode( $attr ) );
	if ( isset( $cache[ $cache_key ] ) ) {
		$icon = $cache[ $cache_key ];
	} else {
		// Read and manipulate the SVG
		$markup = file_get_contents( $file_path );
		if ( $markup === false ) {
			return;
		}

		$dom = new DOMDocument();
		@$dom->loadXML( $markup );

		$svg = $dom->getElementsByTagName( 'svg' )->item( 0 );
		if ( ! $svg ) {
			return;
		}

		foreach ( $attr as $key => $value ) {
			if ( $value === null ) {
				$svg->removeAttribute( $key );
			} else {
				$svg->setAttribute( $key, $value );
			}
		}

		// Saving a node, not the document, emits no XML declaration.
		$icon = $dom->saveXML( $svg );

		// Save in the cache
		$cache[ $cache_key ] = $icon;
	}

	if ( $echo ) {
		echo $icon;
	} else {
		return $icon;
	}
}

/**
 * Writes to the debug log.
 *
 * Requires WP_DEBUG, plus WP_DEBUG_LOG set either to true (logging to
 * wp-content/debug.log) or to an explicit file path.
 *
 * @param mixed $log Logging data.
 *
 * @return void
 */
function ground_log( $log ) {
	// WP_DEBUG_LOG is either true or a path; WordPress routes error_log() to the
	// right destination in both cases.
	if ( ! WP_DEBUG || ! WP_DEBUG_LOG ) {
		return;
	}

	if ( is_array( $log ) || is_object( $log ) ) {
		error_log( print_r( $log, true ) );
	} else {
		error_log( $log );
	}
}

/**
 * Returns the pagination links of a query.
 *
 * Data only: the markup lives in template-parts/pagination/pagination-primary.php.
 * The links come from paginate_links(), so its arguments (mid_size, end_size,
 * prev_next, base, format, add_args…) and filters still apply; its text and
 * markup arguments (prev_text, next_text, before_page_number…) don't, since the
 * template part writes those.
 *
 * @param array $args Optional. Arguments for paginate_links(). 'total' defaults
 *                    to the main query's page count, 'current' to 'paged', or
 *                    'page' on a static front page.
 *
 * @return array[] Links in order, each with 'type' ('prev', 'next', 'dots' or
 *                 'page'), 'url' (empty for the dots and the current page),
 *                 'number' (the page number as text, empty unless 'page') and
 *                 'current'. Empty when there is a single page.
 */
function ground_pagination( $args = [] ) {
	global $wp_query;

	$defaults = [
		'total' => $wp_query->max_num_pages,
		// paginate_links() reads only 'paged', but on a static front page
		// WP_Query moves the number to 'page' (/page/2/ → page=2), so page 2
		// would show as 1. Same reading as loop-ground_catalog.php.
		'current' => max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) ),
	];

	$links = paginate_links(
		[
			'type' => 'array',
			'before_page_number' => '',
			'after_page_number' => '',
		] + wp_parse_args( $args, $defaults )
	);

	// A single page: paginate_links() returns nothing.
	if ( ! $links ) {
		return [];
	}

	return array_map(
		function ( $link ) {
			// Read from the element itself, not from the whole fragment: the URL
			// can contain "prev", "next" or "current" as well
			// (e.g. /category/previews/page/2/).
			$tag = new WP_HTML_Tag_Processor( $link );
			$tag->next_tag();

			$type = match ( true ) {
				$tag->has_class( 'prev' ) => 'prev',
				$tag->has_class( 'next' ) => 'next',
				$tag->has_class( 'dots' ) => 'dots',
				default => 'page',
			};

			return [
				'type' => $type,
				'url' => (string) $tag->get_attribute( 'href' ),
				'number' => 'page' === $type ? wp_strip_all_tags( $link ) : '',
				'current' => (bool) $tag->has_class( 'current' ),
			];
		},
		$links
	);
}

/**
 * Nests a flat list of navigation items under their parents.
 *
 * @param array[] $items Items in display order, each with 'id' and 'parent'.
 * @param int     $root  ID the first level hangs from.
 *
 * @return array[] The first level, every item with its 'children' (same shape).
 */
function ground_nest_items( $items, $root = 0 ) {
	$by_parent = [];

	foreach ( $items as $item ) {
		$by_parent[ $item['parent'] ][] = $item;
	}

	$nest = function ( $parent ) use ( &$nest, $by_parent ) {
		return array_map(
			fn( $item ) => $item + [ 'children' => $nest( $item['id'] ) ],
			$by_parent[ $parent ] ?? []
		);
	};

	return $nest( $root );
}

/**
 * Returns the attributes of a navigation link, ready to print inside <a>.
 *
 * Only what the data decides (href, aria-current and, for menu items, what the
 * editor set in Appearance → Menus: target, rel, title): the classes stay in
 * the template part.
 *
 * @param array $item An item from ground_menu(), ground_subpages() or ground_terms().
 *
 * @return string Escaped attributes, e.g. 'href="…" aria-current="page"'.
 */
function ground_link_attributes( $item ) {
	$attributes = [
		'href' => esc_url( $item['url'] ),
		'aria-current' => $item['current'] ? 'page' : '',
		'target' => esc_attr( $item['target'] ?? '' ),
		'rel' => esc_attr( $item['rel'] ?? '' ),
		'title' => esc_attr( $item['attr_title'] ?? '' ),
	];

	$output = [];

	foreach ( $attributes as $name => $value ) {
		if ( '' !== $value ) {
			$output[] = $name . '="' . $value . '"';
		}
	}

	return implode( ' ', $output );
}

/**
 * Returns the URL of the page that lists the kind of content being viewed.
 *
 * The posts page on a post or one of its archives, the shop on a product or a
 * product category, a post type's archive on one of its posts or terms. A post
 * type without an archive is listed by the page that uses the template named
 * after it, templates/template-{post_type}.php (the catalog's).
 *
 * @return string The URL, or '' on a page, a search, a 404, or when nothing
 *                lists that kind of content.
 */
function ground_listing_url() {
	$object = get_queried_object();

	$post_type = match ( true ) {
		is_singular() => get_post_type( $object ),
		is_post_type_archive() => $object->name ?? '',
		// A term archive stands for the post type its taxonomy belongs to.
		$object instanceof WP_Term => get_taxonomy( $object->taxonomy )->object_type[0] ?? '',
		is_date(), is_author() => 'post',
		default => '',
	};

	if ( ! $post_type || 'page' === $post_type ) {
		return '';
	}

	// Posts are listed by the posts page; without one they are on the home
	// page, and "Home" isn't a section.
	if ( 'post' === $post_type ) {
		$posts_page = (int) get_option( 'page_for_posts' );

		return $posts_page ? get_permalink( $posts_page ) : '';
	}

	$url = get_post_type_archive_link( $post_type );

	if ( $url ) {
		return $url;
	}

	$pages = get_pages( [
		'meta_key' => '_wp_page_template',
		'meta_value' => "templates/template-{$post_type}.php",
		'number' => 1,
	] );

	return $pages ? get_permalink( $pages[0] ) : '';
}

/**
 * Returns the items of the menu assigned to a location as a tree.
 *
 * Data only: the markup lives in the template part, one foreach per level it
 * shows (see template-parts/navigation/navigation-header-primary.php).
 *
 * Runs the same steps as wp_nav_menu() up to the walker: the items, core's
 * current/ancestor detection and the 'wp_nav_menu_objects' filter (WooCommerce
 * marks the shop page there). What acts on the walker or on its HTML doesn't
 * apply, since that markup is never rendered: 'nav_menu_css_class',
 * 'nav_menu_link_attributes', 'wp_nav_menu_items'…
 *
 * @param string $location A menu location registered in config/menus.php.
 *
 * @return array[] First-level items, each with 'id', 'parent', 'title' (already
 *                 filtered: print it with wp_kses_post()), 'url', 'target',
 *                 'rel', 'attr_title', 'classes', 'current', 'ancestor' and
 *                 'children' (same shape). Empty when the location has no menu
 *                 or the menu has no items.
 *
 *                 'ancestor' marks the section the visitor is in. An item is
 *                 one when, without being the current one, it is: a parent of
 *                 the current item in the menu; a page or term the content
 *                 being viewed descends from, even when that content isn't in
 *                 the menu; or the page listing that kind of content (see
 *                 ground_listing_url()).
 */
function ground_menu( $location ) {
	$locations = get_nav_menu_locations();
	$menu = isset( $locations[ $location ] ) ? wp_get_nav_menu_object( $locations[ $location ] ) : false;
	$items = $menu ? wp_get_nav_menu_items( $menu->term_id, [ 'update_post_term_cache' => false ] ) : false;

	if ( ! $items ) {
		return [];
	}

	_wp_menu_item_classes_by_context( $items );

	$items = apply_filters( 'wp_nav_menu_objects', $items, (object) [
		'menu' => $menu,
		'theme_location' => $location,
	] );

	$privacy_policy_url = get_privacy_policy_url();
	$listing_url = untrailingslashit( ground_listing_url() );

	$items = array_map(
		function ( $item ) use ( $privacy_policy_url, $listing_url ) {
			// Same rel as core's walker.
			$rel = '_blank' === $item->target && ! $item->xfn ? 'noopener' : (string) $item->xfn;

			if ( $item->url && $privacy_policy_url === $item->url ) {
				$rel = trim( $rel . ' privacy-policy' );
			}

			return [
				// Left as they come: plugins add items whose ID isn't a number.
				'id' => $item->ID,
				'parent' => $item->menu_item_parent,
				'title' => apply_filters( 'the_title', $item->title, $item->ID ),
				'url' => $item->url,
				'target' => $item->target,
				'rel' => $rel,
				'attr_title' => $item->attr_title,
				// Everything core and plugins computed, plus what the editor typed
				// in Appearance → Menus.
				'classes' => array_values( array_filter( (array) $item->classes ) ),
				'current' => (bool) $item->current,
				'ancestor' => ! $item->current && (
					// A parent of the current item in the menu.
					$item->current_item_ancestor
					|| $item->current_item_parent
					// A real hierarchy: a parent page, a parent term, a term of
					// the post. The hyphenated classes only, never the
					// 'current_page_parent' of wp_page_menu(): core adds that
					// one to the posts page on every request that isn't a page
					// (a catalog archive, a search, a 404).
					|| (bool) preg_grep( '/^current-.+-(ancestor|parent)$/', (array) $item->classes )
					|| ( $listing_url && untrailingslashit( $item->url ) === $listing_url )
				),
			];
		},
		$items
	);

	return ground_nest_items( $items );
}

/**
 * Returns the pages of the current section as a tree: the descendants of the
 * current page's top-level ancestor.
 *
 * Data only: the markup lives in the template part, one foreach per level it
 * shows (see template-parts/navigation/navigation-sidebar-primary.php).
 *
 * Arguments go to get_pages(); there 'number' maps to posts_per_page and is a
 * real LIMIT, unlike in ground_terms(). Never capped by default all the same,
 * since a slice taken before the hierarchy is built loses the children of
 * whatever it cut; past theme.nav_tree_warn_at items it warns in debug.
 *
 * @param array $args Optional. Arguments for get_pages(). 'child_of' defaults to
 *                    the top-level ancestor and is the page the first level hangs from.
 *
 * @return array[] First-level pages, each with 'id', 'parent', 'title' (already
 *                 filtered: print it with wp_kses_post()), 'url', 'current',
 *                 'ancestor' (of the current page) and 'children' (same shape).
 *                 Empty outside a single post or when the section has no pages.
 */
function ground_subpages( $args = [] ) {
	$current_id = get_queried_object_id();

	// Outside a single post there's no tree to anchor to: child_of would fall
	// back to 0 and list every page on the site.
	if ( ! is_singular() || ! $current_id ) {
		return [];
	}

	$ancestors = get_post_ancestors( $current_id );

	$args = wp_parse_args( $args, [
		'child_of' => $ancestors ? end( $ancestors ) : $current_id,
		'sort_column' => 'menu_order, post_title',
		'hierarchical' => true,
	] );

	$pages = get_pages( $args );

	if ( ! $pages ) {
		return [];
	}

	$warn_at = (int) ground_config( 'theme.nav_tree_warn_at' );

	if ( $warn_at && count( $pages ) > $warn_at && ground_is_debug() ) {
		ground_log( sprintf(
			'ground_subpages(): returning %d pages under #%d, past the %d set in theme.nav_tree_warn_at. Scope the query with its arguments (e.g. "number"): they are forwarded to get_pages().',
			count( $pages ),
			$args['child_of'],
			$warn_at
		) );
	}

	$items = array_map(
		fn( $page ) => [
			'id' => (int) $page->ID,
			'parent' => (int) $page->post_parent,
			'title' => get_the_title( $page ),
			'url' => get_permalink( $page ),
			'current' => (int) $page->ID === $current_id,
			'ancestor' => in_array( (int) $page->ID, $ancestors, true ),
		],
		$pages
	);

	return ground_nest_items( $items, (int) $args['child_of'] );
}

/**
 * Displays or returns a list of terms for a post, with optional CSS class and separator.
 *
 * @param string $taxonomy  The taxonomy name. Default is 'category'.
 * @param string $class     Optional. CSS class to apply to each term link. Default is an empty string.
 * @param string $separator Optional. Separator between term links. Default is ', '.
 * @param bool   $echo      Optional. Whether to echo or return the terms list. Default is true.
 *
 * @return string|null If $echo is false, the list of term links is returned. Otherwise, nothing is returned.
 */
function ground_current_terms( $taxonomy = 'category', $class = '', $separator = ', ', $echo = true ) {
	$post_id = get_the_ID();

	$terms = get_the_terms( $post_id, $taxonomy );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$terms_links = array();

		foreach ( $terms as $term ) {
			$terms_links[] = '<a class="' . esc_attr( $class ) . '" href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
		}

		$terms_list = implode( $separator, $terms_links );

		if ( $echo ) {
			echo $terms_list;
		} else {
			return $terms_list;
		}
	}

	return null;
}

/**
 * Returns the terms of a taxonomy as a tree.
 *
 * Data only: the markup lives in the template part, one foreach per level it
 * shows (see template-parts/navigation/navigation-sidebar-secondary.php).
 *
 * Arguments go to get_terms(), but they don't all bound the same thing: only
 * 'parent' reaches SQL, while 'number' and 'child_of' are applied in PHP after
 * the full fetch. Pair 'number' with 'hierarchical' => false for a real LIMIT.
 * Never capped by default, since a slice taken before the hierarchy is built
 * loses the children of whatever it cut; past theme.nav_tree_warn_at items it
 * warns in debug.
 *
 * @param array $args Optional. Arguments for get_terms(). 'taxonomy' defaults to
 *                    'category', 'hide_empty' to true. The first level hangs from
 *                    'child_of' (default 0, the root: every descendant) or, when
 *                    passed, from 'parent' (its direct children only).
 *
 * @return array[] First-level terms, each with 'id', 'parent', 'title' (print it
 *                 with wp_kses_post()), 'url', 'current', 'ancestor' (of the
 *                 current term) and 'children' (same shape). Empty when the
 *                 taxonomy has no terms to show.
 */
function ground_terms( $args = [] ) {
	$args = wp_parse_args( $args, [
		'taxonomy' => 'category',
		'child_of' => 0,
		'hide_empty' => true,
	] );

	$terms = get_terms( $args );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return [];
	}

	$warn_at = (int) ground_config( 'theme.nav_tree_warn_at' );

	if ( $warn_at && count( $terms ) > $warn_at && ground_is_debug() ) {
		ground_log( sprintf(
			'ground_terms(): returning %d terms from the "%s" taxonomy, past the %d set in theme.nav_tree_warn_at. Scope the query with "number" or "child_of" — both are forwarded to get_terms().',
			count( $terms ),
			$args['taxonomy'],
			$warn_at
		) );
	}

	// Any term archive: category, tag or custom taxonomy.
	$queried = get_queried_object();
	$current_id = $queried instanceof WP_Term ? (int) $queried->term_id : 0;
	$ancestors = $current_id ? get_ancestors( $current_id, $queried->taxonomy, 'taxonomy' ) : [];

	$items = array_map(
		fn( $term ) => [
			'id' => (int) $term->term_id,
			'parent' => (int) $term->parent,
			'title' => $term->name,
			'url' => get_term_link( $term ),
			'current' => (int) $term->term_id === $current_id,
			'ancestor' => in_array( (int) $term->term_id, $ancestors, true ),
		],
		$terms
	);

	// 'parent' returns one level only: it hangs from that term, not from 'child_of'.
	$root = is_numeric( $args['parent'] ?? '' ) ? $args['parent'] : $args['child_of'];

	return ground_nest_items( $items, (int) $root );
}

/**
 * Returns the Yoast SEO breadcrumb trail for the current page.
 *
 * Data only: the markup lives in template-parts/navigation/navigation-breadcrumbs.php,
 * because Yoast's own (spans with the separator as text between them) can't be
 * turned into an <ol> through its filters. Yoast's texts and data filters still
 * apply (home, search/archive/404 texts, wpseo_breadcrumb_links,
 * wpseo_breadcrumb_single_link_info); its markup settings and filters (separator,
 * bold last crumb, prefix, wpseo_breadcrumb_output…) don't, since that markup is
 * never rendered.
 *
 * @return array[] Crumbs, each with 'text' and, except usually the last, 'url'.
 *                 Empty when Yoast is missing or its breadcrumbs are off.
 */
function ground_breadcrumbs() {
	if ( ! function_exists( 'YoastSEO' ) ) {
		return [];
	}

	// Same switch as yoast_breadcrumb(): the theme support forces them on,
	// otherwise the "Enable breadcrumbs" setting decides.
	if ( ! current_theme_supports( 'yoast-seo-breadcrumbs' ) && ! YoastSEO()->helpers->options->get( 'breadcrumbs-enable', false ) ) {
		return [];
	}

	// Yoast's public surface; WPSEO_Breadcrumbs is only a back-compat class.
	$meta = YoastSEO()->meta->for_current_page();
	$crumbs = $meta ? (array) $meta->breadcrumbs : [];

	// Like Yoast's presenter, crumbs without text are dropped.
	return array_values( array_filter( $crumbs, fn( $crumb ) => ! empty( $crumb['text'] ) ) );
}
