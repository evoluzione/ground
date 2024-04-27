<?php
/**
 * Pinned category products block template.
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
 <div class="relative is-fullscreen <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
	<div class="lg:grid lg:grid-cols-3 lg:gap-6">
		<div class="px-6 lg:px-0 lg:col-span-2 lg:h-screen lg:sticky lg:top-0">
			<?php $image = $repeater[0]; ?>
				<?php if ( $image ) { ?>
					<figure class="overflow-hidden mb-6 aspect-w-3 aspect-h-4">
						<img class="w-full object-cover rounded-theme"
									srcset="<?php echo $image['sizes']['3-4-small']; ?> 480w,
											<?php echo $image['sizes']['3-4-medium']; ?> 900w,
											<?php echo $image['sizes']['3-4-large']; ?> 1200w"
									sizes="(min-width: 1200px) 1200px,
											(min-width: 768px) 900px,
											100vh"
									src="<?php echo $image['sizes']['3-4-large']; ?>"
							alt=""
							loading="lazy">
					</figure>
			<?php } ?>
		</div>
		<div class="lg:space-y-6 mt-6 carousel-css lg:mt-0">
			<?php
			foreach ( $repeater as $key => $image ) :

				$image_horizontal = ( $image['width'] > $image['height'] ) ? true : false;
				$image_square     = ( $image['width'] == $image['height'] ) ? true : false;
				?>

					<?php if ( $image && $key >= 1 ) { ?>
						<div class="p-0 m-0">
							<figure class="overflow-hidden mb-6 aspect-w-1 aspect-h-1 <?php echo $image_horizontal && ! $image_square ? 'lg:aspect-w-16 lg:aspect-h-9' : ''; ?> <?php echo ! $image_horizontal && ! $image_square ? 'lg:aspect-w-3 lg:aspect-h-4' : ''; ?>">
								<img class="w-full object-cover rounded-media"
										<?php if ( $image_horizontal && ! $image_square ) { ?>
											srcset="<?php echo $image['sizes']['16-9-small']; ?> 480w,
													<?php echo $image['sizes']['16-9-medium']; ?> 900w,
													<?php echo $image['sizes']['16-9-large']; ?> 1200w"
											sizes="(min-width: 1200px) 1200px,
													(min-width: 768px) 900px,
													100vh"
											src="<?php echo $image['sizes']['16-9-large']; ?>"
										<?php } if ( ! $image_horizontal && ! $image_square ) { ?>
											srcset="<?php echo $image['sizes']['3-4-small']; ?> 480w,
													<?php echo $image['sizes']['3-4-medium']; ?> 900w,
													<?php echo $image['sizes']['3-4-large']; ?> 1200w"
											sizes="(min-width: 1200px) 1200px,
													(min-width: 768px) 900px,
													100vh"
											src="<?php echo $image['sizes']['3-4-large']; ?>"
										<?php } if ( $image_square ) { ?>
											srcset="<?php echo $image['sizes']['1-1-small']; ?> 480w,
													<?php echo $image['sizes']['1-1-medium']; ?> 900w,
													<?php echo $image['sizes']['1-1-large']; ?> 1200w"
											sizes="(min-width: 1200px) 1200px,
													(min-width: 768px) 900px,
													100vh"
											src="<?php echo $image['sizes']['1-1-large']; ?>"
										<?php } else { ?>
											src="<?php echo ground_config( 'media.no_image_url' ); ?>"
										<?php } ?>
									alt=""
									loading="lazy">
							</figure>
						</div>
					<?php } ?>

			<?php endforeach; ?>
		</div>
	</div>
</div>
	<?php
endif;
