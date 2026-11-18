<header class="lg:in-[.is-scroll-down]:-top-16 sticky top-0 z-40 border-b duration-500 mb-6">
	<div class="flex justify-between container max-w-6xl py-4">
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
	</div>
</header>
