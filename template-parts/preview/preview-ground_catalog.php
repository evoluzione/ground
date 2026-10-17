<article class="mb-6">
	<a class="group no-underline" href="<?php the_permalink(); ?>">
		<?php ground_image( [
			'size' => '1-1-small',
			'attr' => [
				// loop-ground_catalog grid (2/3/4 columns) in the lg:col-span-10 column of the catalog templates.
				'sizes' => '(min-width: 1536px) 288px, (min-width: 1280px) 234px, (min-width: 1024px) 181px, (min-width: 768px) 219px, (min-width: 640px) 276px, calc(50vw - 44px)',
				'class' => 'aspect-1/1 object-cover w-full',
				'alt' => get_the_title(),
			]
		] ); ?>
		<header>
			<h2 class="text-2xl group-hover:text-primary"><?php the_title(); ?></h2>
		</header>
		<p><?php ground_excerpt( 100 ); ?></p>
	</a>
</article>
