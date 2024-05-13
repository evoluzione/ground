<article class="border-b py-6 flex gap-4">

	<?php ground_image( 'thumbnail', [ 
		'attr' => [ 
			'class' => 'border rounded-full w-20 h-20',
		],
	] ); ?>

	<div>

		<header>
			<h2 class="text-2xl">
				<a class="no-underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
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