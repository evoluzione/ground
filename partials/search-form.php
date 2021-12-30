<div id="js-search-form" class="search mt-16 lg:mt-32">
	<div class="search__bg container">
		<div class="<?php echo GROUND_HEADER_TYPE == 'megaMenu' ? 'hidden' : ''; ?>">
			<?php get_template_part( 'partials/search', 'form-input' ); ?>
		</div>

		<a id="js-search-close" class="js-toggle search__close" href="#" data-toggle-target=".search html" data-toggle-class-name="is-search-open">
			<span class="hidden text-typo-primary lg:inline-block lg:align-middle mt-2"><?php _e( 'close', 'ground' ); ?></span>
			<?php ground_icon( 'close', 'text-typo-primary mt-2 lg:inline-block lg:align-middle' ); ?>
		</a>
		<div class="search__result grid grid-cols-12 gap-6 relative" id="js-ajax-search-result"></div>
	</div>
</div>
