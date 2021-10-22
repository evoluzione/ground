<?php

/**
 * Automatically Update Cart on Quantity Change
 */
function ground_cart_refresh_update_qty() {

	if ( ! is_cart() && ! is_product() ) return;
?>

		<script type="text/javascript">

			// onClick button plus and minus
			jQuery(document).on('click','button.plus, button.minus', function(e){
				
				var qty = jQuery( this ).parent( '.quantity' ).find( '.qty' );
				var val = parseFloat(qty.val());
				var max = parseFloat(qty.attr( 'max' ));
				var min = parseFloat(qty.attr( 'min' ));
				var step = parseFloat(qty.attr( 'step' ));
				
				jQuery('.woocommerce .actions button.button').prop('disabled', false);

				if ( jQuery( this ).is( '.plus' ) ) {
					if ( max && ( max <= val ) ) {
					qty.val( max );
					} else {
					qty.val( val + step );
					}
				} else {
					if ( min && ( min >= val ) ) {
					qty.val( min );
					} else if ( val > 1 ) {
					qty.val( val - step );
					}
				}

				jQuery("[name='update_cart']").trigger("click");
			});

			// onChange maual input value
			var qty = jQuery( this ).parent( '.quantity' ).find( '.qty' );
			jQuery(document).on('change', qty, function(){
				jQuery("[name='update_cart']").trigger("click");
			});
      	</script>

<?php
}

add_action( 'wp_footer', 'ground_cart_refresh_update_qty' );

?>