<?php if ( class_exists( 'WooCommerce' ) ) : ?>

	<div class="minicart overlay-panel" id="minicart">
		<div class="overlay-panel__mask js-toggle" data-toggle-target="#minicart html" data-toggle-class-name="is-overlay-panel-open"></div>
		<?php get_template_part( 'partials/woocommerce/minicart', 'contents' ); ?>
		<div class="overlay-panel__body">
			<div class="overlay-panel__close js-toggle" data-toggle-target="#minicart html" data-toggle-class-name="is-overlay-panel-open">
				<?php ground_icon( 'close' ); ?>
			</div>
			<div class="overlay-panel__content">
				<?php the_widget( 'WC_Widget_Cart', 'title=Prodotti nel carrello&hide_if_empty=1' ); ?>
			</div>
		</div>
	</div>

<?php endif; ?>
