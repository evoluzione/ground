<?php //TODO: AGGIORNARE HTML ?>
<div class="col-span-12 md:col-span-6 lg:col-span-4">
	<article class="item js-infinite-post">

		<figure class="item__media">
			<a class="no-underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php ground_image( [
					'size' => '4-3-medium',
					'attr' => [
						// col-span-12 / md:col-span-6 / lg:col-span-4 of a 12-column grid in the container.
						'sizes' => '(min-width: 1536px) 475px, (min-width: 1280px) 389px, (min-width: 1024px) 304px, (min-width: 768px) 340px, (min-width: 640px) 576px, calc(100vw - 64px)',
						'class' => 'item__image aspect-4/3 object-cover w-full',
					],
				] ); ?>
			</a>
		</figure>

		<div class="item__content">

			<header class="item__header">
				<a class="no-underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<h2 class="item__title">
						<?php the_title(); ?>
					</h2>
				</a>
				<time class="item__data" datetime="<?php echo get_the_date( 'c' ); ?>">
					<?php echo get_the_date(); ?>
				</time>
			</header>

			<div class="item__body">
				<p>
					<?php //ground_excerpt( 100 ); ?>
				</p>
			</div>

		</div>

	</article> <!-- End .item -->
</div>
