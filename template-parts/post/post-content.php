<article class="page page--post-single">

	<div class="hero hero--full-width">

		<div class="hero__body">

			<?php if ( has_post_thumbnail() ) : ?>
				<img class="hero__image" srcset="<?php ground_image( 'large' ); ?> 1200w,
							<?php ground_image( 'medium_large' ); ?> 768w,
							<?php ground_image( 'medium' ); ?> 480w" src="<?php ground_image( 'small' ); ?>">
				<div class="hero__image-filter" aria-hidden="true"></div>
				
				<div class="hero__content hero-has-thumbnail container">
			<?php else : ?>
				<div class="hero__content">
			<?php endif; ?>

					<div class="max-w-xl mx-auto">
						<div class="text-center">
							<h1 class="mb-3"><?php the_title(); ?></h1>
							<time datetime="<?php echo get_the_date( 'c' ); ?>" class="text-quaternary"><?php echo get_the_date(); ?></time></span>
						</div>
					</div>

				</div> <!-- End .hero__content -->

		</div> <!-- End .hero__body -->

	</div> <!-- End .hero hero--full-width -->

	<div class="container">
		<header class="page__header hidden">
			<h1 class="page__title"><?php the_title(); ?></h1>
			<span class="page__data page__data--date"><time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time></span>
		</header>
	</div>

	<div class="page__body mt-12 mb-24 lg:mb-72">
		<div class="prose">
			<?php the_content(); ?>
		</div>
		<?php
		if ( comments_open() && ! post_password_required() ) {
			comments_template( '/template-parts/comment/comments.php' );
		}
		?>


		<?php
		$args   = array(
			'posts_per_page'      => 3,
			'post__not_in'        => array( get_the_ID() ),
			'ignore_sticky_posts' => 1,
		);
		$parent = new WP_Query( $args );
		?>

		<?php if ( count( $parent->posts ) > 0 ) { ?>
			<div class="mt-24 mb-24 container">
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
														<?php
														if ( has_post_thumbnail() ) {
															?>
																srcset="<?php ground_image( '1-1-small' ); ?> 480w,
																<?php ground_image( '1-1-medium' ); ?> 900w,
																<?php ground_image( '1-1-large' ); ?> 1200w" sizes="(min-width: 1200px) 1200px,
														(min-width: 768px) 900px,
														100vh" src="<?php ground_image( '1-1-large' ); ?>"
																						<?php
														} else {
															?>
																							src="<?php echo GROUND_NO_IMAGE_URL; ?>" <?php } ?> alt="" loading="lazy">
													</div>
												</a>
											</div>

											<div class="lg:col-start-6 lg:col-end-12">
												<div class="text-quaternary mb-4"><time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time></div>
												<a class="no-underline mb-4" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
													<h3 class="text-2xl text-tertiary"> <?php the_title(); ?> </h3>
												</a>
												<div class="text-quaternary my-4"><?php ground_excerpt( 100 ); ?> </div>
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

	</div> <!-- End .page__body -->



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

</article> <!-- End .page -->
