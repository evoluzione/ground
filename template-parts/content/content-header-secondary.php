<header class="lg:[.scroll-direction-down_&]:-top-16 sticky top-0 z-40 border-b duration-500 mb-6">
	<div class="flex justify-between container max-w-6xl py-4">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
			<?php ground_icon( [ 
				'name' => 'logo',
				'attr' => [ 
					'class' => 'w-36 hover:fill-primary',
				],
				'path' => GROUND_TEMPLATE_PATH . '/assets/img/'
			] ); ?>
		</a>
	</div>
</header>