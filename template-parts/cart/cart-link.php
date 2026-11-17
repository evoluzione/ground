<?php
/**
 * Header cart trigger: icon + item count badge. A link to the cart page that
 * src/js/components/miniCart.js turns into the opener of the mini-cart drawer.
 * The badge is visual only: the count is part of the accessible name instead.
 *
 * Also rendered on its own as the a.cart-contents AJAX fragment
 * (ground_woocommerce_cart_fragments()), so it must stay self-contained.
 */

$cart = WC()->cart;
$count = $cart ? $cart->get_cart_contents_count() : 0;
/* translators: %d: number of items in the cart. */
$label = sprintf( _n( 'Cart, %d item', 'Cart, %d items', $count, 'ground' ), $count );
?>
<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="cart-contents relative inline-flex items-center"
	aria-label="<?php echo esc_attr( $label ); ?>">
	<?php ground_icon( [
		'name' => 'shopping-cart',
		'attr' => [
			'class' => 'w-5 h-5',
		],
	] ); ?>
	<?php if ( $count > 0 ) : ?>
		<span
			class="absolute -top-2 -right-2 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] text-white"><?php echo esc_html( $count ); ?></span>
	<?php endif; ?>
</a>
