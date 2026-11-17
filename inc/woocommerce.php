<?php
/**
 * Returns the 'woocommerce_' entries of config/media.php, keyed without the prefix.
 *
 * @return array
 */
function ground_woocommerce_config_sizes() {

	$sizes = array();

	foreach ( (array) ground_config( 'media.sizes' ) as $name => $size ) {
		if ( str_starts_with( $name, 'woocommerce_' ) ) {
			$sizes[ substr( $name, strlen( 'woocommerce_' ) ) ] = $size;
		}
	}

	return $sizes;
}

/**
 * WooCommerce integration.
 *
 * Declaring the product image widths as theme support is what makes WooCommerce
 * drop its own Customizer controls for them.
 *
 * @return void
 */
function ground_woocommerce_support() {

	$sizes = ground_woocommerce_config_sizes();
	$width = static function ( $name ) use ( $sizes ) {
		return isset( $sizes[ $name ]['width'] ) ? (int) $sizes[ $name ]['width'] : null;
	};

	// Declare WooCommerce support (enables template overrides).
	add_theme_support( 'woocommerce', array_filter( array(
		'thumbnail_image_width' => $width( 'thumbnail' ),
		'single_image_width' => $width( 'single' ),
		'gallery_thumbnail_image_width' => $width( 'gallery_thumbnail' ),
	) ) );

	// Single-product gallery features (zoom / lightbox / slider).
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'ground_woocommerce_support' );

/**
 * Enforces WooCommerce image dimensions from config/media.php.
 *
 * Theme support carries only the widths; wc_get_image_size() applies these
 * filters last, so they govern height and crop for the generated files as well
 * as the displayed ones. A `height` of 0 means width-only.
 *
 * @return void
 */
function ground_woocommerce_image_sizes() {

	foreach ( ground_woocommerce_config_sizes() as $name => $size ) {
		add_filter( "woocommerce_get_image_size_{$name}", function () use ($size) {
			return array(
				'width' => (int) ( $size['width'] ?? 0 ),
				'height' => ( (int) ( $size['height'] ?? 0 ) ) ?: 9999,
				'crop' => empty( $size['crop'] ) ? 0 : 1,
			);
		} );
	}
}

add_action( 'after_setup_theme', 'ground_woocommerce_image_sizes' );

/**
 * Removes WooCommerce's "Product Images" Customizer section.
 *
 * Theme support already drops the width controls; what is left is thumbnail
 * cropping, which the filters above override anyway.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer manager instance.
 * @return void
 */
function ground_woocommerce_remove_image_customizer( $wp_customize ) {
	$wp_customize->remove_section( 'woocommerce_product_images' );
}

add_action( 'customize_register', 'ground_woocommerce_remove_image_customizer', 20 );

// Disables WooCommerce's bundled frontend stylesheets (woocommerce.css,
// woocommerce-layout.css, woocommerce-smallscreen.css). They ship as plain,
// un-layered CSS, while Tailwind's output lives inside `@layer utilities` —
// per the CSS cascade-layers spec, un-layered rules always win over layered
// ones regardless of specificity or load order, so WooCommerce's defaults
// would otherwise silently override theme utilities on shared selectors.
// The theme owns WooCommerce markup styling instead (see src/css/woocommerce/).
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Registers the AJAX fragments WooCommerce's add-to-cart.js swaps in after an
 * AJAX add-to-cart or a mini-cart removal: the header trigger (count badge) and
 * the mini-cart drawer contents, rendered from the same template parts as the
 * header (template-parts/cart/) and keyed by their root selectors.
 * wc-cart-fragments.js is not loaded, so a page load does not refresh them.
 *
 * @param array $fragments Fragments keyed by selector.
 * @return array
 */
function ground_woocommerce_cart_fragments( $fragments ) {

	ob_start();
	get_template_part( 'template-parts/cart/cart-link' );
	$fragments['a.cart-contents'] = ob_get_clean();

	ob_start();
	get_template_part( 'template-parts/cart/cart-drawer-content' );
	$fragments['div.mini-cart-panel-content'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'ground_woocommerce_cart_fragments' );
