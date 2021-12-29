<?php if ( GROUND_NEWSLETTER_SHORTCODE ) : ?>
<div class="container">
	<div class="bg-typo-primary border-b border-line-primary py-12 my-12 rounded-theme lg:py-24 lg:my-24">
		<div class="mx-auto max-w-5xl text-center px-6">
				<?php if ( GROUND_NEWSLETTER_TITLE ) : ?>
					<div class="text-2xl lg:text-4xl mb-4 text-body-primary">
						<?php echo esc_html( GROUND_NEWSLETTER_TITLE ); ?>
					</div>
				<?php endif; ?>

				<?php if ( GROUND_NEWSLETTER_CONTENT ) : ?>
					<div class="text-xl lg:text-2xl mb-4 text-body-secondary lg:mb-8">
						<?php echo esc_html( GROUND_NEWSLETTER_CONTENT ); ?>
					</div>
				<?php endif; ?>

				<div class="button button--bordered js-toggle text-body-primary" data-toggle-target=".overlay-modal html" data-toggle-class-name="is-overlay-modal-open">  <?php _e( 'Subscribe', 'ground' ); ?></div>
		</div>
	</div>
</div>
<?php endif; ?>
