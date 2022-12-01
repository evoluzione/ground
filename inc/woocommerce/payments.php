<?php

/**
 * Payments
 *
 * @package Ground
 */


/**
 * Remove the payment options form from default location
 */
// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

/**
 * Add the payment options form under the "order notes" section
 */
// add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20 );


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
			jQuery(function($) {
				$('form.checkout').on('change', 'input[name="payment_method"]', function() {
					$(document.body).trigger('update_checkout');
				});
			});
		</script>
		  <?php
	}
}

// add_action( 'wp_footer', 'ground_woocommerce_cash_on_delivery_fee_js_update' );


/**
 * Displaying the Payment Gateways: https://www.ibenic.com/move-payments-woocommerce-checkout/
 */
function ground_woocommerce_custom_display_payments() {
	if ( WC()->cart->needs_payment() ) {
		$available_gateways = WC()->payment_gateways()->get_available_payment_gateways();
		WC()->payment_gateways()->set_current_gateway( $available_gateways );
	} else {
		$available_gateways = array();
	}
	?>


	<div id="checkout_payments">
		<?php if ( WC()->cart->needs_payment() ) : ?>
			<ul class="wc_payment_methods payment_methods methods">
				<?php
				if ( ! empty( $available_gateways ) ) {
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				} else {
					echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) . '</li>'; // @codingStandardsIgnoreLine
				}
				?>
			</ul>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Moving the payments
 */
add_action( 'woocommerce_checkout_shipping', 'ground_woocommerce_custom_display_payments', 20 );



/**
 * Adding our payment gateways to the fragment #checkout_payments so that this HTML is replaced with the updated one.
 */
function ground_woocommerce_custom_payment_fragment( $fragments ) {
	ob_start();

	ground_woocommerce_custom_display_payments();

	$html = ob_get_clean();

	$fragments['#checkout_payments'] = $html;

	return $fragments;
}

/**
 * Adding the payment fragment to the WC order review AJAX response
 */
add_filter( 'woocommerce_update_order_review_fragments', 'ground_woocommerce_custom_payment_fragment' );
