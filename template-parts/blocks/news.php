<?php
/**
 * News block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$title = get_field( 'title' );
$content = get_field( 'content' );
$button = get_field( 'button' );
$no_margin = get_field( 'no_margin' );
?>

<div
	class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
	<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

		<div class="relative">
			<?php if ( $title ) { ?>
				<h3 class="text-4xl no-underline" href="<?php echo $button['url']; ?>">
					<?php echo $title; ?>
				</h3>
			<?php } else { ?>
				<h3 class="text-4xl no-underline mb-4 relative" href="<?php echo $button['url']; ?>">
					<?php _e( 'Latest news', 'ground-child' ); ?>
				</h3>
			<?php } ?>
			<?php if ( $content ) : ?>
				<div class="mb-3 lg:w-3/6 lg:mb-6 text-quaternary">
					<?php echo $content; ?>
				</div>
			<?php endif; ?>
			<?php if ( $button ) { ?>
				<div class="mt-4">
					<a class="text-base underline text-quaternary" href="<?php echo $button['url']; ?>">
						<?php _e( 'Discover all news', 'ground-child' ); ?>
					</a>
				</div>
			<?php } ?>
		</div>

		<div class="lg:col-span-2 ">
			<div class="carousel-css">

				<?php
				$args = array(
					'posts_per_page' => 3,
					'post__not_in' => array( get_the_ID() ),
					'ignore_sticky_posts' => 1,
				);
				$parent = new WP_Query( $args );
				?>
				<?php if ( $parent->have_posts() ) : ?>
					<?php
					while ( $parent->have_posts() ) :
						$parent->the_post();
						?>
						<article class="group relative">
							<div class="mb-12 grid grid-cols-1 lg:grid-cols-12 items-center">

								<div class="lg:col-start-1 lg:col-end-4 mb-6 lg:mb-0">
									<a class="no-underline w-full" href="<?php the_permalink(); ?>"
										title="<?php the_title_attribute(); ?>">
										<div class="overflow-hidden aspect-w-1 aspect-h-1 rounded-full">
											<?php ground_image( '1-1-large', [ 
												'attr' => [ 
													'class' => 'object-cover transition duration-500 transform-gpu group-hover:scale-105',
												],
											] ); ?>
										</div>
									</a>
								</div>

								<div class="lg:col-start-6 lg:col-end-12">
									<div class="text-quaternary mb-4"><time datetime="<?php echo get_the_date( 'c' ); ?>">
											<?php echo get_the_date(); ?>
										</time></div>
									<a class="no-underline mb-4" href="<?php the_permalink(); ?>"
										title="<?php the_title_attribute(); ?>">
										<h3 class="text-tertiary">
											<?php the_title(); ?>
										</h3>
									</a>
									<div class="text-quaternary my-4">
										<?php ground_excerpt( 100 ); ?>
									</div>
									<a class="inline-block underline" href="<?php the_permalink(); ?>">
										<?php _e( 'Discover', 'ground-child' ); ?>
									</a>
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