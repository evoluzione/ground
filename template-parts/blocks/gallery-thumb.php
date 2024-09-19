<?php
/**
 * Gallery thumb block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$gallery   = get_field( 'gallery' );
$no_margin = get_field( 'no_margin' );

if ( $gallery ) :

	$html_gallery = '';
	$html_thumb   = '';

	foreach ( $gallery as $image ) :

		$html_gallery .= '<div class="swiper-slide">';
		$html_gallery .= '<img src="' . $image['sizes']['16-9-large'] . '" />';
		$html_gallery .= '</div>';

		$html_thumb .= '<div class="swiper-slide">';
		$html_thumb .= '<img src="' . $image['sizes']['16-9-small'] . '" />';
		$html_thumb .= '</div>';

	endforeach;

	?>

	<div class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose">
		<div class="<?php echo esc_attr( ground_block_class( $block ) ); ?> container">

			<div class="grid grid-cols-12">
				<div class="col-span-12">

					<!-- Swiper -->
					<div class="gallery-thumb">

						<!-- Swiper gallery -->
						<div class="swiper js-swiperGallery js-slider">
							<div class="swiper-wrapper">
								<?php echo $html_gallery; ?>
							</div>
						</div>

						<!-- Swiper thumbs -->
						<div class="swiper js-swiperThumb js-slider">
							<div class="swiper-wrapper">
								<?php echo $html_thumb; ?>
							</div>
						</div>

					</div>

				</div>
			</div>

		</div>
	</div>

	<?php
endif;
