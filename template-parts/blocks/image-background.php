<?php
/**
 * Image background block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$image     = get_field( 'image' );
$no_margin = get_field( 'no_margin' );
?>

<div class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
	<div class="pb-12 lg:pb-24 relative">

		<div class="absolute is-fullscreen -z-1 pb-64 w-full top-0 left-0">
			<?php if ( $image ) { ?>
				<figure class="opacity-50 overflow-hidden aspect-w-3 aspect-h-4 lg:aspect-w-16 lg:aspect-h-9 rounded-none">
					<img class="relative -z-5 object-cover rounded-none" srcset="<?php echo esc_attr( $image['sizes']['1-1-small'] ); ?> 480w,
									<?php echo esc_attr( $image['sizes']['1-1-medium'] ); ?> 900w,
									<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?> 1200w" sizes="(min-width: 1200px) 1200px,
									(min-width: 768px) 900px,
									100vh" src="<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy">
					<div class="absolute inset-0 bg-gradient-to-t from-quinary w-full h-full -z-1" aria-hidden="true"></div>
				</figure>
			<?php } ?>

		</div>

	</div>
</div>
