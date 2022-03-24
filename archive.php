<?php

/**
 * Archive pages
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' );

/**
 * Hook: ground_archive_before.
 *
 * @hooked ground_breadcrumbs - 20
 */
do_action( 'ground_archive_before' );
?>

	<div class="relative mb-12 lg:mb-32">

		<section class="page page--archive">

			<?php if ( have_posts() ) : ?>
				<div class="hero overflow-hidden my-6 lg:my-24 lg:mt-12 relative rounded-theme">
					<div class="relative text-tertiary py-16 lg:py-32">
						<div class="grid grid-cols-12 gap-x-6 items-center">
							<div class="col-span-full lg:col-span-4">
								<div class="mb-6 flex items-center gap-6 lg:mb-0 lg:ml-6">
									<?php
									$term  = get_queried_object();
									$image = get_field( 'image', $term );
									?>
									<?php if ( $image ) : ?>
										<div class="overflow-hidden rounded-full">
											<img class="h-12 w-12 lg:h-24 lg:w-24 object-cover" srcset="<?php echo $image['sizes']['1-1-small']; ?> 480w,
														<?php echo $image['sizes']['1-1-medium']; ?> 900w,
														<?php echo $image['sizes']['1-1-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px,
														(min-width: 768px) 900px,
														100vh" src="<?php echo $image['sizes']['16-9-large']; ?>" alt="" loading="lazy">
										</div>
									<?php endif; ?>

									<h1 class="color-tertiary text-3xl py-3 lg:py-0"><?php the_archive_title(); ?></h1>
								</div>
							</div>
							<div class="col-span-full lg:col-start-6 lg:col-span-7">
								<div class="text-tertiary text-base">
									<?php the_archive_description(); ?>
								</div>
							</div>
						</div>

						<?php if ( $image ) : ?>
							<div class="hidden absolute -z-1 top-0 left-0 lg:flex lg:w-4/6">
								<img class="object-cover opacity-50 w-full" srcset="<?php echo $image['sizes']['1-1-small']; ?> 480w,
												<?php echo $image['sizes']['1-1-medium']; ?> 900w,
												<?php echo $image['sizes']['1-1-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px,
												(min-width: 768px) 900px,
												100vh" src="<?php echo $image['sizes']['16-9-large']; ?>" alt="" loading="lazy">
								<div class="absolute inset-0 bg-gradient-to-l from-quinary z-2"> </div>
								<div class="absolute inset-0 bg-gradient-to-t from-quinary z-1"> </div>
							</div>
						<?php endif; ?>

					</div>
				</div>

				<div class="page__body relative">
					<div class="lg:grid lg:grid-cols-12 lg:gap-6 mt-6">
						<?php if ( is_active_sidebar( 'sidebar-archive-post' ) ) : ?>
							<div class="col-span-3">
								<button class="button button--small button--bordered button--full-width block js-toggle mb-6 lg:hidden" data-toggle-target=".sidebar--archive-post html" data-toggle-class-name="is-sidebar-open">
									<?php ground_icon( 'options', 'button__icon' ); ?> <?php _e( 'Filters', 'ground' ); ?>
								</button>
								<?php get_template_part( 'template-parts/sidebar/sidebar-archive-post' ); ?>

							</div>
						<?php endif; ?>
						<div class="<?php echo is_active_sidebar( 'sidebar-archive-post' ) ? 'col-span-9' : 'col-span-full'; ?>">
							<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-6 lg:gap-y-12 js-infinite-container">
								<?php
								while ( have_posts() ) :
									the_post();

									get_template_part( 'template-parts/post/post-preview' );

								endwhile;
								?>
							</div>
						</div>
					</div>
				</div> <!-- End .page__body -->

				<?php get_template_part( 'template-parts/shared/pagination' ); ?>

			<?php endif; ?>

		</section> <!-- End .page -->

	</div> <!-- End .container -->

<?php
/**
 * Hook: ground_archive_after.
 */
do_action( 'ground_archive_after' );

get_template_part( 'template-parts/footer/footer' );
