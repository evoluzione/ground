<?php
/**
 * Carousel block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$repeater  = get_field( 'repeater' );
$no_margin = get_field( 'no_margin' );

if ( $repeater ) : ?>

	<div class="relative ground-block overflow-hidden is-fullscreen <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
		<div class="container">

			<div class="carousel carousel--primary swiper-container js-slider js-carousel" data-scroll="js-slider-autoplay">
				<div class="swiper-wrapper js-cursor-drag">

					<?php
					foreach ( $repeater as $row ) :

						// Vars
						$image   = $row['image'];
						$title   = $row['title'];
						$content = $row['content'];
						$button  = $row['button'];
						?>

						<div class="carousel__item swiper-slide">
							<div class="aspect-w-1 aspect-h-1 lg:aspect-w-16 lg:aspect-h-9 rounded-media">
								<?php if ( $image ) { ?>
									<figure class="carousel__media overflow-hidden aspect-w-1 aspect-h-1 lg:aspect-w-16 lg:aspect-h-9 rounded-media">
										<img class="object-cover carousel__img" srcset="<?php echo esc_attr( $image['sizes']['1-1-small'] ); ?> 480w,
													<?php echo $image['sizes']['1-1-medium']; ?> 900w,
													<?php echo $image['sizes']['16-9-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px,
													(min-width: 768px) 900px,
													100vh" src="<?php echo $image['sizes']['16-9-large']; ?>" alt="<?php echo $title; ?>" loading="lazy">
									</figure>
								<?php } ?>

							</div>
							<div class="carousel__body">
								<?php if ( $title ) : ?>
									<h3 class="carousel__title"><?php echo esc_attr( $title ); ?></h3>
								<?php endif; ?>
								<?php if ( $content ) : ?>
									<p class="carousel__text"><?php echo esc_attr( $content ); ?></p>
								<?php endif; ?>
								<?php if ( $button ) : ?>
									<div class="carousel__button">
										<a class="button" href="<?php echo esc_attr( $button['url'] ); ?>"><?php echo esc_attr( $button['title'] ); ?></a>
									</div>
								<?php endif; ?>
							</div>
						</div>

					<?php endforeach; ?>

				</div> <!-- End .swiper-wrapper -->


				<div class="carousel__navigation-container">
					<div class="carousel__navigation carousel__navigation--prev swiper-button-prev js-slider-primary-navigation-prev js-cursor-left js-magnet"><?php ground_icon( 'chevron-left' ); ?></div>
					<div class="carousel__pagination carousel__pagination--flat swiper-pagination js-slider-primary-pagination"></div>
					<div class="carousel__navigation carousel__navigation--next swiper-button-next js-slider-primary-navigation-next js-cursor-right js-magnet"><?php ground_icon( 'chevron-right' ); ?></div>
				</div>

			</div> <!-- End .slider -->

		</div>

	</div>

	<?php
endif;
