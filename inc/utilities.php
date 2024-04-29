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
 * Gets the featured image of a specifific post
 *
 * @param string           $size Image size name.
 * @param int|WP_Post|null $post Optional. Post ID or post object. Default is global $post.
 * @param boolean          $url Optional. Return url or image array. Default return url.
 * @param boolean          $echo Optional. Echo returned url. Default echo the url.
 * @return array|string|null Returns URL if $echo is true, otherwise returns the URL or null if no image found.
 */
function ground_image( $size = 'thumbnail', $post = null, $url = true, $echo = true ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), $size );
	if ( $image ) {
		$image = ( $url ) ? $image[0] : $image;

		if ( $echo ) {
			echo esc_html( $image );
		} else {
			return $image;
		}
	} else {
		return null; // Return null if no image found
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
function ground_icon( $name = '', $additional_class = '', $icon_set = 'css-gg', $child = false, $url = false, $extension = 'svg', $tag = 'span', $return = false ) {
	if ( '' === $name ) {
		return;
	}

	if ( $url ) {
		$path = $child ? GROUND_CHILD_TEMPLATE_URL : GROUND_TEMPLATE_URL;
		return $path . '/assets/icons/' . $icon_set . '/' . $name . '.' . $extension;
	} else {
		$path = $child ? GROUND_CHILD_TEMPLATE_PATH : GROUND_TEMPLATE_PATH;
		$markup = '<' . $tag . ' class="icon icon--' . $name . ' ' . $additional_class . '">';
		$markup .= file_get_contents( $path . '/assets/icons/' . $icon_set . '/' . $name . '.' . $extension );
		$markup .= '</' . $tag . '>';

		if ( $return ) {
			return $markup;
		} else {
			echo $markup;
		}
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
