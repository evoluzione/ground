<?php
/**
 * The main template file
 *
 * @package Ground
 */

$categories_ids = get_terms(
	array( 'category' ), // Taxonomies
	array( 'fields' => 'ids' ) // Fields
);

get_template_part( 'template-parts/header/header' );

/**
 * Hook: ground_index_before.
 *
 * @hooked ground_breadcrumbs - 20
 */
do_action( 'ground_index_before' );
?>

	<div class="relative mb-12 lg:mb-24">
		<?php if ( single_post_title( '', false ) ) : ?>
			<header class="page__header">
				<h1 class="page__title lg:mt-24"><?php single_post_title(); ?></h1>
				<?php if ( count( $categories_ids ) > 1 ) { ?>
					<?php get_template_part( 'template-parts/navigation/navigation-blog' ); ?>
				<?php } ?>

				<?php
				$page_for_posts_id  = get_option( 'page_for_posts' );
				$page_for_posts_obj = get_post( $page_for_posts_id );
				echo apply_filters( 'the_content', $page_for_posts_obj->post_content );
				?>
			</header>
		<?php endif; ?>

		<?php
			$args         = array(
				'posts_per_page' => 4,
				'post__in'       => get_option( 'sticky_posts' ),
			);
			$sticky_posts = new WP_Query( $args );
			?>
		<?php
		if ( count( $sticky_posts->posts ) >= 1 && count( $sticky_posts->posts ) < 4 ) {
			?>
			<div class="posts mb-12 lg:mb-24 items-count-<?php echo count( $sticky_posts->posts ) >= 3 ? 3 : count( $sticky_posts->posts ); ?>">

			<?php
			if ( $sticky_posts->have_posts() ) {
					$i = 0;
				while ( $sticky_posts->have_posts() ) {
						$sticky_posts->the_post();
						$i++;

					if ( $i <= 3 ) {
						?>
							<div class="post">
						<?php if ( count( $sticky_posts->posts ) == 1 ) { ?>
									<article class="item js-infinite-post">
										<a class="item__link margin-bottom-1" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<img class="item__media"
													<?php if ( has_post_thumbnail() ) { ?>
															srcset="<?php ground_image( '16-9-small' ); ?> 480w,
														<?php ground_image( '16-9-medium' ); ?> 900w,
														<?php ground_image( '16-9-large' ); ?> 1200w" sizes="(min-width: 1200px) 1200px,
														(min-width: 768px) 900px,
														100vh" src="<?php ground_image( '16-9-large' ); ?>"
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
									</article>
								<?php } else { ?>
										<?php get_template_part( 'template-parts/post/post-preview' ); ?>
								<?php } ?>
							</div>
						<?php
					}
				}
			}
				wp_reset_query();
			?>
			</div>
		<?php } ?>

		<div class="mt-12">
			<?php if ( count( $categories_ids ) == 1 ) { ?>
			<section class="page page--blog">
				<?php
				if ( have_posts() ) :
					?>
					<div class="page__body">
						<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-12 js-infinite-container">

							<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/post/post-preview' );
							endwhile;
							wp_reset_query();
							?>
						</div>
					</div> <!-- End .page__body -->
					<?php get_template_part( 'template-parts/shared/pagination' ); ?>
					<?php
				endif;
				?>
			</section> <!-- End .page -->
			<?php } else { ?>

			<section class="page page--blog">
				<?php
				foreach ( $categories_ids as $row ) {
					?>
					<div class="page__body grid grid-cols-12 gap-6 mb-12 lg:mb-24">
						<div class="col-span-full flex justify-between items-center lg:inline-block lg:col-span-4">
							<a class="no-underline" href="<?php echo get_category_link( $row ); ?>"> <h2 class="lg:mb-6"> <?php echo get_the_category_by_ID( $row ); ?> </h2> </a>
							<div class="hidden lg:flex lg:mb-6"> <?php echo substr( strip_tags( category_description( $row ) ), 0, 120 ) . '...'; ?> </div>
							<a class="underline" href="<?php echo get_category_link( $row ); ?>"> <?php _e( 'Discover', 'ground' ); ?> </a>
						</div>

							<?php
							$args = array(
								'post_type'      => 'post',
								'orderby'        => 'date',
								'posts_per_page' => 2,
								'cat'            => $row,
							);

							$recent = new WP_Query( $args );
							if ( $recent->have_posts() ) {
								while ( $recent->have_posts() ) {
										$recent->the_post();
									?>
										<div class="col-span-full lg:col-span-4">
											<?php get_template_part( 'template-parts/post/post-preview' ); ?>
										</div>
									<?php
								}
							}

							wp_reset_query();
							?>
					</div>
				<?php } ?>
			</section>
			<?php } ?>
		</div>

	</div> <!-- End .container -->

<?php
/**
 * Hook: ground_index_after.
 */
do_action( 'ground_index_after' );

get_template_part( 'template-parts/footer/footer' );
