<article class="mb-6">
	<a class="group grid grid-cols-3 lg:grid-cols-12 gap-4 no-underline" href="<?php the_permalink(); ?>">
		<div class="lg:col-span-2">
			<?php ground_image( [
				'size' => '1-1-small',
				'attr' => [
					// A third of the row below lg; lg:col-span-2 of the lg:col-span-10 list in index.php.
					'sizes' => '(min-width: 1536px) 190px, (min-width: 1280px) 155px, (min-width: 1024px) 119px, (min-width: 768px) 224px, (min-width: 640px) 181px, calc(33.33vw - 32px)',
					'class' => 'aspect-1/1 object-cover w-full',
					'alt' => get_the_title(),
				]
			] ); ?>
		</div>

		<div class="col-span-2 lg:col-span-10">
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
