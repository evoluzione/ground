<header class="lg:[.scroll-direction-down_&]:-top-16 sticky top-0 z-40 bg-white duration-500 mb-6">
	<div class="flex justify-between container py-6">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
			<?php ground_icon( [ 
				'name' => 'logo',
				'attr' => [ 
					'class' => 'w-36 hover:fill-primary',
				],
				'path' => GROUND_TEMPLATE_PATH . '/assets/img/'
			] ); ?>
		</a>
		<?php get_template_part( 'template-parts/navigation/navigation-header-primary' ); ?>
	</div>
</header>