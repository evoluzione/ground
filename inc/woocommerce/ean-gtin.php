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
	function () {
		woocommerce_wp_text_input(
			array(
				'id'    => 'gtin',
				'label' => __('GTIN', 'ground'),
			)
		);
	}
);

add_action(
	'woocommerce_process_product_meta',
	function ($post_id) {
		$product  = wc_get_product($post_id);
		$ean_gtin = isset($_POST['gtin']) ? $_POST['gtin'] : '';
		$product->update_meta_data('gtin', sanitize_text_field($ean_gtin));
		$product->save();
	}
);



/**
 * @snippet       Add Custom Field EAN-GTIN to Product Variations - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 4.6
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

// -----------------------------------------
// 1. Add custom field input @ Product Data > Variations > Single Variation

function ground_woocommerce_add_custom_field_to_variations($loop, $variation_data, $variation)
{
	woocommerce_wp_text_input(array(
		'id' => 'gtin[' . $loop . ']',
		'placeholder' => 'Insert variant GTIN',
		'label' => __('GTIN', 'ground'),
		'value' => get_post_meta($variation->ID, 'gtin', true),
        'wrapper_class' => 'form-row',
	));
}

add_action('woocommerce_variation_options_pricing', 'ground_woocommerce_add_custom_field_to_variations', 10, 3);


// -----------------------------------------
// 2. Save custom field on product variation save

function ground_woocommerce_save_custom_field_variations($variation_id, $i)
{
	$custom_field = $_POST['gtin'][$i];
	if (isset($custom_field)) update_post_meta($variation_id, 'gtin', esc_attr($custom_field));
}

add_action('woocommerce_save_product_variation', 'ground_woocommerce_save_custom_field_variations', 10, 2);


// -----------------------------------------
// 3. Store custom field value into variation data

function ground_woocommerce_add_custom_field_variation_data($variations)
{
	$variations['gtin'] = '<div class="woocommerce_custom_field">GTIN: <span>' . get_post_meta($variations['variation_id'], 'gtin', true) . '</span></div>';
	return $variations;
}

add_filter('woocommerce_available_variation', 'ground_woocommerce_add_custom_field_variation_data');