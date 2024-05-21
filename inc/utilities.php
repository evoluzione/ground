<?php
function ground_config( $configPath, $php = true ) {
	if ( $php ) {
		static $configs = []; // Array per il caching delle configurazioni

		$pathParts = explode( '.', $configPath );
		$fileName = array_shift( $pathParts );
		$filePath = GROUND_TEMPLATE_PATH . '/config/' . $fileName . '.php';

		if ( ! isset( $configs[ $fileName ] ) ) {
			if ( ! file_exists( $filePath ) ) {
				return false;
			}
			$configs[ $fileName ] = include ( $filePath );
		}

		return array_reduce( $pathParts, function ($data, $key) {
			return $data[ $key ] ?? null;
		}, $configs[ $fileName ] );
	} else {

		$jsonString = file_get_contents( GROUND_TEMPLATE_PATH . '/config/acf/group_5ddbd48c5a150.json' );
		$data = json_decode( $jsonString, true ); // Impostando true, otteniamo un array associativo
		return $data;
	}
}

/**
 * Excerpt with custom length
 *
 * Summary or description of a post with custom length
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
		$excerpt = mb_substr( $content, 0, $length, get_bloginfo( 'charset' ) );
	} else {
		$content = get_the_excerpt();
		$excerpt = mb_substr( $content, 0, $length, get_bloginfo( 'charset' ) );
	}

	if ( strlen( $content ) > $length ) {
		$excerpt = $excerpt . $after_text;
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
 *     @type string|int[] $size    Image size. Accepts any registered image size name, or an array of width and height values in pixels (in that order). Default 'thumbnail'.
 *     @type string|array  $attr   Query string or array of attributes. Default empty array. https://developer.wordpress.org/reference/functions/wp_get_attachment_image/#parameters
 *     @type mixed  $post          The post object or ID from which the image should be fetched. Default null.
 *     @type string $default_image URL to a default fallback image if no image is found. Default is fetched via ground_config('media.no_image_url').
 *     @type bool   $return_url    Whether to fetch the image URL instead of an HTML img tag. Default false.
 *     @type string $attachment_id WordPress attachment ID for the image. Default empty.
 *     @type bool   $responsive    Whether to include 'srcset' and 'sizes' attributes for responsive images. Default true.
 *     @type bool   $echo          Whether to echo the output or return it. Default true.
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
		'default_image' => ground_config( 'media.no_image_url' ),
		'return_url' => false,
		'attachment_id' => '',
		'responsive' => true,
		'echo' => true
	];
	$args = array_replace_recursive( $defaults, $args );

	$size = $args['size'];
	$attr = $args['attr'];
	$post = $args['post'];
	$default_image = $args['default_image'];
	$return_url = $args['return_url'];
	$attachment_id = $args['attachment_id'];
	$responsive = $args['responsive'];
	$echo = $args['echo'];

	$output = '';

	if ( ! empty( $attachment_id ) ) {
		$output = wp_get_attachment_image( $attachment_id, $size, false, $attr );
	} elseif ( $return_url ) {
		$output = get_the_post_thumbnail_url( $post, $size );
	} else {
		$output = get_the_post_thumbnail( $post, $size, $attr );
	}

	// Remove 'srcset' and 'sizes' attributes if not responsive
	if ( ! $responsive && ! empty( $output ) ) {
		$output = preg_replace( '/\s+(srcset|sizes)=[\'"][^\'"]+[\'"]/i', '', $output );
	}

	// Handle default fallback image
	if ( empty( $output ) && ! empty( $default_image ) ) {

		if ( is_array( $size ) ) {
			$attr['width'] = $size[0];
			$attr['height'] = $size[1];
		} else {
			global $_wp_additional_image_sizes;
			$attr['width'] = $_wp_additional_image_sizes[ $size ]['width'];
			$attr['height'] = $_wp_additional_image_sizes[ $size ]['height'];
		}

		$output = '<img src="' . esc_url( $default_image ) . '"';
		foreach ( $attr as $key => $value ) {
			if ( $value !== '' && $value !== null ) {
				$output .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
			}
		}
		$output .= ' />';
	}

	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
}

/**
 * Retrieves an SVG icon with custom attributes and returns or echoes it.
 *
 * @param array $args {
 *     Optional. An associative array of arguments.
 *
 *     @type string $name The name of the icon file.
 *     @type array $attr An associative array of attributes to add to the SVG element.
 *     @type string $icon_set The name of the icon set. Default is 'lucide'.
 *     @type bool $return_url Whether to return the URL of the icon instead of the markup. Default is false.
 *     @type string $file_extension The file extension of the icon. Default is 'svg'.
 *     @type bool $echo Whether to return the SVG markup instead of echoing it. Default is false.
 * }
 * @return string|void The SVG markup with custom attributes, or void if $return is false.
 */
function ground_icon( $args = [] ) {
	$defaults = [ 
		'name' => '',
		'attr' => [ 
			'class' => '',
		],
		'icon_set' => 'lucide',
		'return_url' => false,
		'file_extension' => 'svg',
		'echo' => false,
	];

	$args = wp_parse_args( $args, $defaults );

	if ( empty( $args['name'] ) ) {
		return;
	}

	$name = $args['name'];
	$return_url = $args['return_url'];
	$icon_set = $args['icon_set'];
	$file_extension = $args['file_extension'];
	$echo = $args['echo'];
	$attr = $args['attr'];

	if ( $return_url ) {
		return GROUND_TEMPLATE_URL . "/assets/icons/$icon_set/$name.$file_extension";
	}

	$file_path = GROUND_TEMPLATE_PATH . "/assets/icons/$icon_set/$name.$file_extension";
	if ( ! file_exists( $file_path ) || ! is_readable( $file_path ) ) {
		return;
	}

	$markup = file_get_contents( $file_path );

	// Load the SVG content into a DOMDocument
	$dom = new DOMDocument();
	$dom->loadXML( $markup );

	// Get the <svg> element
	$svg = $dom->getElementsByTagName( 'svg' )->item( 0 );

	// Add or update attributes
	foreach ( $attr as $key => $value ) {
		$svg->setAttribute( $key, $value );
	}

	// Save the updated SVG content without XML declaration
	$icon = $dom->saveXML( $svg );
	$icon = str_replace( '<?xml version="1.0"?>', '', $icon );

	if ( $echo ) {
		return $icon;
	} else {
		echo $icon;
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
	$big = 999999999;

	$defaults = array(
		'prev_text' => __( '&laquo; Previous' ),
		'next_text' => __( 'Next &raquo;' ),
		'mid_size' => 2,
		'total' => $wp_query->max_num_pages,
		'current' => max( 1, get_query_var( 'paged' ) ),
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'type' => 'array',
		'only_numbers' => false,
		'echo' => true,
		'nav_class' => '',
		'list_class' => '',
		'prev_class' => '',
		'prev_link_class' => '',
		'next_class' => '',
		'next_link_class' => '',
		'dots_class' => '',
		'dots_text_class' => '',
		'page_class' => '',
		'page_active_class' => '',
		'page_link_class' => '',
		'page_text_active_class' => '',
	);

	$args = wp_parse_args( $args, $defaults );
	$paginate = paginate_links( $args );

	if ( $paginate ) {
		$output = '<nav class="' . esc_attr( $args['nav_class'] ) . '" aria-label="pagination">';
		$output .= '<ul class="' . esc_attr( $args['list_class'] ) . '">';

		foreach ( $paginate as $page ) {
			if ( false !== strpos( $page, 'prev' ) ) {
				// Prev
				if ( $args['only_numbers'] ) {
					continue;
				}
				$output .= '<li class="' . esc_attr( $args['prev_class'] ) . '">' . str_replace( array( 'prev', 'page-numbers' ), array( esc_attr( $args['prev_link_class'] ) ), $page ) . '</li>';
			} elseif ( false !== strpos( $page, 'next' ) ) {
				// Next
				if ( $args['only_numbers'] ) {
					continue;
				}
				$output .= '<li class="' . esc_attr( $args['next_class'] ) . '">' . str_replace( array( 'next', 'page-numbers' ), array( esc_attr( $args['next_link_class'] ) ), $page ) . '</li>';
			} elseif ( false !== strpos( $page, 'dots' ) ) {
				// Dots
				$output .= '<li class="' . esc_attr( $args['dots_class'] ) . '">' . str_replace( array( 'dots', 'page-numbers' ), array( esc_attr( $args['dots_text_class'] ) ), $page ) . '</li>';
			} else {
				// Pages
				$active = false !== strpos( $page, 'current' );

				if ( $active ) {
					$page_class = ' ' . esc_attr( $args['page_active_class'] );
					$page_link_class = ' ' . esc_attr( $args['page_text_active_class'] );
				} else {
					$page_class = ' ' . esc_attr( $args['page_class'] );
					$page_link_class = ' ' . esc_attr( $args['page_link_class'] );
				}
				$output .= '<li class="' . $page_class . '">' . str_replace( 'page-numbers', $page_link_class, $page ) . '</li>';
			}
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
