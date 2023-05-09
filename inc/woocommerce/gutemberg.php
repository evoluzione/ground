<?php

/**
 * Gutemberg
 *
 * @package Ground
 */

/**
 * Activate gutenberg product
 * https://dev.to/kalimahapps/enable-gutenberg-editor-in-woocommerce-466m
 */
function ground_activate_gutenberg_product($can_edit, $post_type)
{

	if ($post_type == 'product') {
		if (GROUND_SHOP_ENABLE_GUTEMBERG_EDITOR == 1) {
			$can_edit = true;
		}
	}
	return $can_edit;
}
add_filter('use_block_editor_for_post_type', 'ground_activate_gutenberg_product', 10, 2);
