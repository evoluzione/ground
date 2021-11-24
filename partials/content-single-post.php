<article class="page page--post-single">

	<div class="hero hero--full-width">

		<div class="hero__body">

			<?php
			if ( has_post_thumbnail() ) { ?>
				<img class="hero__image" srcset="<?php ground_image( 'large' ); ?> 1200w,
							<?php ground_image( 'medium_large' ); ?> 768w,
							<?php ground_image( 'medium' ); ?> 480w" src="<?php ground_image( 'small' ); ?>">
					<div class="hero__image-filter" aria-hidden="true"></div>
					<div class="hero__content hero-has-thumbnail">
					<?php
			} else {
				?>

			<div class="hero__content">
			<?php } ?>

			 <h1 class="text-center"><?php the_title(); ?></h1>

			</div>

		</div>

	</div>

	<header class="page__header hidden">
		<h1 class="page__title"><?php the_title(); ?></h1>
		<span class="page__data page__data--date"><time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time></span>
	</header>

	<div class="page__body mt-12">
		<?php the_content(); ?>
	</div> <!-- End .page__body -->

	<?php
		$args   = array(
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
		);
		$parent = new WP_Query( $args );
	?>

	<?php if ( count($parent->posts) > 0 ) { ?>
	<div class="mt-24 mb-24">
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
		<div class="relative">
			<h3 class="text-4xl no-underline mb-4 relative"> <?php _e( 'Other news', 'ground' ); ?> </h3>
	  		<a class="text-base underline text-primary" href="<?php echo get_post_type_archive_link( 'post' ); ?>"> <?php _e( 'Discover all news', 'ground' ); ?> </a>
		</div>
			<div class="lg:col-span-2">
				<div class="carousel-css">


					<?php if ( $parent->have_posts() ) : ?>
						<?php
						while ( $parent->have_posts() ) :
							$parent->the_post();
							?>
							<article class="relative">
								<div class="mb-12 grid grid-cols-1 lg:grid-cols-12 items-center">

									<div class="lg:col-start-1 lg:col-end-4 mb-6 lg:mb-0">
										<a class="no-underline w-full" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<div class="overflow-hidden aspect-w-1 aspect-h-1 rounded-full">
												<img class="object-cover"
													<?php if ( has_post_thumbnail() ) { ?>
														srcset="<?php ground_image( '1-1-small' ); ?> 480w,
																<?php ground_image( '1-1-medium' ); ?> 900w,
																<?php ground_image( '1-1-large' ); ?> 1200w" sizes="(min-width: 1200px) 1200px,
														(min-width: 768px) 900px,
														100vh" src="<?php ground_image( '1-1-large' ); ?>"
													<?php } else { ?>
														src="<?php echo GROUND_TEMPLATE_URL; ?>/img/no-image.svg"
													<?php } ?>
														alt="" loading="lazy">
											</div>
										</a>
									</div>

									<div class="lg:col-start-6 lg:col-end-12">
										<div class="text-typo-secondary mb-4"><time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time></div>
										<a class="no-underline mb-4" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><h3 class="text-2xl text-typo-primary"> <?php the_title(); ?> </h3> </a>
										<div class="text-typo-secondary my-4"><?php ground_excerpt( 100 ); ?> </div>
										<a class="text-primary inline-block underline" href="<?php the_permalink(); ?>"><?php _e( 'Discover', 'ground' ); ?></a>
									</div>

								</div>
							</article>

						<?php endwhile; ?>
					<?php endif; ?>

					<?php wp_reset_postdata(); ?>

				</div>
			</div>
		</div>
	</div>
	<?php } ?>

	<footer class="page__footer hidden">
		<span class="page__data page__data--category"><?php _e( 'Category', 'ground' ); ?>: <?php the_category( ', ' ); ?></span>
		<?php if ( comments_open() && ! post_password_required() ) { ?>
			<span class="page__data page__data--comments"><?php _e( 'Comments', 'ground' ); ?>: <?php comments_popup_link(); ?></span>
		<?php } ?>
		<?php
		if ( has_tag() ) {
			?>
			<?php the_tags( '<span class="page__data page__data--tag">', '', '</span>' ); ?><?php } ?>
	</footer> <!-- End .page__footer -->

	<?php
	// if ( comments_open() || get_comments_number() ) {
	// comments_template( '/partials/comments.php' );
	// }
	?>

</article> <!-- End .page -->
