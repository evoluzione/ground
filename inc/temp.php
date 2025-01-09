<?php
// Rapporti diversi per gli embed (ad esempio, 4:3 o 1:1) e gestisce il default con tailwind

function custom_wp_embed_html( $html, $url, $attr, $post_ID ) {
	if ( strpos( $url, 'instagram.com' ) !== false ) {
		// Per Instagram: proporzione quadrata (1:1)
		return '<div class="aspect-w-1 aspect-h-1">' . $html . '</div>';
	} elseif ( strpos( $url, 'tiktok.com' ) !== false ) {
		// Per TikTok: proporzione verticale (9:16)
		return '<div class="aspect-w-9 aspect-h-16">' . $html . '</div>';
	}

	// Default: proporzione 16:9
	return '<div class="aspect-w-16 aspect-h-9">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'custom_wp_embed_html', 10, 4 );



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
 * Ajax search result
 */
function ground_ajax_search_data_fetch() {
	ob_start();
	get_template_part( 'partials/search/search-ajax-preview' );
	return ob_get_clean();
}

add_action( 'wp_ajax_data_fetch', 'ground_ajax_search_data_fetch' );
add_action( 'wp_ajax_nopriv_data_fetch', 'ground_ajax_search_data_fetch' );

