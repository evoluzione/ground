<?php
/**
 * Order email
 *
 * @package Ground
 */

/**
 * Add a custom field (in an order) to the emails
 */
function ground_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {

	$phone = get_post_meta( $order->get_order_number(), '_billing_phone', true );
	$email = get_post_meta( $order->get_order_number(), '_billing_email', true );

	if ( $phone || $email ) { ?>
		<h2><?php _e( 'Customer details', 'ground' ); ?></h2>
		<address class="address">
			<?php if ( $email ) : ?>
			<strong><?php _e( 'Email', 'ground' ); ?>:</strong> <span><?php echo $email; ?></span><br>
				<?php if ( $phone ) : ?>
			<?php endif; ?>
			<strong><?php _e( 'Phone', 'ground' ); ?>:</strong> <span><?php echo $phone; ?></span><br>
			<?php endif; ?>
		</address>
		<br><br>
		<?php
	}

}

add_filter( 'woocommerce_email_order_meta_fields', 'ground_woocommerce_email_order_meta_fields', 10, 3 );
