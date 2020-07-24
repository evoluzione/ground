<?php if ( class_exists( 'WooCommerce' ) ) :
	$count = WC()->cart->cart_contents_count; ?>
	<div class="minicart js-cursor-hover">
		<div class="minicart__panel js-toggle" data-toggle-target="html" data-toggle-class-name="is-minicart-open"></div>
		<div class="minicart__preview js-toggle" data-toggle-target="html" data-toggle-class-name="is-minicart-open">
			<?php // When link markup is updated also update ground_woocommerce_add_to_cart_fragment() in woocommerce.php ?>
			<a class="minicart__link" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart', 'ground' ); ?>">
				<?php ground_icon( 'cart', 'minicart__icon' ); ?>
				<?php if ( $count > 0 ) { ?>
					<span class="minicart__count small"><?php echo esc_html( $count ); ?></span>
					<?php
				}
				// Total price: echo wp_kses_post( WC()->cart->get_cart_subtotal() );
				// Total count: echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'ground' ), WC()->cart->get_cart_contents_count() ) );
				?>
			</a>
		</div>
		<div class="minicart__content">
			<div class="minicart__close js-toggle" data-toggle-target="html" data-toggle-class-name="is-minicart-open"><?php _e('Close', 'ground'); ?> <i class="icon-close"></i></div>
			<div class="widget_shopping_cart_content"><?php woocommerce_mini_cart();?></div>
		</div>
	</div>
<?php endif; ?>
