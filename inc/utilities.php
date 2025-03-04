<?php
/**
 * Retrieves a configuration value from a config file.
 *
 * @param string $configPath The dot notation for the config key (e.g., "app.debug").
 * @return mixed The corresponding value, or null/false if the file does not exist.
 */
function ground_config( $configPath ) {
	static $configs = [];

	$pathParts = explode( '.', $configPath );
	$fileName = array_shift( $pathParts );

	// Load and cache the file if not already cached
	if ( ! isset( $configs[ $fileName ] ) ) {
		$filePath = GROUND_TEMPLATE_DIRECTORY . '/config/' . $fileName . '.php';

		if ( ! file_exists( $filePath ) ) {
			return null;
		}

		$configs[ $fileName ] = include $filePath;
	}

	$data = $configs[ $fileName ];
	foreach ( $pathParts as $key ) {
		if ( ! isset( $data[ $key ] ) ) {
			return null;
		}
		$data = $data[ $key ];
	}

	return $data;
}

/**
 * Excerpt with custom length
 *
 * Summary or description of a post with custom length.
 *
 * @param int             $length     Optional. Excerpt length in characters. Default is 100.
 * @param string          $after_text Optional. Characters to add at the end of the text. Default is "...".
 * @param int|WP_Post     $post       Optional. Post ID or post object. Default is global $post.
 * @param bool            $echo       Optional. If true, echoes the excerpt, otherwise returns it. Default true.
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
 * Retrieve an image using the WordPress attachment ID if provided. If no ID is provided,
 * it will try to use the post's thumbnail URL. If neither are available, it falls back to a default image URL.
 * Additionally, it allows control over the HTML output, such as removing responsive attributes and customizing HTML attributes.
 *
 * @param array $args {
 *     Optional. An array of parameters for retrieving the image.
 *
 *     @type string|int[] $size           Image size. Accepts any registered image size name, or an array of width and height values in pixels (in that order). Default 'thumbnail'.
 *     @type string|array $attr           Query string or array of attributes. Default ['loading' => 'lazy']. See https://developer.wordpress.org/reference/functions/wp_get_attachment_image/#parameters
 *     @type WP_Post|int|null $post       The post object or ID from which the image should be fetched. Default null.
 *     @type string $placeholder          URL to a default fallback image if no image is found. Default is fetched via ground_config('media.placeholder_url').
 *     @type bool $return_url             Whether to fetch the image URL instead of an HTML img tag. Default false.
 *     @type int|string $attachment_id    WordPress attachment ID for the image. Default empty.
 *     @type bool $responsive             Whether to include 'srcset' and 'sizes' attributes for responsive images. Default true.
 *     @type bool $echo                   Whether to echo the output or return it. Default true.
 * }
 * @return string|null The image HTML or URL, or null if 'echo' is set to true.
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
 *     Optional. An associative array of arguments.
 *
 *     @type string $name The name of the icon file. Required.
 *     @type array  $attr An associative array of attributes to add to the SVG element. Default is ['class' => ''].
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
 * Generate pagination.
 */
function ground_pagination( $args = array() ) {
	global $wp_query;
	$pagination_placeholder = 999999999;

	$defaults = array(
		'prev_text' => __( '&laquo; Previous' ),
		'next_text' => __( 'Next &raquo;' ),
		'mid_size' => 2,
		'total' => $wp_query->max_num_pages,
		'current' => max( 1, get_query_var( 'paged' ) ),
		'base' => str_replace( $pagination_placeholder, '%#%', esc_url( get_pagenum_link( $pagination_placeholder ) ) ),
		'format' => '?paged=%#%',
		'type' => 'array',
		'only_numbers' => false,
		'echo' => true,
		'merge_classes' => false,

		'container_class' => '',
		'list_class' => '',

		'item_class' => '', //
		'item_active_class' => '', //

		'item_prev_class' => '', //
		'item_next_class' => '', //
		'item_dots_class' => '', //
		'item_page_class' => '', //

		'item_page_active_class' => '', //

		'link_class' => '',//
		// 'link_active_class' => '', // In teoria non esiste perchè solo testo

		'link_prev_class' => '', //
		'link_next_class' => '', //
		'link_page_class' => '', //

		'text_class' => '',
		'text_page_class' => '',
		'text_dots_class' => '', //

		'text_active_class' => '',

		// ??
		'item_link_active_class' => '',
	);

	$args = wp_parse_args( $args, $defaults );
	$paginate = paginate_links( $args );

	if ( $paginate ) {
		$output = '<nav class="' . esc_attr( $args['container_class'] ) . '" aria-label="pagination">';
		$output .= '<ul class="' . esc_attr( $args['list_class'] ) . '">';

		foreach ( $paginate as $page ) {
			$active = false !== strpos( $page, 'current' );
			$is_link = strpos( $page, '<a ' ) !== false;

			// Determina il tipo: prev, next, dots o page (numerica)
			$type = 'page';
			if ( strpos( $page, 'prev' ) !== false ) {
				$type = 'prev';
			} elseif ( strpos( $page, 'next' ) !== false ) {
				$type = 'next';
			} elseif ( strpos( $page, 'dots' ) !== false ) {
				$type = 'dots';
			}

			// Imposta le classi per l'elemento <li>
			if ( $args['merge_classes'] ) {
				switch ( $type ) {
					case 'prev':
						$item_class = $args['item_prev_class'];
						break;
					case 'next':
						$item_class = $args['item_next_class'];
						break;
					case 'dots':
						$item_class = $args['item_dots_class'];
						break;
					case 'page':
					default:
						$item_class = $active ? $args['item_page_active_class'] : $args['item_page_class'];
						break;
				}
			} else {
				$item_class = $args['item_class'];
				if ( 'prev' === $type ) {
					$item_class .= ' ' . $args['item_prev_class'];
				} elseif ( 'next' === $type ) {
					$item_class .= ' ' . $args['item_next_class'];
				} elseif ( 'dots' === $type ) {
					$item_class .= ' ' . $args['item_dots_class'];
				} elseif ( 'page' === $type ) {
					$item_class .= ' ' . $args['item_page_class'];
					if ( $active ) {
						$item_class .= ' ' . $args['item_page_active_class'];
					}
				}
			}

			// Imposta le classi per l'elemento interno (<a> o <span>)
			if ( $args['merge_classes'] ) {
				// Se merge true si usano solo le classi specifiche
				switch ( $type ) {
					case 'prev':
						$text_class = $args['link_prev_class'];
						break;
					case 'next':
						$text_class = $args['link_next_class'];
						break;
					case 'dots':
						$text_class = $args['text_dots_class'];
						break;
					case 'page':
					default:
						$text_class = $active ? $args['text_active_class'] : $args['link_page_class'];
						break;
				}
			} else {
				// Merge false: per i link e per gli span si aggiunge la classe base
				if ( $is_link ) {
					$text_class_array = array();
					$text_class_array[] = $args['link_class'];
					if ( 'prev' === $type ) {
						$text_class_array[] = $args['link_prev_class'];
					} elseif ( 'next' === $type ) {
						$text_class_array[] = $args['link_next_class'];
					} elseif ( 'page' === $type ) {
						$text_class_array[] = $args['link_page_class'];
					}
					$text_class = implode( ' ', array_unique( $text_class_array ) );
				} else {
					// Per gli span, aggiungiamo la classe base per il testo
					$text_class_array = array();
					$text_class_array[] = $args['text_class'];
					if ( 'dots' === $type ) {
						$text_class_array[] = $args['text_dots_class'];
					} elseif ( 'page' === $type ) {
						// Se la pagina è attiva, aggiungiamo la classe specifica per active
						if ( $active ) {
							$text_class_array[] = $args['text_active_class'];
						} else {
							$text_class_array[] = $args['text_page_class'];
						}
					}
					$text_class = implode( ' ', array_unique( $text_class_array ) );
				}
			}

			// Sostituisce l'attributo class degli elementi interni con la stringa definita
			$item_content = preg_replace_callback(
				'/class="[^"]*"/',
				function ($matches) use ($text_class) {
					return 'class="' . trim( $text_class ) . '"';
				},
				$page
			);

			$output .= '<li class="' . esc_attr( trim( $item_class ) ) . '">' . $item_content . '</li>';
		}

		$output .= '</ul>';
		$output .= '</nav>';

		if ( $args['echo'] ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

/**
 * Displays a hierarchical list of pages starting from the top parent of the current page.
 *
 * This function retrieves all pages under the top parent of the current page and displays them
 * in a nested list structure. The function allows customization of classes for various levels
 * of depth, active states, and merges classes if specified.
 *
 * @param array $args {
 *     Optional. An array of arguments.
 *
 *     @type array  $get_pages_args Additional arguments to pass to get_pages(). See https://developer.wordpress.org/reference/functions/get_pages/
 *     @type bool   $merge_classes Whether to merge classes for different depth levels. Default true.
 *     @type string $menu_class Class to assign to the main menu <ul> element. Default 'MENU'.
 *     @type string $submenu_class Generic class to assign to submenu <ul> elements. Default 'SUBMENU-GENERIC pl-6'.
 *     @type string $item_class Generic class to assign to <li> elements. Default 'ITEM-GENERIC'.
 *     @type string $item_active_class Generic class to assign to active <li> elements. Default 'ITEM-ACTIVE'.
 *     @type string $link_class Generic class to assign to <a> elements. Default 'LINK-GENERIC'.
 *     @type string $link_active_class Generic class to assign to active <a> elements. Default 'LINK-ACTIVE'.
 *     @type string $submenu_class_{$depth} Classes for submenu <ul> elements at depth {$depth} Default ''.
 *     @type string $item_class_{$depth} Classes for <li> elements at depth {$depth} Default ''.
 *     @type string $item_active_class_{$depth} Classes for active <li> elements at depth {$depth} Default ''.
 *     @type string $link_class_{$depth} Classes for <a> elements at depth {$depth} Default ''.
 *     @type string $link_active_class_{$depth} Classes for active <a> elements at depth {$depth} Default ''.
 * }
 */
function ground_subpages( $args = array() ) {
	$current_id = get_the_ID();
	$parents = get_post_ancestors( $current_id );
	$top_parent_id = $parents ? $parents[ count( $parents ) - 1 ] : $current_id;

	$defaults = array(
		'child_of' => $top_parent_id,
		'sort_column' => 'menu_order, post_title',
		'merge_classes' => true,
		'menu_class' => '',
		'submenu_class' => '',
		//'submenu_class_1' => '',
		'item_class' => '',
		// 'item_class_1' => '',
		'item_active_class' => '',
		// 'item_active_class_1' => '',
		'link_class' => '',
		// 'link_class_1' => '',
		'link_active_class' => '',
		// 'link_active_class_1' => '',
	);

	$args = wp_parse_args( $args, $defaults );
	$pages = get_pages( $args );

	function ground_display_page_hierarchy( $pages, $args, $parent_id = 0, $depth = 0, $current_id = 0, $parents = array() ) {
		$output = '';
		foreach ( $pages as $page ) {
			if ( $page->post_parent == $parent_id ) {
				$is_active = ( $page->ID == $current_id );
				$depth_key = $depth + 1;

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
				$output .= '<a href="' . get_permalink( $page->ID ) . '" class="' . esc_attr( $link_class ) . '">' . $page->post_title . '</a>';
				$child_output = ground_display_page_hierarchy( $pages, $args, $page->ID, $depth + 1, $current_id, $parents );
				if ( $child_output ) {
					$output .= '<ul class="' . esc_attr( $submenu_class ) . '">' . $child_output . '</ul>';
				}
				$output .= '</li>';
			}
		}
		return $output;
	}

	$menu_output = ground_display_page_hierarchy( $pages, $args, $top_parent_id, 0, $current_id, $parents );
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
 * @return string|null The list of term links if $echo is false, null otherwise.
 */
function ground_current_terms( $taxonomy = 'category', $class = '', $separator = ', ', $echo = true ) {

	$post_id = get_the_ID();
	$terms = get_the_terms( $post_id, $taxonomy );
	$output = '';

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$output .= '<a class="' . esc_attr( $class ) . '" href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>' . $separator;
		}
	}

	$terms_list = trim( $output, $separator );

	if ( $echo ) {
		echo $terms_list;
	} else {
		return $terms_list;
	}
}

/**
 * Generates and displays a hierarchical list of terms from a specified taxonomy.
 *
 * @param array $arg {
 *     Optional. Array of arguments to control the display and behavior of the terms list.
 *
 *     @type string  $taxonomy            The taxonomy to retrieve terms from. Default 'category'.
 *     @type bool    $echo                Whether to echo or return the output. Default true.
 *     @type int     $child_of            The term ID to start the hierarchy from. Default 0 (root).
 *     @type bool    $hide_empty          Whether to hide terms with no posts. Default true.
 *     @type bool    $merge_classes       Whether to merge item/link/submenu classes for hierarchy levels. Default true.
 *     @type string  $menu_class          Classes for the root `<ul>` element. Default 'list-disc ps-6 mb-24'.
 *     @type string  $submenu_class       Classes for the first-level submenu `<ul>` elements. Default 'list-disc ps-6 pl-6'.
 *     @type string  $submenu_class_2     Classes for the second-level submenu `<ul>` elements. Default 'list-disc ps-6 pl-6'.
 *     @type string  $item_class          Classes for `<li>` elements. Default ''.
 *     @type string  $item_active_class   Classes for active `<li>` elements. Default ''.
 *     @type string  $link_class          Classes for term links. Default ''.
 *     @type string  $link_active_class   Classes for active term links. Default 'text-primary'.
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
		'menu_class' => 'list-disc ps-6 mb-24',
		'submenu_class' => 'list-disc ps-6 pl-6',
		'submenu_class_2' => 'list-disc ps-6 pl-6',
		'item_class' => '',
		'item_active_class' => '',
		'link_class' => '',
		'link_active_class' => 'text-primary',
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
			foreach ( $term_hierarchy[ $parent_id ] as $term ) {
				$is_active = $term->term_id == $current_term_id;
				$depth_key = $depth + 1;

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

	$output = '<ul class="' . esc_attr( $args['menu_class'] ) . '">';
	$output .= ground_display_term_hierarchy( $term_hierarchy, $args, $args['child_of'], 0, 0 );
	$output .= '</ul>';
	if ( $args['echo'] ) {
		echo $output;
	} else {
		return $output;
	}
}

/**
 * Renders the breadcrumb navigation.
 * TODO: Merge classes
 *
 * @param array $args {
 *     Optional. An array of arguments to customize the breadcrumb output.
 *
 *     @type string $nav_class         CSS class for the `<nav>` element. Default empty.
 *     @type string $list_class        CSS class for the `<ol>` wrapper element. Default empty.
 *     @type string $item_class        CSS class for each breadcrumb `<li>` item. Default empty.
 *     @type string $item_active_class CSS class for the active breadcrumb item. Default empty.
 *     @type string $link_class        CSS class for the breadcrumb `<a>` links. Default empty.
 *     @type string $separator         Separator between breadcrumb items. Default '»'.
 *     @type string $separator_class   CSS class for the separator `<span>` element. Default empty.
 * }
 * @return void
 */
function ground_breadcrumbs( $args = [] ) {
	if ( function_exists( 'yoast_breadcrumb' ) && WPSEO_Options::get( 'breadcrumbs-enable', false ) ) {

		$defaults = [ 
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

		if ( ! empty( $breadcrumb_links ) ) {
			echo '<nav id="breadcrumb" class="' . esc_attr( $args['nav_class'] ) . '" aria-label="Breadcrumb">';
			echo '<ol class="' . esc_attr( $args['list_class'] ) . '">';

			$total = count( $breadcrumb_links );
			$current = 1;

			foreach ( $breadcrumb_links as $link ) {
				$url = isset( $link['url'] ) ? $link['url'] : '';
				$text = isset( $link['text'] ) ? $link['text'] : '';

				if ( $current == $total ) {
					echo '<li class="' . esc_attr( $args['item_active_class'] ) . '" aria-current="page">';
					echo esc_html( $text );
					echo '</li>';
				} else {
					echo '<li class="' . esc_attr( $args['item_class'] ) . '">';
					echo '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $args['link_class'] ) . '">' . esc_html( $text ) . '</a>';
					echo '<span class="' . esc_attr( $args['separator_class'] ) . '">' . $args['separator'] . '</span>';
					echo '</li>';
				}

				$current++;
			}

			echo '</ol>';
			echo '</nav>';
		}
	}
}