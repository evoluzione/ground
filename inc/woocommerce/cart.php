<?php

/**
 * Cart
 *
 * @package Ground
 */


 /**
  * Add minicart
  */
function ground_woocommerce_minicart() {
	get_template_part( 'template-parts/woocommerce/minicart' );
}

add_action( 'wp_body_open', 'ground_woocommerce_minicart', 5 );


/**
 * Add cross-sells products in minicart
 *
 * @link https://github.com/woocommerce/woocommerce/blob/master/templates/cart/mini-cart.php
 * @link https://hotexamples.com/examples/-/-/woocommerce_cross_sell_display/php-woocommerce_cross_sell_display-function-examples.html
 */
function ground_add_crosssells_minicart() {
	wp_reset_query();
	woocommerce_cross_sell_display( 3 );
}

add_action( 'woocommerce_mini_cart_contents', 'ground_add_crosssells_minicart' );

/**
 * Remove attributes in product title
 */
add_filter( 'woocommerce_product_variation_title_include_attributes', '__return_false' );
add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );

/**
 * Move cross sells under cart table
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'ground_woocommerce_after_cart_form', 'woocommerce_cross_sell_display' );


/**
 * Cart fragment
 *
 * @see ground_woocommerce_cart_link_fragment()
 */
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'ground_woocommerce_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'ground_woocommerce_cart_link_fragment' );
}


if ( ! function_exists( 'ground_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments
	 * Ensure cart contents update when products are added to the cart via AJAX
	 *
	 * @param  array $fragments Fragments to refresh via AJAX.
	 * @return array            Fragments to refresh via AJAX
	 */
	function ground_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		ground_woocommerce_cart_link();
		$fragments['a.shopping-cart'] = ob_get_clean();

		return $fragments;
	}
}


if ( ! function_exists( 'ground_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function ground_woocommerce_cart_link() {
		get_template_part( 'template-parts/woocommerce/shopping-cart' );
	}
}

/**
 * Show SKU on cart pages
 */
function ground_sku_below_cart_item_name( $cart_item, $cart_item_key ) {
	$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	$sku      = $_product->get_sku();
	if ( ! $sku ) {
		return;
	}
	echo '<p class="mt-2"><small>' . __( 'Code', 'ground' ) . ': ' . $sku . '</small></p>';
}

add_action( 'woocommerce_after_cart_item_name', 'ground_sku_below_cart_item_name', 11, 2 );



/**
 * Add icon add to cart Button
 *
 * @param [type] $button
 */
function ground_add_icon_add_cart_button_single( $button ) {
	$button_new = ground_icon( 'shopping-cart', 'button__icon' ) . $button;
	return $button_new;
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'ground_add_icon_add_cart_button_single' );
