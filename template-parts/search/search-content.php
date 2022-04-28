<div class="col-span-12 md:col-span-6 lg:col-span-4">
	<article class="item js-infinite-post">

		<figure class="item__media">
			<a class="no-underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<img class="item__image"
						<?php if ( has_post_thumbnail() ) { ?>
							srcset="<?php ground_image( '4-3-small' ); ?> 480w,
									<?php ground_image( '4-3-medium' ); ?> 900w,
									<?php ground_image( '4-3-large' ); ?> 1200w"
									sizes="(min-width: 1200px) 1200px,
											(min-width: 768px) 900px,
											100vh"
									src="<?php ground_image( '4-3-large' ); ?>"
						<?php } else { ?>
					src="<?php echo GROUND_NO_IMAGE_URL; ?>" <?php } ?>
					alt=""
					loading="lazy">
				</a>
		</figure>

		<div class="item__content">

			<header class="item__header">
				<a class="no-underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<h2 class="item__title"><?php the_title(); ?></h2>
				</a>
				<time class="item__data" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
			</header>

			<div class="item__body">
				<p><?php ground_excerpt( 100 ); ?></p>
			</div>

		</div>

	</article> <!-- End .item -->
</div>
