<?php
/**
 * Payments
 *
 * @package Ground
 */


/**
 * Remove the payment options form from default location
 */
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

/**
 * Add the payment options form under the "order notes" section
 */
add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );


/**
 * Add a custom fee based on cash on delivery
 */
function ground_woocommerce_cash_on_delivery_fee( $cart ) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
		return;
	}

	if ( 'cod' === WC()->session->get( 'chosen_payment_method' ) ) {
		$fee = 5;
		$cart->add_fee( __( 'Cash on delivery charges', 'ground' ), $fee, false );
	}
}

// add_action( 'woocommerce_cart_calculate_fees', 'ground_woocommerce_cash_on_delivery_fee', 10, 1 );

/**
 * Update checkout on method payment change
 */
function ground_woocommerce_cash_on_delivery_fee_js_update() {
	if ( is_checkout() && ! is_wc_endpoint_url() ) { ?>
		<script type="text/javascript">
			jQuery( function($){
				$('form.checkout').on('change', 'input[name="payment_method"]', function() {
					$(document.body).trigger('update_checkout');
				});
			});
		</script>
		<?php
	}
}

// add_action( 'wp_footer', 'ground_woocommerce_cash_on_delivery_fee_js_update' );
