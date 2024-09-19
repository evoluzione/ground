<article class="mb-6">
	<a class="group grid grid-cols-12 gap-4 no-underline" href="<?php the_permalink(); ?>">
		<div class="col-span-2">
			<?php ground_image( [ 
				'size' => '1-1-large',
				'attr' => [ 
					'class' => 'aspect-[1/1] object-cover w-full',
					'alt' => get_the_title(),
				]
			] ); ?>
		</div>

		<div class="col-span-10">
			<header>
				<h2 class="text-2xl group-hover:text-primary"><?php the_title(); ?></h2>
				<time class="italic" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
			</header>
			<p><?php ground_excerpt( 100 ); ?></p>
		</div>
	</a>
</article>