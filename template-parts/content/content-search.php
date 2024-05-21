<?php //TODO: AGGIORNARE HTML ?>
<div class="col-span-12 md:col-span-6 lg:col-span-4">
	<article class="item js-infinite-post">

		<figure class="item__media">
			<a class="no-underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php ground_image( [ 
					'size' => '4-3-large',
					'attr' => [ 
						'class' => 'item__image',
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