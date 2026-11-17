<?php
/**
 * Mini-cart drawer contents, wrapper included: also rendered on its own as
 * the div.mini-cart-panel-content AJAX fragment
 * (ground_woocommerce_cart_fragments()), so it must stay self-contained.
 *
 * While the cart is empty this skips WooCommerce's mini-cart template and the
 * hook chain around it, printing the empty message directly — reusing WC's own
 * translated string and markup class. WooCommerce's markup inside is styled in
 * src/css/woocommerce/minicart.css.
 */

$cart = WC()->cart;
?>
<div class="mini-cart-panel-content flex min-h-0 flex-1 flex-col">
	<?php if ( $cart && ! $cart->is_empty() ) : ?>
		<?php woocommerce_mini_cart(); ?>
	<?php else : ?>
		<p class="woocommerce-mini-cart__empty-message flex flex-1 items-center justify-center p-10 text-center text-sm text-gray-500">
			<?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>
	<?php endif; ?>
</div>
