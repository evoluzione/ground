<div id="js-search-form" class="search-form mt-16 lg:mt-32">
	<div class="search-form__bg container">
		<div class="<?php echo GROUND_HEADER_TYPE == 'megaMenu' ? 'hidden' : ''; ?>">
			<?php get_template_part( 'template-parts/search/search-form-input' ); ?>
		</div>

		<a id="js-search-close" class="js-toggle search-form__close" href="#" data-toggle-target=".search-form html" data-toggle-class-name="is-search-open">
			<span class="hidden text-tertiary lg:inline-block lg:align-middle mt-2"><?php _e( 'close', 'ground' ); ?></span>
			<?php ground_icon( 'close', 'text-tertiary mt-0 lg:mt-2 lg:inline-block lg:align-middle' ); ?>
		</a>
		<div class="search-form__result grid grid-cols-12 gap-6 relative" id="js-ajax-search-result"></div>
	</div>
</div>
