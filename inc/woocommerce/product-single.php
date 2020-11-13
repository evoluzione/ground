<?php
/**
 * Product single
 *
 * @package Ground
 */

/**
 * Add brand in product single
 */
function ground_woocommerce_add_brand_single_product() {
	global $post;
	echo '<h2 class="woocommerce-product-details__brand">' . get_the_term_list($post->ID, 'pa_brand', '', ', ') . '</h2>';
}

// add_action('woocommerce_single_product_summary', 'ground_woocommerce_add_brand_single_product', 6);

/**
 * Remove single product tabs
 */
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );