<?php

// https://sridharkatakam.com/non-purchasable-products-call-order-buttons-woocommerce/

/**
 * Add `Not Purchasable` field in the Product data's General tab.
 */
function ground_general_product_data_custom_fields() {
	// Checkbox.
	woocommerce_wp_checkbox(
		array(
			'id'            => '_not_purchasable',
			'wrapper_class' => 'show_if_simple',
			'label'         => __( 'Not Purchasable', 'woocommerce' ),
			'description'   => __( 'This product is not purchasable ( Compatible only with simple product ) <a target="_blank" href="' . esc_url( home_url( '/wp-admin/customize.php?return=%2Fwp-admin%2Fedit.php%3Fpost_type%3Dproduct' ) ) . '">Set up global messages for Not Purchasable products</a>', 'ground' ),
		)
	);
}

add_action( 'woocommerce_product_options_general_product_data', 'ground_general_product_data_custom_fields' );


/**
 * Save the data values from the custom fields.
 *
 * @param  int $post_id ID of the current product.
 */
function ground_save_general_proddata_custom_fields( $post_id ) {
	// Checkbox.
	$woocommerce_checkbox = isset( $_POST['_not_purchasable'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_not_purchasable', $woocommerce_checkbox );
}

add_action( 'woocommerce_process_product_meta', 'ground_save_general_proddata_custom_fields' );


/**
 * Mark "Not Purchasable" products as not purchasable.
 */
function ground_woocommerce_set_purchasable() {
	 $not_ready_to_sell = get_post_meta( get_the_ID(), '_not_purchasable', true );

	return ( 'yes' === $not_ready_to_sell ? false : true );
}
add_filter( 'woocommerce_is_purchasable', 'ground_woocommerce_set_purchasable' );



/**
 * Change "Read More" button text for non-purchasable products.
 */
function ground_product_add_to_cart_text() {
	$not_ready_to_sell = get_post_meta( get_the_ID(), '_not_purchasable', true );

	if ( 'yes' === $not_ready_to_sell ) {
		return __( GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_BUTTON, 'woocommerce' );
	} else {
		return __( 'Add to cart', 'woocommerce' );
	}
}
add_filter( 'woocommerce_product_add_to_cart_text', 'ground_product_add_to_cart_text' );



/**
 * Add calling instructions for non-purchasable products.
 */
function ground_woocommerce_call_to_order_text() {
	$not_ready_to_sell = get_post_meta( get_the_ID(), '_not_purchasable', true );

	if ( 'yes' === $not_ready_to_sell ) { ?>

		<div class="border-t border-septenary pt-5">
			<h6 class="mb-2">
				<strong class="text-primary">
					<?php echo esc_html( GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_BUTTON ); ?>
				</strong>
			</h6>
			<p class="text-quaternary">
				<?php echo esc_html( GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_TEXT ); ?>
			</p>
			<?php if ( GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA ) : ?>
				<div class="relative mt-6">
					<a class="button button--secondary" href="<?php echo esc_html( get_permalink( GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA ) ); ?>"><?php echo esc_html( get_the_title( GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA ) ); ?></a>
				</div>
			<?php endif; ?>
		</div>

		<?php
	}
}
add_action( 'woocommerce_single_product_summary', 'ground_woocommerce_call_to_order_text', 30 );





/**
 * Add label for product-loop.
 */
function ground_show_not_purchasable_label() {
	$not_ready_to_sell = get_post_meta( get_the_ID(), '_not_purchasable', true );

	if ( 'yes' === $not_ready_to_sell ) {
		?>
		<div class="not-purchasable"><?php echo esc_html( GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_BUTTON ); ?></div>
		<?php
	}
}
add_action( 'ground_sale_flash', 'ground_show_not_purchasable_label', 30 );
