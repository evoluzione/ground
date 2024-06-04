<?php
/**
 * Text image scrolled block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$image = get_field( 'image' );
$title = get_field( 'title' );
$content = get_field( 'content' );
$button = get_field( 'button' );
$invert = get_field( 'checkbox' );
$bk_color = get_field( 'checkbox2' );
$no_margin = get_field( 'no_margin' );

if ( $image ) {
	$image_horizontal = ( $image['width'] > $image['height'] ) ? true : false;
	$image_square = ( $image['width'] == $image['height'] ) ? true : false;
}

if ( $content || $image ) : ?>
	<div
		class="group relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> <?php echo esc_attr( ground_block_class( $block ) ); ?>">
		<div
			class="relative lg:grid lg:grid-flow-col lg:grid-cols-2 gap-6 lg:items-center rounded-theme <?php echo $bk_color ? 'bg-senary' : ''; ?>">

			<?php if ( $image ) { ?>
				<div class="not-prose <?php echo $invert ? 'order-last' : ''; ?>">
					<figure
						class=" overflow-hidden aspect-w-1 aspect-h-1 <?php echo $image_horizontal && ! $image_square ? 'aspect-w-16 aspect-h-9' : ''; ?> <?php echo ! $image_horizontal && ! $image_square ? 'aspect-w-3 aspect-h-4' : ''; ?>">
						<img class="object-cover <?php echo $button ? 'transition duration-500 transform-gpu group-hover:scale-105' : ''; ?>"
							<?php
							if ( $image_horizontal && ! $image_square ) {
								?>
								srcset="<?php echo $image['sizes']['16-9-small']; ?> 480w, <?php echo $image['sizes']['16-9-medium']; ?> 900w, <?php echo $image['sizes']['16-9-large']; ?> 1200w"
								sizes="(min-width: 1200px) 1200px, (min-width: 768px) 900px, 100vh"
								src="<?php echo $image['sizes']['16-9-large']; ?>" <?php
							}

							if ( ! $image_horizontal && ! $image_square ) {
								?>
								srcset="<?php echo $image['sizes']['3-4-small']; ?> 480w, <?php echo $image['sizes']['3-4-medium']; ?> 900w, <?php echo $image['sizes']['3-4-large']; ?> 1200w"
								sizes="(min-width: 1200px) 1200px, (min-width: 768px) 900px, 100vh"
								src="<?php echo $image['sizes']['3-4-large']; ?>" <?php
							}

							if ( $image_square ) {
								?>
								srcset="<?php echo $image['sizes']['1-1-small']; ?> 480w, <?php echo $image['sizes']['1-1-medium']; ?> 900w, <?php echo $image['sizes']['1-1-large']; ?> 1200w"
								sizes="(min-width: 1200px) 1200px, (min-width: 768px) 900px, 100vh"
								src="<?php echo $image['sizes']['1-1-large']; ?>" <?php
							} else {
								?>
								src="<?php echo ground_config( 'media.no_image_url' ); ?>" <?php } ?> alt="" loading="lazy">
					</figure>
				</div>
			<?php } ?>
			<?php if ( $content || $title ) : ?>
				<div class="relative flex justify-center lg:text-left lg:p-12 lg:mb-0 lg:px-24">
					<div class="<?php echo $bk_color ? 'px-6 pb-6 lg:pb-0 lg:px-0' : ''; ?>">
						<?php if ( $title ) : ?>
							<div class="max-w-2xl md:max-w-lg">
								<h4 class="mb-3 text-tertiary">
									<?php echo esc_attr( $title ); ?>
								</h4>
							</div>
						<?php endif; ?>
						<?php if ( $content ) : ?>
							<div class="relative text-quaternary">
								<?php echo wp_kses_post( $content ); ?>
							</div>
						<?php endif; ?>
						<?php if ( $button ) : ?>
							<a class="mt-6 button button--tertiary button--small" href="<?php echo esc_attr( $button['url'] ); ?>">
								<?php echo esc_attr( $button['title'] ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

		</div>
	</div>

	<?php
endif;
