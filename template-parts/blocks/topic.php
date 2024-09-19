<?php
/**
 * Topic block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$title     = get_field( 'title' );
$content   = get_field( 'content' );
$repeater  = get_field( 'repeater' );
$no_margin = get_field( 'no_margin' );
?>

<div class="relative ground-block  <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">

	<?php if ( $title ) : ?>
		<div class="lg:w-6/12">
			<h4><?php echo esc_attr( $title ); ?></h4>
		</div>
	<?php endif; ?>

	<?php if ( $content ) : ?>
		<div class="lg:w-4/12 pt-3 lg:pt-6">
			<div class="max-w-full text-quaternary"><?php echo esc_attr( $content ); ?></div>
		</div>
	<?php endif; ?>

	<?php if ( $repeater ) : ?>

		<div class="flex flex-wrap justify-start mt-6 lg:mt-9">

			<?php
			foreach ( $repeater as $row ) :
				$button = $row['button'];
				?>
				<div class="mr-3">
					<a class="button button--small button--tertiary mt-3 rounded-theme" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>
				</div>

			<?php endforeach; ?>

		</div>

	<?php endif; ?>

</div>
