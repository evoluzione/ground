<?php

/**
 * Add attachment gallery attributes
 *
 * @param string $link Attachment page link.
 * @param int    $id Post ID or post object.
 * @return string
 */
function ground_gallery_modal( $link, $id ) {
	$image_attributes = wp_get_attachment_image_src( $id, 'full' );
	return str_replace( '<a href', '<a data-modal="gallery" data-pswp-width="' . $image_attributes[1] . '" data-pswp-height="' . $image_attributes[2] . '" data-router-disabled href', $link );
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
 * Custom Breadcrumb using Yoast SEO Plugin
 *
 * @link https://fellowtuts.com/wordpress/custom-breadcrumb-navigation-yoast-seo/
 * @return void
 */
function ground_yoast_breadcrumb() {
	$crumb = array();
	$dom = new DOMDocument();

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
	$dom = $items->query( '//*[contains(@class, "breadcrumb_last")]' );

	if ( $dom->item( 0 ) && $dom->item( 0 )->nodeValue ) {
		$crumb[] = array(
			'text' => $dom->item( 0 )->nodeValue,
			'href' => '',
		);
	}

	$html = '';
	if ( $crumb ) {
		$items = count( $crumb ) - 1;
		$html = '<nav class="breadcrumb">';
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
	get_template_part( 'template-parts/search/search-ajax-preview' );
	return ob_get_clean();
}

add_action( 'wp_ajax_data_fetch', 'ground_ajax_search_data_fetch' );
add_action( 'wp_ajax_nopriv_data_fetch', 'ground_ajax_search_data_fetch' );

