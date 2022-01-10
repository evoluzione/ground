<div id="panel-primary" class="overlay-panel">

	<div class="js-close-overlay-panel overlay-panel__mask js-toggle" data-toggle-target="#panel-primary html" data-toggle-class-name="is-overlay-panel-open"></div>

	<div class="overlay-panel__body">
		<div class="js-close-panel overlay-panel__close js-toggle" data-toggle-target="#panel-primary html" data-toggle-class-name="is-overlay-panel-open">
			<?php ground_icon('close'); ?>
		</div>

		<div class="inline-block mt-8 mb-12 ml-8">
			<?php get_template_part('partials/logo', 'primary'); ?>
		</div>

		<div class="overlay-panel__content">
			<a class="js-back block ml-6 mb-6 header__back cursor-pointer"> <span> <?php ground_icon('chevron-left', 'text-black'); ?> </span> <?php _e('Indietro', 'ground'); ?> </a>
			<?php get_template_part('partials/navigation', 'panel-primary'); ?>
		</div>

	</div>
</div>