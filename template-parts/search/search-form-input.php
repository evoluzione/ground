<form id="js-ajax-search" class="form search__form relative <?php echo GROUND_HEADER_TYPE == 'megaMenu' ? 'container' : ''; ?> <?php echo ( GROUND_HEADER_ADVICE_PRIMARY || GROUND_COMPANY_PHONE || GROUND_COMPANY_WHATSAPP ) ? '' : 'mt-2 lg:mt-0'; ?>" method="get" action="<?php echo home_url( '/' ); ?>">
	<div class="flex items-center">
		<input class="shrink" type="text" id="js-ajax-search-input" placeholder="<?php _e( 'Search products', 'ground' ); ?>" value="<?php the_search_query(); ?>" name="s" id="s" />
		<button class="search__button" type="submit"><?php ground_icon( 'search', 'form__icon' ); ?></button>

		<div class="js-ajax-search-spinner search__spinner w-24"><?php ground_icon( 'spinner', 'animate-spin text-primary h-8 lg:h-12' ); ?></div>
	</div>
</form>
