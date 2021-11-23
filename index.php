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

get_template_part( 'partials/header' );
?>
<div class="container">
	<?php get_template_part( 'partials/breadcrumbs' ); ?>
</div>
	<div class="container relative mb-12 lg:mb-24">
		<?php if ( single_post_title( '', false ) ) : ?>
			<header class="page__header">
				<h1 class="page__title"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

		<div class="posts items-count-3">
		<?php
			$args = array(
					'posts_per_page' => 3,
					'post__in' => get_option( 'sticky_posts' ),
					'ignore_sticky_posts' => 1
			);
			$sticky_posts = new WP_Query( $args );

			if ( $sticky_posts->have_posts() ) {
				while ( $sticky_posts->have_posts() ) {
						$sticky_posts->the_post();
					?>
						<div class="post">
							<?php get_template_part( 'partials/abstract', 'post' ); ?>
						</div>
					<?php
				}
			}
			wp_reset_query();
		?>
		</div>


		<?php if(count($categories_ids) == 1) { ?>
		<section class="page page--blog">
			<?php
			if ( have_posts() ) : ?>
				<div class="page__body">
					<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-12 js-infinite-container">

						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'partials/abstract', 'post' );
						endwhile;
						wp_reset_query();
						?>
					</div>
				</div> <!-- End .page__body -->
				<?php get_template_part( 'partials/pagination' ); ?>
				<?php
			endif;
			?>
		</section> <!-- End .page -->
		<?php } else { ?>
		<div class="lg:pb-24">
		<?php get_template_part( 'partials/navigation', 'blog' ); ?>
		</div>

		<section class="page page--blog">
			<?php foreach ( $categories_ids as $row ) {
				?>
				<div class="page__body grid grid-cols-12 gap-6 mb-12 lg:mb-24">
					<div class="col-span-full flex justify-between items-center lg:inline-block lg:col-span-4">
						<a class="no-underline" href="<?php echo get_category_link( $row ); ?>"> <h2 class="lg:mb-6"> <?php echo get_the_category_by_ID( $row ); ?> </h2> </a>
						<div class="hidden lg:flex lg:mb-6"> <?php echo substr(strip_tags(category_description( $row )),0,120) . "..."; ?> </div>
						<a class="underline" href="<?php echo get_category_link( $row ); ?>"> <?php _e( 'Discover' ); ?> </a>
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
										<?php get_template_part( 'partials/abstract', 'post' ); ?>
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

	</div> <!-- End .container -->

<?php
get_template_part( 'partials/footer' );
