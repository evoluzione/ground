<?php get_template_part( 'template-parts/announcement/announcement-bar' ); ?>
<header class="lg:in-[.is-scroll-down]:-top-16 sticky top-0 z-40 bg-white duration-500 mb-6">
	<?php if ( has_nav_menu( 'navigation-header-secondary' ) ) : ?>
		<div class="flex justify-end container py-2">
			<?php get_template_part( 'template-parts/navigation/navigation-header-secondary' ); ?>
		</div>
	<?php endif; ?>
	<div class="flex justify-between container py-6">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php ground_icon( [
				'name' => 'logo',
				'attr' => [
					'class' => 'w-36 hover:fill-primary',
					// The link's only content: the logo gives it its name.
					'aria-label' => get_bloginfo( 'name' ),
				],
				'path' => GROUND_TEMPLATE_DIRECTORY . '/assets/img/'
			] ); ?>
		</a>
		<?php get_template_part( 'template-parts/navigation/navigation-header-primary' ); ?>
		<div class="flex items-center gap-6">
			<?php get_template_part( 'template-parts/navigation/navigation-languages' ); ?>
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<?php get_template_part( 'template-parts/navigation/navigation-account' ); ?>
				<?php get_template_part( 'template-parts/cart/cart-link' ); ?>
				<?php get_template_part( 'template-parts/cart/cart-drawer' ); ?>
			<?php endif; ?>
		</div>
	</div>
</header>