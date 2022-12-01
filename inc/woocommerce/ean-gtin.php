<?php

/**
 * Ean Gtin
 *
 * @package Ground
 */

/**
 * How to Add Custom Fields and Tabs into WooCommerce Product Data Metabox by Code (https://awhitepixel.com/blog/woocommerce-product-data-custom-fields-tabs/)
 */
add_action(
	'woocommerce_product_options_inventory_product_data',
	function() {
		woocommerce_wp_text_input(
			array(
				'id'    => '_ean_gtin',
				'label' => __( 'EAN/GTIN', 'ground' ),
			)
		);
	}
);

add_action(
	'woocommerce_process_product_meta',
	function( $post_id ) {
		$product  = wc_get_product( $post_id );
		$ean_gtin = isset( $_POST['_ean_gtin'] ) ? $_POST['_ean_gtin'] : '';
		$product->update_meta_data( '_ean_gtin', sanitize_text_field( $ean_gtin ) );
		$product->save();
	}
);
