<article class="mb-6">
	<a class="group no-underline" href="<?php the_permalink(); ?>">
		<?php ground_image( [ 
			'size' => '1-1-large',
			'attr' => [ 
				'class' => 'aspect-[1/1] object-cover w-full',
				'alt' => get_the_title(),
			]
		] ); ?>
		<header>
			<h2 class="text-2xl group-hover:text-primary"><?php the_title(); ?></h2>
		</header>
		<p><?php ground_excerpt( 100 ); ?></p>
	</a>
</article>