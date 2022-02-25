<div class="container my-12 lg:my-24">
	<div class="text-center mb-24 grid grid-cols-12 gap-6 lg:text-left">
		<div class="col-span-full lg:col-span-5">
			<?php if ( GROUND_PAYMENTS_TITLE ) : ?>
				<div class="text-xl mb-4">
					<?php echo esc_html( GROUND_PAYMENTS_TITLE ); ?>
				</div>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/shared/payments-method' ); ?>

			<?php if ( GROUND_PAYMENTS_CONTENT ) : ?>
				<div class="text-quaternary">
					<?php echo esc_html( GROUND_PAYMENTS_CONTENT ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="col-span-full lg:col-span-5 lg:col-start-7">
			<?php if ( GROUND_SHIPPING_TITLE ) : ?>
				<?php ground_icon( 'faster', 'w-12 mb-3 text-tertiary', 'custom' ); ?>
			<?php endif; ?>

			<div class="col-span-full lg:col-span-4 lg:text-left">
				<div class="text-xl mb-3">
					<?php echo esc_html( GROUND_SHIPPING_TITLE ); ?>
				</div>
				<div class="text-quaternary">
					<?php echo esc_html( GROUND_SHIPPING_CONTENT ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
