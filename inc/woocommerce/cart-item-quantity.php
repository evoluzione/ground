<?php

/**
 * Automatically Update Cart on Quantity Change
 */
function ground_cart_refresh_update_qty()
{
	if (!is_cart() && !is_product()) {
		return;
	}
?>

	<script type="text/javascript">
		function clickBtnUpdateCart() {
			const btnUpdate = jQuery('.woocommerce .actions button.button[name="update_cart"]');

			// check if exist
			if (!btnUpdate) return;

			// enable button and click it
			btnUpdate.prop('disabled', false).trigger("click");
		}

		function onClickBtnPlusMinus(e) {

			var qty = jQuery(this).parent('.quantity').find('.qty');
			var val = parseFloat(qty.val()) || 0;
			var max = parseFloat(qty.attr('max'));
			var min = parseFloat(qty.attr('min'));
			var step = parseFloat(qty.attr('step'));

			if (jQuery(this).is('.plus')) {
				if (max && (max <= val)) {
					qty.val(max);
				} else {
					qty.val(val + step);
				}
			} else {
				if (min && (min >= val)) {
					qty.val(min);
				} else if (val > 0) {
					qty.val(val - step);
				}
			}

			clickBtnUpdateCart();
		}

		// onClick button plus and minus
		jQuery(document).on('click', 'button.plus, button.minus', onClickBtnPlusMinus);

		// onChange maual input value
		jQuery(document).on('change', '.input-text.qty.text', clickBtnUpdateCart);
	</script>

<?php
}

add_action('wp_footer', 'ground_cart_refresh_update_qty', 35);
