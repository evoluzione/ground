<div id="panel-primary" class="overlay-panel">

	<div class="js-close-overlay-panel overlay-panel__mask js-toggle" data-toggle-target="#panel-primary html" data-toggle-class-name="is-overlay-panel-open"></div>

	<div class="overlay-panel__body">
		<div class="js-close-panel overlay-panel__close js-toggle" data-toggle-target="#panel-primary html" data-toggle-class-name="is-overlay-panel-open">
			<?php ground_icon( 'close' ); ?>
		</div>

		<div class="inline-block mt-8 mb-12 ml-8">
			<?php get_template_part( 'template-parts/shared/logo-primary' ); ?>
		</div>

		<div class="overlay-panel__content lg:pb-52">
			<button type="button" class="js-back block mb-6 header__back cursor-pointer ml-8"> 
				<span> <?php ground_icon( 'chevron-left', 'text-tertiary h-6 w-6' ); ?> </span> <?php _e( 'Back', 'ground' ); ?>
			</button>
			<?php get_template_part( 'template-parts/navigation/navigation-panel-primary' ); ?>
		</div>

	</div>
</div>
