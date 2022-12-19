<?php

/**
 * Price
 *
 * @package Ground
 */



/**
 * @snippet       Variable Product Price Range: "From: min_price"
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 6
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

function ground_woocommerce_variation_price_format( $price, $product ) {
	$prices = $product->get_variation_prices( true );
	$min_price = current( $prices['price'] );
	$max_price = end( $prices['price'] );
	$min_reg_price = current( $prices['regular_price'] );
	$max_reg_price = end( $prices['regular_price'] );
	if ( $min_price !== $max_price || ( $product->is_on_sale() && $min_reg_price === $max_reg_price ) ) {
	   $price = '<span class="price__label">Da </span><span class="price__range">' .  wc_price( $min_price ) . $product->get_price_suffix() .'</span>';
	}
	return $price;
}

add_filter( 'woocommerce_variable_price_html', 'ground_woocommerce_variation_price_format', 9999, 2 );


/**
 * Show sale prices in the cart.
 */
function ground_show_sale_price_at_cart( $old_display, $cart_item, $cart_item_key ) {

	/** @var WC_Product $product */
	$product = $cart_item['data'];

	if ( $product ) {
		return $product->get_price_html();
	}

	return $old_display;
}
add_filter( 'woocommerce_cart_item_price', 'ground_show_sale_price_at_cart', 10, 3 );



/**
 * Show savings at the cart.
 */
function ground_buy_now_save_x_notice() {
	$savings = 0;

	foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
		/** @var WC_Product $product */
		$product = $cart_item['data'];

		if ( $product->is_on_sale() ) {
			$savings += ( $product->get_regular_price() - $product->get_sale_price() ) * $cart_item['quantity'];
		}
	}

	if ( ! empty( $savings ) ) { ?>
		<div class="relative m-6 p-6 bg-green-500 rounded-theme w-72 text-white">
			<h6 class="mb-2"><?php _e( 'Your savings' ); ?></h6>
			<p class="opacity-80"><?php echo sprintf( __( 'Buy now and save' ) ); ?> <?php echo sprintf( __( '%s' ), wc_price( $savings ) ); ?></p>
		</div>
		<?php
	}
}
// add_action( 'wp_footer', 'ground_buy_now_save_x_notice', 10 );




/**
 * Free shipping notice.
 */
function ground_free_shipping_notice() {

	$min_amount = 50; // change this to your free shipping threshold

	$current = WC()->cart->subtotal;

	if ( WC()->cart->get_cart_contents_count() > 0 ) {

		if ( $current < $min_amount ) {
			?>
			<div class="relative m-6 p-6 bg-green-500 rounded-theme w-72 text-white">
				<h6 class="mb-2">Free Shipping</h6>
				<p class="opacity-80">Get free shipping if you order  <?php echo wc_price( $min_amount - $current ); ?> more!</p>
				<!-- <a class="button" href="<?php echo wc_get_page_permalink( 'shop' ); ?>">shop</a> -->
			</div>
			<?php
		} else {
			?>
			<div class="relative m-6 p-6 bg-green-500 rounded-theme w-72 text-white">
				<h6 class="mb-2">Congratulazioni!</h6>
				<p class="opacity-80">Hai diritto alle spese di spedizione gratuite!</p>
			</div>
			<?php
		}
	}

}

// add_action( 'wp_footer', 'ground_free_shipping_notice', 5 );
