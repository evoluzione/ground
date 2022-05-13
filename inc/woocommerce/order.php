<?php
/**
 * Order fields
 *
 * @package Ground
 */

/**
 * Add customer email and phone in "Order" column to admin orders list
 */

function ground_woocommerce_orders_list_column_content( $column, $post_id ) {
	if ( $column == 'order_number' ) {
		global $the_order;

		if ( $phone = $the_order->get_billing_phone() ) {
			$phone_wp_dashicon = '<span class="dashicons dashicons-phone"></span> ';
			echo '<br>Phone: ' . '<a href="tel:' . $phone . '">' . $phone . '</a></strong>';
		}

		if ( $email = $the_order->get_billing_email() ) {
			echo '<br>Email: ' . '<a href="mailto:' . $email . '">' . $email . '</a>';
		}
	}
}

add_action( 'manage_shop_order_posts_custom_column', 'ground_woocommerce_orders_list_column_content', 50, 2 );
