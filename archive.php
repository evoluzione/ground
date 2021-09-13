<?php
/**
 * Archive pages
 *
 * @package Ground
 */

get_template_part( 'partials/header' );
?>

	<div class="container">

		<?php get_template_part( 'partials/breadcrumbs' ); ?>

		<section class="page page--archive">

			<?php if ( have_posts() ) : ?>

				<div class="hero">

					<div class="hero__body">

						<?php
						if ( has_post_thumbnail() ) {
							?>
						<img class="hero__image" srcset="<?php ground_image( 'large' ); ?> 1200w,
										<?php ground_image( 'medium_large' ); ?> 768w,
										<?php ground_image( 'medium' ); ?> 480w" src="<?php ground_image( 'small' ); ?>">
							<div class="hero__image-filter" aria-hidden="true"></div>
								<?php
						}
						?>

						<div class="hero__content">
							<div class="grid grid-cols-12 gap-x-6">
								<div class="col-span-full lg:col-span-3">
									<h1 class="color-typo-primary text-3xl font-bold py-3 lg:py-0"><?php the_archive_title(); ?></h1>
								</div>
								<div class="col-span-full lg:col-start-6 lg:col-span-7">
									<div class="text-typo-primary text-base">
										<?php the_archive_description(); ?>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>

				<div class="page__body">

					<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-12 js-infinite-container">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'partials/abstract', 'post' );

					endwhile;
					?>

					</div>
				</div> <!-- End .page__body -->

				<?php get_template_part( 'partials/pagination' ); ?>

			<?php endif; ?>

		</section> <!-- End .page -->

	</div> <!-- End .container -->

<?php
get_template_part( 'partials/footer' );
