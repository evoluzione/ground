<?php if ( class_exists( 'WooCommerce' ) ) : ?>

	<div id="minicart" class="minicart">
		<div class="minicart__panel js-toggle" data-toggle-target="html" data-toggle-class-name="is-minicart-open"></div>
		<?php get_template_part( 'partials/woocommerce/minicart', 'contents' ); ?>
		<div class="minicart__body">
			<div class="minicart__close js-toggle" data-toggle-target="html" data-toggle-class-name="is-minicart-open">
				<?php ground_icon( 'close' ); ?>
			</div>
			<?php the_widget( 'WC_Widget_Cart', 'title=Prodotti nel carrello&hide_if_empty=1' ); ?>
		</div>
	</div>

<?php endif; ?>
