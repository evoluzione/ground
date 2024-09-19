<?php
/**
 * Photo shooting block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$repeater = get_field( 'repeater' );
$no_margin = get_field( 'no_margin' );
$columns_number = get_field( 'columns_number' );

if ( $repeater ) : ?>
	<div
		class="ground-block py-6 relative <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
		<div class="relative columns-2 lg:columns-<?php echo esc_attr( $columns_number ); ?> lg:gap-6">
			<?php
			foreach ( $repeater as $key => $image ) :
				$image_horizontal = ( $image['width'] > $image['height'] ) ? true : false;
				$image_square = ( $image['width'] == $image['height'] ) ? true : false;

				if ( $image ) {
					?>
					<div>
						<figure
							class="overflow-hidden mb-6 aspect-w-1 aspect-h-1 <?php echo $image_horizontal && ! $image_square ? 'aspect-w-16 aspect-h-9' : ''; ?> <?php echo ! $image_horizontal && ! $image_square ? 'aspect-w-3 aspect-h-4' : ''; ?>">
							<img class="w-full object-cover rounded-media" <?php if ( $image_horizontal && ! $image_square ) { ?>
									srcset="<?php echo $image['sizes']['16-9-small']; ?> 480w,
													<?php echo $image['sizes']['16-9-medium']; ?> 900w,
													<?php echo $image['sizes']['16-9-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px,
													(min-width: 768px) 900px,
													100vh" src="<?php echo $image['sizes']['16-9-large']; ?>" <?php }
							if ( ! $image_horizontal && ! $image_square ) { ?> srcset="<?php echo $image['sizes']['3-4-small']; ?> 480w,
													<?php echo $image['sizes']['3-4-medium']; ?> 900w,
													<?php echo $image['sizes']['3-4-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px,
													(min-width: 768px) 900px,
													100vh" src="<?php echo $image['sizes']['3-4-large']; ?>" <?php }
							if ( $image_square ) { ?> srcset="<?php echo $image['sizes']['1-1-small']; ?> 480w,
													<?php echo $image['sizes']['1-1-medium']; ?> 900w,
													<?php echo $image['sizes']['1-1-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px,
													(min-width: 768px) 900px,
													100vh" src="<?php echo $image['sizes']['1-1-large']; ?>" <?php } else { ?>
									src="<?php echo ground_config( 'media.placeholder_url' ); ?>" <?php } ?> alt="" loading="lazy">
						</figure>
					</div>
				<?php } ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
endif;
