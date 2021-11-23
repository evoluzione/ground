<article class="item js-infinite-post">
	<a class="item__link margin-bottom-1" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<img class="item__media"
				<?php if ( has_post_thumbnail() ) { ?>
						srcset="<?php ground_image( '4-3-small' ); ?> 480w,
					<?php ground_image( '4-3-medium' ); ?> 900w,
					<?php ground_image( '4-3-large' ); ?> 1200w" sizes="(min-width: 1200px) 1200px,
					(min-width: 768px) 900px,
					100vh" src="<?php ground_image( '4-3-large' ); ?>"
				<?php
				} else {
					?>
				src="<?php echo GROUND_NO_IMAGE_URL; ?>" <?php } ?> alt="" loading="lazy">
	</a>

	<header class="item__header">
		<a class="item__link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><h2 class="mt-6"><?php the_title(); ?></h2></a>
		<time class="inline-block mt-3" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
	</header>

	<div class="item__body mt-3">
		<p><?php ground_excerpt( 100 ); ?></p>
	</div>
</article> <!-- End .item -->
