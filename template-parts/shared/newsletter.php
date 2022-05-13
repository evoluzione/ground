<?php if (GROUND_NEWSLETTER_SHORTCODE) : ?>
	
	<div class="<?php echo get_container_class() ?>">
		<div class="bg-tertiary border-b border-septenary py-12 my-12 rounded-theme lg:py-24 lg:my-24">
			<div class="mx-auto max-w-5xl text-center px-6">
				<?php if (GROUND_NEWSLETTER_TITLE) : ?>
					<div class="text-2xl lg:text-4xl mb-4 text-quinary">
						<?php echo esc_html(GROUND_NEWSLETTER_TITLE); ?>
					</div>
				<?php endif; ?>

				<?php if (GROUND_NEWSLETTER_CONTENT) : ?>
					<div class="text-xl lg:text-2xl mb-4 text-senary lg:mb-8">
						<?php echo esc_html(GROUND_NEWSLETTER_CONTENT); ?>
					</div>
				<?php endif; ?>

				<div class="button button--bordered js-toggle text-quinary" data-toggle-target=".overlay-modal html" data-toggle-class-name="is-overlay-modal-open"> <?php _e('Subscribe', 'ground'); ?></div>
			</div>
		</div>
	</div>



	<div class="overlay-modal">
		<div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
			<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

				<div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity js-toggle" data-toggle-target=".overlay-modal html" data-toggle-class-name="is-overlay-modal-open" aria-hidden="true"></div>
				<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

				<div class="inline-block align-middle bg-quinary rounded-theme text-left p-12 overflow-hidden shadow-xl transform transition-all my-12 sm:max-w-lg :p-24 lg:my-24 lg:max-w-2xl">
					<div>
						<?php if (GROUND_NEWSLETTER_TITLE) : ?>
							<div class="text-2xl lg:text-3xl mb-4 text-center">
								<?php echo esc_html(GROUND_NEWSLETTER_TITLE); ?>
							</div>
						<?php endif; ?>

						<?php if (GROUND_NEWSLETTER_CONTENT) : ?>
							<div class="text-xl lg:text-xl mb-12 text-center">
								<?php echo esc_html(GROUND_NEWSLETTER_CONTENT); ?>
							</div>
						<?php endif; ?>

						<?php echo do_shortcode(GROUND_NEWSLETTER_SHORTCODE); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>