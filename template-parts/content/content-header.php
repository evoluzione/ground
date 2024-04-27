<header class="header lg:[.scroll-direction-down_&]:-top-16 sticky top-0 z-40 border-b duration-500">
	<div class="flex justify-between container ">
		<a class="logo mt-4" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
			<?php //TODO: FIX ?>
			<?php /* <img class="logo__img" src="<?php echo GROUND_TEMPLATE_PATH ?>/assets/img/logo.svg" alt="<?php bloginfo('name'); ?>" /> */ ?>
			<?php echo file_get_contents( GROUND_TEMPLATE_PATH . '/assets/img/logo.svg' ); ?>
		</a> <!-- End .logo -->

		<?php get_template_part( 'template-parts/navigation/navigation-header-primary' ); ?>
	</div>
</header> <!-- End .header -->