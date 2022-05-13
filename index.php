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
				'posts_per_page'      => 4,
				'post__in'            => get_option( 'sticky_posts' ),
				'ignore_sticky_posts' => 1,
			);
			$sticky_posts = new WP_Query( $args );
			?>
		
			<div class="transform -translate-x-2/4 w-screen ml-1/2 rounded-none bg-senary">

				<div class="container py-9 lg:py-16 mb-12 lg:mb-24">

					<h2 class="mb-6">In evidenza</h2>

					<div class="items items-count-<?php echo count( $sticky_posts->posts ); ?>">

						<?php
						if ( $sticky_posts->have_posts() ) {
								$i = 0;
							while ( $sticky_posts->have_posts() ) {
								$sticky_posts->the_post();
								$i++;
								get_template_part( 'template-parts/post/post-preview' );
							}
						}
						wp_reset_query();
						?>

					</div>
				</div>
			</div>

		<div class="mt-12">

			<section class="page page--blog">
				<?php
				foreach ( $categories_ids as $row ) {
					?>
					<div class="page__body lg:grid lg:grid-cols-12 gap-6 mb-24 lg:mb-28 <?php echo get_container_class() ?>">

						<div class="col-span-full flex justify-between items-end lg:inline-block lg:col-span-4 mb-6 lg:mb-0">
							<div class="relative pr-16 lg:pr-28">
								<a class="no-underline" href="<?php echo get_category_link( $row ); ?>">
									<h2 class="lg:mb-6"><?php echo get_the_category_by_ID( $row ); ?></h2>
								</a>
								<div class="hidden lg:flex lg:mb-6 text-quaternary">
									<?php echo substr( strip_tags( category_description( $row ) ), 0, 120 ); ?>
								</div>
							</div>
							<a class="underline" href="<?php echo get_category_link( $row ); ?>"> <?php _e( 'Discover', 'ground' ); ?> </a>
						</div>

						<div class="col-span-full lg:col-span-8">

							<div class="carousel-css lg:grid lg:grid-cols-2 lg:gap-6">

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
										get_template_part( 'template-parts/post/post-preview' );
										?>
 
										<?php
									}
								}
								wp_reset_query();
								?>

							</div>
						</div>
					</div>
				<?php } ?>
			</section>

		</div>

	</div> <!-- End .container -->

<?php
/**
 * Hook: ground_index_after.
 */
do_action( 'ground_index_after' );

get_template_part( 'template-parts/footer/footer' );
