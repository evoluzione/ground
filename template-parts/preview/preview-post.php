<article class="border-b py-6 flex gap-4">
	<?php ground_image( '1-1-large', [ 
		'attr' => [ 
			'class' => 'aspect-[1/1] object-cover w-1/4',
			'alt' => get_the_title(),
		]
	] ); ?>

	<div>
		<header>
			<h2 class="text-2xl">
				<a class="no-underline hover:text-primary" href="<?php the_permalink(); ?>"
					title="<?php the_title_attribute(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<time class="italic" datetime="<?php echo get_the_date( 'c' ); ?>">
				<?php echo get_the_date(); ?>
			</time>
		</header>

		<p><?php ground_excerpt( 100 ); ?></p>
	</div>

</article> <!-- End article -->