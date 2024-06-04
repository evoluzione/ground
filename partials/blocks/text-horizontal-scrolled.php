<?php
/**
 * Text horizontal scrolled block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$title     = get_field( 'title' );
$button    = get_field( 'button' );
$image     = get_field( 'image' );
$no_margin = get_field( 'no_margin' );

if ( $image ) :
	$image_horizontal = ( $image['width'] > $image['height'] ) ? true : false;
	$image_square     = ( $image['width'] == $image['height'] ) ? true : false;
endif;

if ( $title ) : ?>
	<div class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> <?php echo esc_attr( ground_block_class( $block ) ); ?>">
		<div class="flex justify-center items-center <?php $image ? 'h-screen' : ''; ?>">
			<?php if ( $button ) { ?>
				<a class="no-underline" href="<?php echo esc_attr( $button['url'] ); ?>">
			<?php } ?>

				<?php if ( $image ) { ?>
					<img class="object-cover"
						<?php
						if ( $image_horizontal && ! $image_square ) {
							?>
							srcset="<?php echo $image['sizes']['16-9-small']; ?> 480w,
							<?php echo $image['sizes']['16-9-medium']; ?> 900w,
							<?php echo $image['sizes']['16-9-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px, (min-width: 768px) 900px, 100vh" src="<?php echo $image['sizes']['16-9-large']; ?>"
							<?php
						}

						if ( ! $image_horizontal && ! $image_square ) {
							?>
							srcset="<?php echo $image['sizes']['3-4-small']; ?> 480w,
							<?php echo $image['sizes']['3-4-medium']; ?> 900w,
							<?php echo $image['sizes']['3-4-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px, (min-width: 768px) 900px, 100vh" src="<?php echo $image['sizes']['3-4-large']; ?>"
							<?php
						}

						if ( $image_square ) {
							?>
							srcset="<?php echo $image['sizes']['1-1-small']; ?> 480w,
							<?php echo $image['sizes']['1-1-medium']; ?> 900w,
							<?php echo $image['sizes']['1-1-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px, (min-width: 768px) 900px, 100vh" src="<?php echo $image['sizes']['1-1-large']; ?>"
							<?php
						} else {
							?>
						src="<?php echo GROUND_TEMPLATE_URL; ?>/img/no-image.svg" <?php } ?> alt="" loading="lazy">
				<?php } ?>

			<?php if ( $button ) { ?>
				</a>
			<?php } ?>

			<div class="absolute is-fullscreen overflow-hidden max-w-full">
				<div class="lg:flex lg:items-center lg:justify-between">
					<?php if ( $button ) { ?>
						<a class="no-underline" href="<?php echo esc_attr( $button['url'] ); ?>">
						<?php } ?>
						<div class="text-center py-6">
							<?php if ( $title ) : ?>
								<h2 data-scroll="js-parallax" data-scroll-speed-y="0" data-scroll-speed-x="8" class="whitespace-nowrap text-tertiary text-9xl w-full"><?php echo esc_attr( $title ); ?></h2>
							<?php endif; ?>
						</div>
						<?php if ( $button ) { ?>
						</a>
					<?php } ?>
				</div>
			</div>

		</div>
	</div>

	<?php
endif;
