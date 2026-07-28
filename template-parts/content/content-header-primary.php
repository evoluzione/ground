<header class="lg:in-[.is-scroll-down]:-top-16 sticky top-0 z-40 bg-white duration-500 mb-6">
	<div class="flex justify-between container py-6">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
			<?php ground_icon( [
				'name' => 'logo',
				'attr' => [
					'class' => 'w-36 hover:fill-primary',
				],
				'path' => GROUND_TEMPLATE_DIRECTORY . '/assets/img/'
			] ); ?>
		</a>
		<?php get_template_part( 'template-parts/navigation/navigation-header-primary' ); ?>
		<?php get_template_part( 'template-parts/navigation/navigation-languages' ); ?>
		<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<div class="relative">
				<?php ground_cart_link(); ?>
				<div class="mini-cart-panel">
					<div class="mini-cart-panel-content">
						<?php woocommerce_mini_cart(); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</header>
