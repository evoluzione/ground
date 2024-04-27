<article class="border-b py-6">

	<?php //TODO: FIX ?>
	<!-- <figure class="item__media">
		<a class="no-underline" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<img class="item__image" <?php if ( has_post_thumbnail() ) { ?> srcset="<?php ground_image( '4-3-small' ); ?> 480w,
								<?php ground_image( '4-3-medium' ); ?> 900w,
								<?php ground_image( '4-3-large' ); ?> 1200w" sizes="(min-width: 1200px) 1200px,
										(min-width: 768px) 900px,
										100vh" src="<?php ground_image( '4-3-large' ); ?>" <?php } else { ?>
					src="<?php //echo ground_config( 'media.no_image_url' ); ?>" <?php } ?> alt="" loading="lazy">
		</a>
	</figure> -->

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

</article> <!-- End article -->