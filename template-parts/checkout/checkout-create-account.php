<?php
/**
 * Account creation after the order, on the order confirmation page: an offer to
 * a guest, once the order is placed, to turn their details into an account.
 *
 * WooCommerce's own Create account block (woocommerce/order-confirmation-create-
 * account), which belongs to the block-based order confirmation template and is
 * rendered here inside the classic one (checkout/thankyou.php) by
 * ground_woocommerce_create_account(), which also skips failed orders. The
 * block does the rest: it shows up only to a guest whose email has no account
 * yet, with "Allow customers to create an account after checkout"
 * (woocommerce_enable_delayed_account_creation) on, and its form (React) creates the account, links the order and logs the
 * customer in. Its layout and button come from WooCommerce's block stylesheet
 * (order-confirmation-create-account.css), enqueued with the block like the
 * checkout block's: the theme only styles the content below.
 *
 * The markup below is the block's content: a heading and the reasons to sign up,
 * shown above the form.
 */
ob_start();
?>
<div class="wp-block-woocommerce-order-confirmation-create-account">
	<h2 class="text-xl font-semibold mb-3">
		<?php
		/* translators: %s: site title. */
		echo esc_html( sprintf( __( 'Create an account with %s', 'ground' ), wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) ) );
		?>
	</h2>
	<ul class="list-none space-y-1 mb-4">
		<?php foreach ( [
			__( 'Faster future purchases', 'ground' ),
			__( 'Track your orders and see your order history', 'ground' ),
			__( 'Your addresses saved for next time', 'ground' ),
		] as $benefit ) : ?>
			<li class="flex items-center gap-2">
				<?php ground_icon( [
					'name' => 'check',
					'attr' => [
						'class' => 'w-4 h-4 text-primary shrink-0',
					],
				] ); ?>
				<?php echo esc_html( $benefit ); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php
$content = ob_get_clean();

echo do_blocks( '<!-- wp:woocommerce/order-confirmation-create-account -->' . $content . '<!-- /wp:woocommerce/order-confirmation-create-account -->' );
