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

		if ( ! is_file( $filePath ) ) {
			$configs[ $fileName ] = null;
			return null;
		}

		$config = include $filePath;

		if ( ! is_array( $config ) ) {
			$configs[ $fileName ] = null;
			return null;
		}

		$configs[ $fileName ] = $config;
	}

	if ( $configs[ $fileName ] === null ) {
		return null;
	}

	$data = &$configs[ $fileName ];

	foreach ( $pathParts as $key ) {
		if ( ! is_array( $data ) || ! array_key_exists( $key, $data ) ) {
			return null;
		}
		$data = &$data[ $key ];
	}

	return $data;
}

/**
 * Excerpt with custom length.
 *
 * @param int             $length     Optional. The excerpt length in characters. Default is 100.
 * @param string          $after_text Optional. Characters to add at the end of the excerpt. Default is '...'.
 * @param int|WP_Post     $post       Optional. Post ID or post object. Default is global $post.
 * @param bool            $echo       Optional. If true, echoes the excerpt; otherwise, returns it. Default is true.
 *
 * @return string|void    The excerpt if $echo is false, otherwise echoes it.
 */
function ground_excerpt( $length = 100, $after_text = '...', $post = null, $echo = true ) {

	$post = get_post( $post );
	if ( ! $post ) {
		if ( ! $echo ) {
			return '';
		}
		echo '';
		return;
	}

	$post_content = ( '' !== $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
	$content = wp_strip_all_tags( do_shortcode( $post_content ) );
	$excerpt = mb_substr( $content, 0, $length, get_bloginfo( 'charset' ) );

	if ( mb_strlen( $content, get_bloginfo( 'charset' ) ) > $length ) {
		$excerpt .= $after_text;
	}

	$excerpt = apply_filters( 'ground_excerpt', $excerpt, $length, $after_text, $post );

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
 *     @type string|int[] $size           Image size. Accepts any registered image size name or an array of width and height values. Default is 'thumbnail'.
 *     @type string|array $attr           Query string or array of attributes. Default is ['loading' => 'lazy']. See https://developer.wordpress.org/reference/functions/wp_get_attachment_image/#parameters
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
		'size' => 'thumbnail',
		'attr' => [
			'loading' => 'lazy',
		],
		'post' => null,
		'placeholder' => ground_config( 'media.placeholder_url' ),
		'return_url' => false,
		'attachment_id' => '',
		'responsive' => true,
		'echo' => true
	];
	$args = array_replace_recursive( $defaults, $args );

	$size = $args['size'];
	$attr = $args['attr'];
	$post = $args['post'];
	$placeholder = $args['placeholder'];
	$return_url = $args['return_url'];
	$attachment_id = $args['attachment_id'];
	$responsive = $args['responsive'];
	$echo = $args['echo'];

	$image = '';

	if ( ! empty( $attachment_id ) ) {
		$image = wp_get_attachment_image( $attachment_id, $size, false, $attr );
	} elseif ( $return_url ) {
		$image = get_the_post_thumbnail_url( $post, $size );
	} else {
		$image = get_the_post_thumbnail( $post, $size, $attr );
	}

	// Remove 'srcset' and 'sizes' attributes if not responsive
	if ( ! $responsive && ! empty( $image ) ) {
		$image = preg_replace( '/\s+(srcset|sizes)=[\'"][^\'"]+[\'"]/i', '', $image );
	}

	// Handle default fallback image
	if ( empty( $image ) && ! empty( $placeholder ) ) {

		if ( is_array( $size ) ) {
			$attr['width'] = $size[0];
			$attr['height'] = $size[1];
		} else {
			global $_wp_additional_image_sizes;
			$attr['width'] = $_wp_additional_image_sizes[ $size ]['width'];
			$attr['height'] = $_wp_additional_image_sizes[ $size ]['height'];
		}

		$image = '<img src="' . esc_url( $placeholder ) . '"';
		foreach ( $attr as $key => $value ) {
			if ( $value !== '' && $value !== null ) {
				$image .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
			}
		}
		$image .= ' />';
	}

	if ( $echo ) {
		echo $image;
	} else {
		return $image;
	}
}

/**
 * Retrieves an SVG icon with custom attributes and returns or echoes it.
 *
 * @param array $args {
 *     Optional. An array of arguments.
 *
 *     @type string $name The name of the icon file. Required.
 *     @type array  $attr An array of attributes to add to the SVG element. Default is ['class' => ''].
 *     @type string $icon_set The name of the icon set. Default is 'lucide'.
 *     @type string $file_extension The file extension of the icon. Default is 'svg'.
 *     @type bool   $echo Whether to echo the SVG markup instead of returning it. Default is true.
 * }
 * @return string|void The SVG markup with custom attributes, the URL if $return_url is true, or void if $echo is true.
 */
function ground_icon( $args = [] ) {
	static $cache = [];

	$defaults = [
		'name' => '',
		'attr' => [
			'class' => 'inline'
		],
		'icon_set' => ground_config( 'media.icon_set' ),
		'file_extension' => 'svg',
		'echo' => true,
		'path' => '',
	];

	$args = array_replace_recursive( $defaults, $args );

	if ( empty( $args['name'] ) ) {
		return;
	}

	$name = $args['name'];
	$icon_set = $args['icon_set'];
	$file_extension = $args['file_extension'];
	$attr = $args['attr'];
	$echo = $args['echo'];
	$path = $args['path'] ?: GROUND_TEMPLATE_DIRECTORY . '/assets/icons/' . $icon_set . '/';
	$file_path = $path . $name . '.' . $file_extension;

	// File check
	if ( $file_extension !== 'svg' || ! is_readable( $file_path ) ) {
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
		@$dom->loadXML( $markup, LIBXML_NOENT | LIBXML_DTDLOAD );

		$svg = $dom->getElementsByTagName( 'svg' )->item( 0 );
		if ( ! $svg ) {
			return;
		}

		foreach ( $attr as $key => $value ) {
			$svg->setAttribute( $key, $value );
		}

		$icon = $dom->saveXML( $svg );
		$icon = str_replace( '<?xml version="1.0"?>', '', $icon );

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
 * Write log to /wp-content/debug.log.
 * Requires WP_DEBUG and WP_DEBUG_LOG to be enabled.
 *
 * @param mixed $log Logging data.
 *
 * @return void
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
 * Renders a fully customizable pagination for WordPress.
 *
 * @param array $args {
 *     Optional. Array of arguments to customize pagination output.
 *
 *     @type string  $prev_text              Text for the "Previous" link.
 *     @type string  $next_text              Text for the "Next" link.
 *     @type int     $mid_size               How many numbers to either side of the current page.
 *     @type int     $total                  Total number of pages.
 *     @type int     $current                Current page number.
 *     @type string  $base                   Base URL to use in pagination.
 *     @type string  $format                 Format for pagination links.
 *     @type string  $type                   Return type from paginate_links().
 *     @type bool    $echo                   Whether to echo or return the result.
 *     @type bool    $merge_classes          Whether to merge or separate the custom classes.
 *     @type bool    $only_numbers           Whether to display only numeric pages (hide prev and next).
 *     @type string  $container_class        Class for the <nav> container.
 *     @type string  $list_class             Class for the <ul> element.
 *     @type string  $item_class             Generic class for all <li> elements.
 *     @type string  $item_active_class      Class used for active pagination items.
 *     @type string  $item_prev_class        Class used for the "Previous" item.
 *     @type string  $item_next_class        Class used for the "Next" item.
 *     @type string  $item_dots_class        Class used for the dots item.
 *     @type string  $item_page_class        Class used for numeric pagination items.
 *     @type string  $item_page_active_class Class used for active numeric pagination items.
 *     @type string  $link_class             Generic class for pagination links.
 *     @type string  $link_prev_class        Class for the "Previous" link element.
 *     @type string  $link_next_class        Class for the "Next" link element.
 *     @type string  $link_page_class        Class for numeric page link elements.
 *     @type string  $text_class             Generic class for text items (non-link).
 *     @type string  $text_page_class        Class for numeric page text (when no link).
 *     @type string  $text_dots_class        Class for dots text.
 *     @type string  $text_active_class      Class for active text items.
 * }
 *
 * @return string|void The generated pagination markup or void if 'echo' is true.
 */
function ground_pagination( $args = [] ) {
	global $wp_query;

	$pagination_placeholder = 999999999;
	$defaults = [
		'prev_text' => __( '&laquo; Previous' ),
		'next_text' => __( 'Next &raquo;' ),
		'mid_size' => 2,
		'total' => $wp_query->max_num_pages,
		'current' => max( 1, get_query_var( 'paged' ) ),
		'base' => str_replace( $pagination_placeholder, '%#%', esc_url( get_pagenum_link( $pagination_placeholder ) ) ),
		'format' => '?paged=%#%',
		'type' => 'array',
		'echo' => true,
		'merge_classes' => true,
		'only_numbers' => false,
		'container_class' => '',
		'list_class' => '',
		'item_class' => '',
		'item_active_class' => '',
		'item_prev_class' => '',
		'item_next_class' => '',
		'item_dots_class' => '',
		'item_page_class' => '',
		'item_page_active_class' => '',
		'link_class' => '',
		'link_prev_class' => '',
		'link_next_class' => '',
		'link_page_class' => '',
		'text_class' => '',
		'text_page_class' => '',
		'text_dots_class' => '',
		'text_active_class' => '',
	];

	$args = wp_parse_args( $args, $defaults );

	// If there's only one page, do nothing.
	if ( $args['total'] <= 1 ) {
		return;
	}

	$paginate = paginate_links( $args );

	// If no pagination links are generated, do nothing.
	if ( ! $paginate ) {
		return;
	}

	$output = '<nav class="' . esc_attr( $args['container_class'] ) . '" aria-label="pagination">';
	$output .= '<ul class="' . esc_attr( $args['list_class'] ) . '">';

	foreach ( $paginate as $page ) {
		$active = ( strpos( $page, 'current' ) !== false );
		$is_link = ( strpos( $page, '<a ' ) !== false );

		if ( strpos( $page, 'prev' ) !== false ) {
			$type = 'prev';
		} elseif ( strpos( $page, 'next' ) !== false ) {
			$type = 'next';
		} elseif ( strpos( $page, 'dots' ) !== false ) {
			$type = 'dots';
		} else {
			$type = 'page';
		}

		// Skip prev/next if only_numbers is true
		if ( $args['only_numbers'] && in_array( $type, [ 'prev', 'next' ], true ) ) {
			continue;
		}

		// Determine <li> class
		if ( $args['merge_classes'] ) {
			$item_class = match ( $type ) {
				'prev' => $args['item_prev_class'],
				'next' => $args['item_next_class'],
				'dots' => $args['item_dots_class'],
				default => $active ? $args['item_page_active_class'] : $args['item_page_class'],
			};
		} else {
			$item_class = trim(
				$args['item_class'] . ' ' . match ( $type ) {
					'prev' => $args['item_prev_class'],
					'next' => $args['item_next_class'],
					'dots' => $args['item_dots_class'],
					default => $active ? $args['item_page_active_class'] : $args['item_page_class'],
				}
			);
		}

		// Determine link/text class
		if ( $args['merge_classes'] ) {
			$text_class = match ( $type ) {
				'prev' => $args['link_prev_class'],
				'next' => $args['link_next_class'],
				'dots' => $args['text_dots_class'],
				default => $active ? $args['text_active_class'] : $args['link_page_class'],
			};
		} else {
			if ( $is_link ) {
				$text_class = trim(
					$args['link_class'] . ' ' . match ( $type ) {
						'prev' => $args['link_prev_class'],
						'next' => $args['link_next_class'],
						default => $args['link_page_class'],
					}
				);
			} else {
				$text_class = trim(
					$args['text_class'] . ' ' . match ( $type ) {
						'dots' => $args['text_dots_class'],
						default => $active ? $args['text_active_class'] : $args['text_page_class'],
					}
				);
			}
		}

		$item_content = preg_replace(
			'/class="[^"]*"/',
			'class="' . esc_attr( $text_class ) . '"',
			$page
		);

		$output .= '<li class="' . esc_attr( $item_class ) . '">' . $item_content . '</li>';
	}

	$output .= '</ul></nav>';

	if ( $args['echo'] ) {
		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $output;
	}
}

/**
 * Displays a hierarchical list of pages starting from the top parent of the current page.
 *
 * @param array $args {
 *     Optional. Array of arguments.
 *
 *     @type array  $get_pages_args          Additional arguments for get_pages(). Default is [].
 *     @type bool   $merge_classes           Whether to merge generic and depth-specific classes. Default is true.
 *     @type string $menu_class              Class for main menu <ul>. Default is ''.
 *     @type string $submenu_class           Generic submenu class <ul>. Default is ''.
 *     @type string $submenu_class_{n}       Depth-specific submenu class for level {n}. Default is not set.
 *     @type string $item_class              Generic item class <li>. Default is ''.
 *     @type string $item_class_{n}          Depth-specific item class for level {n}. Default is not set.
 *     @type string $item_active_class       Generic active item class <li>. Default is ''.
 *     @type string $item_active_class_{n}   Depth-specific active item class for level {n}. Default is not set.
 *     @type string $link_class              Generic link class <a>. Default is ''.
 *     @type string $link_class_{n}          Depth-specific link class for level {n}. Default is not set.
 *     @type string $link_active_class       Generic active link class <a>. Default is ''.
 *     @type string $link_active_class_{n}   Depth-specific active link class for level {n}. Default is not set.
 * }
 *
 * @return void Outputs the generated HTML markup directly.
 */
function ground_subpages( $args = array() ) {
	global $post;

	$current_id = get_the_ID();
	$parents = get_post_ancestors( $current_id );
	$top_parent_id = $parents ? end( $parents ) : $current_id;

	$defaults = array(
		'get_pages_args' => array(),
		'merge_classes' => true,
		'menu_class' => '',
		'submenu_class' => '',
		'item_class' => '',
		'item_active_class' => '',
		'link_class' => '',
		'link_active_class' => '',
	);

	$args = wp_parse_args( $args, $defaults );

	$get_pages_defaults = array(
		'child_of' => $top_parent_id,
		'sort_column' => 'menu_order, post_title',
		'hierarchical' => true,
		'post_status' => 'publish',
	);

	$pages = get_pages( wp_parse_args( $args['get_pages_args'], $get_pages_defaults ) );

	$pages_by_parent = array();
	foreach ( $pages as $page ) {
		$pages_by_parent[ $page->post_parent ][] = $page;
	}

	$display_hierarchy = function ( $parent_id = 0, $depth = 0 ) use ( &$display_hierarchy, $pages_by_parent, $args, $current_id ) {
		if ( ! isset( $pages_by_parent[ $parent_id ] ) ) {
			return '';
		}

		$output = '';
		$depth_key = $depth + 1;

		foreach ( $pages_by_parent[ $parent_id ] as $page ) {
			$is_active = ( $page->ID == $current_id );

			if ( $args['merge_classes'] ) {
				$item_class = $is_active
					? ( $args[ "item_active_class_$depth_key" ] ?? $args['item_active_class'] )
					: ( $args[ "item_class_$depth_key" ] ?? $args['item_class'] );

				$link_class = $is_active
					? ( $args[ "link_active_class_$depth_key" ] ?? $args['link_active_class'] )
					: ( $args[ "link_class_$depth_key" ] ?? $args['link_class'] );

				$submenu_class = $args[ "submenu_class_$depth_key" ] ?? $args['submenu_class'];
			} else {
				$item_class = trim( ( $args['item_class'] ?? '' ) . ' ' . ( $args[ "item_class_$depth_key" ] ?? '' ) );
				$link_class = trim( ( $args['link_class'] ?? '' ) . ' ' . ( $args[ "link_class_$depth_key" ] ?? '' ) );
				$submenu_class = trim( ( $args['submenu_class'] ?? '' ) . ' ' . ( $args[ "submenu_class_$depth_key" ] ?? '' ) );

				if ( $is_active ) {
					$item_class .= ' ' . ( $args['item_active_class'] ?? '' ) . ' ' . ( $args[ "item_active_class_$depth_key" ] ?? '' );
					$link_class .= ' ' . ( $args['link_active_class'] ?? '' ) . ' ' . ( $args[ "link_active_class_$depth_key" ] ?? '' );
				}
			}

			$output .= '<li class="' . esc_attr( trim( $item_class ) ) . '">';
			$output .= '<a href="' . get_permalink( $page->ID ) . '" class="' . esc_attr( trim( $link_class ) ) . '">' . esc_html( $page->post_title ) . '</a>';

			$child_output = $display_hierarchy( $page->ID, $depth + 1 );
			if ( $child_output ) {
				$output .= '<ul class="' . esc_attr( trim( $submenu_class ) ) . '">' . $child_output . '</ul>';
			}

			$output .= '</li>';
		}

		return $output;
	};

	$menu_output = $display_hierarchy( $top_parent_id, 0 );

	if ( ! empty( $menu_output ) ) {
		echo '<ul class="' . esc_attr( $args['menu_class'] ) . '">' . $menu_output . '</ul>';
	}
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
 * Generates and displays a hierarchical list of terms from a specified taxonomy.
 *
 * @param array $args {
 *     Optional. Array of arguments to control the display and behavior of the terms list.
 *
 *     @type string  $taxonomy            The taxonomy to retrieve terms from. Default is 'category'.
 *     @type bool    $echo                Whether to echo or return the output. Default is true.
 *     @type int     $child_of            The term ID to start the hierarchy from. Default is 0 (root).
 *     @type bool    $hide_empty          Whether to hide terms with no posts. Default is true.
 *     @type bool    $merge_classes       Whether to merge generic and depth-specific classes. Default is true.
 *     @type string  $menu_class          Classes for the root `<ul>` element. Default is an empty string.
 *     @type string  $submenu_class       Generic submenu class for `<ul>` elements. Default is an empty string.
 *     @type string  $submenu_class_{n}   Depth-specific submenu class for level {n}. Default is not set.
 *     @type string  $item_class          Generic item class for `<li>` elements. Default is an empty string.
 *     @type string  $item_class_{n}      Depth-specific item class for level {n}. Default is not set.
 *     @type string  $item_active_class   Generic active item class for `<li>` elements. Default is an empty string.
 *     @type string  $item_active_class_{n} Depth-specific active item class for level {n}. Default is not set.
 *     @type string  $link_class          Generic link class for term links. Default is an empty string.
 *     @type string  $link_class_{n}      Depth-specific link class for level {n}. Default is not set.
 *     @type string  $link_active_class   Generic active link class for term links. Default is an empty string.
 *     @type string  $link_active_class_{n} Depth-specific active link class for level {n}. Default is not set.
 * }
 *
 * @return string|void The HTML output of the terms list if `$arg['echo']` is false. Otherwise, the function echoes the output.
 */
function ground_terms( $arg = [] ) {
	$defaults = [
		'taxonomy' => 'category',
		'echo' => true,
		'child_of' => 0,
		'hide_empty' => true,
		'merge_classes' => true,
		'menu_class' => '',
		'submenu_class' => '',
		'item_class' => '',
		'item_active_class' => '',
		'link_class' => '',
		'link_active_class' => '',
	];
	$args = wp_parse_args( $arg, $defaults );
	$terms = get_terms( $args );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return;
	}

	$term_hierarchy = [];
	foreach ( $terms as $term ) {
		$term_hierarchy[ $term->parent ][] = $term;
	}

	if ( ! function_exists( 'ground_display_term_hierarchy' ) ) {
		function ground_display_term_hierarchy( $term_hierarchy, $args, $parent_id = 0, $depth = 0, $current_term_id = 0 ) {
			if ( ! isset( $term_hierarchy[ $parent_id ] ) ) {
				return '';
			}

			$output = '';
			$depth_key = $depth + 1;

			foreach ( $term_hierarchy[ $parent_id ] as $term ) {
				$is_active = $term->term_id == $current_term_id;

				$item_class = trim( $args['item_class'] . ' ' . ( isset( $args[ "item_class_$depth_key" ] ) ? $args[ "item_class_$depth_key" ] : '' ) );
				$link_class = trim( $args['link_class'] . ' ' . ( isset( $args[ "link_class_$depth_key" ] ) ? $args[ "link_class_$depth_key" ] : '' ) );
				$submenu_class = trim( $args['submenu_class'] . ' ' . ( isset( $args[ "submenu_class_$depth_key" ] ) ? $args[ "submenu_class_$depth_key" ] : '' ) );

				if ( $is_active ) {
					$item_class .= ' ' . $args['item_active_class'] . ' ' . ( isset( $args[ "item_active_class_$depth_key" ] ) ? $args[ "item_active_class_$depth_key" ] : '' );
					$link_class .= ' ' . $args['link_active_class'] . ' ' . ( isset( $args[ "link_active_class_$depth_key" ] ) ? $args[ "link_active_class_$depth_key" ] : '' );
				}

				if ( $args['merge_classes'] ) {
					$item_class = $is_active
						? ( isset( $args[ "item_active_class_$depth_key" ] ) ? $args[ "item_active_class_$depth_key" ] : $args['item_active_class'] )
						: ( isset( $args[ "item_class_$depth_key" ] ) ? $args[ "item_class_$depth_key" ] : $args['item_class'] );
					$link_class = $is_active
						? ( isset( $args[ "link_active_class_$depth_key" ] ) ? $args[ "link_active_class_$depth_key" ] : $args['link_active_class'] )
						: ( isset( $args[ "link_class_$depth_key" ] ) ? $args[ "link_class_$depth_key" ] : $args['link_class'] );
					$submenu_class = isset( $args[ "submenu_class_$depth_key" ] ) ? $args[ "submenu_class_$depth_key" ] : $args['submenu_class'];
				}

				$output .= '<li class="' . esc_attr( $item_class ) . '">';
				$output .= '<a href="' . get_term_link( $term ) . '" class="' . esc_attr( $link_class ) . '">' . $term->name . '</a>';

				$child_output = ground_display_term_hierarchy( $term_hierarchy, $args, $term->term_id, $depth + 1, $current_term_id );
				if ( $child_output ) {
					$output .= '<ul class="' . esc_attr( $submenu_class ) . '">' . $child_output . '</ul>';
				}

				$output .= '</li>';
			}

			return $output;
		}
	}

	$current_term_id = 0;
	if ( is_tax() || is_category() ) {
		$current_term = get_queried_object();
		if ( isset( $current_term->term_id ) ) {
			$current_term_id = $current_term->term_id;
		}
	}

	$output = '<ul class="' . esc_attr( $args['menu_class'] ) . '">';
	$output .= ground_display_term_hierarchy( $term_hierarchy, $args, $args['child_of'], 0, $current_term_id );
	$output .= '</ul>';

	if ( $args['echo'] ) {
		echo $output;
	} else {
		return $output;
	}
}

/**
 * Renders the breadcrumb navigation.
 *
 * @param array $args {
 *     Optional. An array of arguments to customize the breadcrumb output.
 *
 *     @type bool   $merge_classes      Whether to merge item and active item classes for the last breadcrumb item. Default is false.
 *     @type string $nav_class          CSS class for the `<nav>` element. Default is an empty string.
 *     @type string $list_class         CSS class for the `<ol>` wrapper element. Default is an empty string.
 *     @type string $item_class         CSS class for each breadcrumb `<li>` item. Default is an empty string.
 *     @type string $item_active_class CSS class for the active breadcrumb item. Default is an empty string.
 *     @type string $link_class         CSS class for the breadcrumb `<a>` links. Default is an empty string.
 *     @type string $separator          Separator between breadcrumb items. Default is '>'.
 *     @type string $separator_class    CSS class for the separator `<span>` element. Default is an empty string.
 * }
 *
 * @return void
 */
function ground_breadcrumbs( $args = [] ) {
	if ( ! function_exists( 'yoast_breadcrumb' ) || ! WPSEO_Options::get( 'breadcrumbs-enable', false ) ) {
		return;
	}

	$defaults = [
		'merge_classes' => false,
		'nav_class' => '',
		'list_class' => '',
		'item_class' => '',
		'item_active_class' => '',
		'link_class' => '',
		'separator' => '>',
		'separator_class' => '',
	];

	$args = wp_parse_args( $args, $defaults );

	$breadcrumbs = new WPSEO_Breadcrumbs();
	$breadcrumb_links = $breadcrumbs->get_links();

	if ( empty( $breadcrumb_links ) ) {
		return;
	}

	$output = [];
	$total = count( $breadcrumb_links );
	$current = 1;

	foreach ( $breadcrumb_links as $link ) {
		$url = isset( $link['url'] ) ? esc_url( $link['url'] ) : '';
		$text = isset( $link['text'] ) ? esc_html( $link['text'] ) : '';

		if ( $current === $total ) {
			$classes = $args['merge_classes'] ? $args['item_active_class'] : ( $args['item_class'] . ' ' . $args['item_active_class'] );
			$output[] = '<li class="' . esc_attr( $classes ) . '" aria-current="page">' . $text . '</li>';
		} else {
			$output[] = '<li class="' . esc_attr( $args['item_class'] ) . '">'
				. '<a href="' . $url . '" class="' . esc_attr( $args['link_class'] ) . '">' . $text . '</a>'
				. '<span class="' . esc_attr( $args['separator_class'] ) . '">' . $args['separator'] . '</span>'
				. '</li>';
		}

		$current++;
	}

	echo '<nav id="breadcrumb" class="' . esc_attr( $args['nav_class'] ) . '" aria-label="Breadcrumb">';
	echo '<ol class="' . esc_attr( $args['list_class'] ) . '">' . implode( '', $output ) . '</ol>';
	echo '</nav>';
}
