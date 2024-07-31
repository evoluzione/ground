<?php

// https://sridharkatakam.com/non-purchasable-products-call-order-buttons-woocommerce/

/**
 * Add `Not Purchasable` field in the Product data's General tab.
 */
function ground_general_product_data_custom_fields()
{

	// Checkbox.
	woocommerce_wp_checkbox(
		array(
			'id'            => 'not_purchasable',
			'wrapper_class' => 'show_if_simple',
			'label'         => __('Not Purchasable', 'woocommerce'),
			'description'   => __('This product is not purchasable (compatible only with simple product)', 'ground') . '<br><a target="_blank" href="' . esc_url(home_url('/wp-admin/customize.php?return=%2Fwp-admin%2Fedit.php%3Fpost_type%3Dproduct')) . '">' . __('Set up global messages for Not Purchasable products', 'ground') . '</a>',
		)
	);

	woocommerce_wp_text_input(
		array(
			'id'            => 'not_purchasable_custom_message',
			'wrapper_class' => 'show_if_simple',
			'label'         => __('Custom Message for Not Purchasable products', 'woocommerce'),
		)
	);
}

add_action('woocommerce_product_options_general_product_data', 'ground_general_product_data_custom_fields');


/**
 * Save the data values from the custom fields.
 *
 * @param  int $post_id ID of the current product.
 */
function ground_save_general_proddata_custom_fields($post_id)
{
	// Checkbox.
	$woocommerce_not_purchasable = $_POST['not_purchasable'];
	update_post_meta($post_id, 'not_purchasable', $woocommerce_not_purchasable);

	$woocommerce_not_purchasable_custom_message = $_POST['not_purchasable_custom_message'];
	update_post_meta($post_id, 'not_purchasable_custom_message', esc_attr($woocommerce_not_purchasable_custom_message));
}

add_action('woocommerce_process_product_meta', 'ground_save_general_proddata_custom_fields');


/**
 * Mark "Not Purchasable" products as not purchasable.
 */
function ground_woocommerce_set_purchasable()
{
	$not_ready_to_sell = get_post_meta(get_the_ID(), 'not_purchasable', true);

	return ('yes' === $not_ready_to_sell ? false : true);
}
add_filter('woocommerce_is_purchasable', 'ground_woocommerce_set_purchasable');



/**
 * Change "Read More" button text for non-purchasable products.
 */
function ground_product_add_to_cart_text()
{
	$not_ready_to_sell = get_post_meta(get_the_ID(), 'not_purchasable', true);

	if ('yes' === $not_ready_to_sell) {
		$ground_not_purchasable_custom_message = get_post_meta(get_the_ID(), 'not_purchasable_custom_message', true);
		if ($ground_not_purchasable_custom_message) {
			return __($ground_not_purchasable_custom_message, 'woocommerce');
		} else {
			return __(GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_BUTTON, 'woocommerce');
		}
	} else {
		return __('Add to cart', 'woocommerce');
	}
}
add_filter('woocommerce_product_add_to_cart_text', 'ground_product_add_to_cart_text');



/**
 * Add calling instructions for non-purchasable products.
 */
function ground_woocommerce_call_to_order_text()
{
	$not_ready_to_sell = get_post_meta(get_the_ID(), 'not_purchasable', true);

	if ('yes' === $not_ready_to_sell) {
		$ground_not_purchasable_custom_message = get_post_meta(get_the_ID(), 'not_purchasable_custom_message', true);
?>

		<div class="border-t border-septenary pt-5">
			<h6 class="mb-2">
				<strong class="text-primary">
					<?php
					if ($ground_not_purchasable_custom_message) {
						echo esc_html($ground_not_purchasable_custom_message);
					} else {
						echo esc_html(GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_BUTTON);
					}
					?>
				</strong>
			</h6>
			<p class="text-quaternary">
				<?php echo esc_html(GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_TEXT); ?>
			</p>
			<?php if (GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA) : ?>
				<div class="relative mt-6">
					<a class="button button--secondary" href="<?php echo esc_html(get_permalink(GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA)); ?>"><?php echo esc_html(get_the_title(GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA)); ?></a>
				</div>
			<?php endif; ?>
		</div>

	<?php
	}
}
add_action('woocommerce_single_product_summary', 'ground_woocommerce_call_to_order_text', 30);





/**
 * Add label for product-loop.
 */
function ground_show_not_purchasable_label()
{
	$not_ready_to_sell = get_post_meta(get_the_ID(), 'not_purchasable', true);

	if ('yes' === $not_ready_to_sell) {
		$ground_not_purchasable_custom_message = get_post_meta(get_the_ID(), 'not_purchasable_custom_message', true);
	?>
		<div class="product-label product-label--not-purchasable">
			<div class="product-label__body">
				<?php
				if ($ground_not_purchasable_custom_message) {
					echo esc_html($ground_not_purchasable_custom_message);
				} else {
					echo esc_html(GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_BUTTON);
				}
				?>
			</div>

		</div>
<?php
	}
}
add_action('ground_sale_flash', 'ground_show_not_purchasable_label', 30);





/**
 * Add a custom class to "Not Purchasable" products.
 */
function ground_woocommerce_add_class_not_purchasable_product($classes, $class, $product_id)
{
	$not_ready_to_sell = get_post_meta($product_id, 'not_purchasable', true);

	if ('yes' === $not_ready_to_sell) {
		$classes[] = 'not-purchasable-product';
	}

	return $classes;
}
add_filter('post_class', 'ground_woocommerce_add_class_not_purchasable_product', 10, 3);
