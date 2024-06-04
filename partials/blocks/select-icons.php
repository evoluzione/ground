<?php
/**
 * Select icons block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$repeater = get_field( 'repeater' );
$repeater_count = count( get_field( 'repeater' ) );
$no_margin = get_field( 'no_margin' );

if ( $repeater ) : ?>
	<div
		class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> rounded-theme lg:items-center lg:grid lg:grid-flow-col lg:grid-cols-<?php echo $repeater_count; ?> lg:gap-6 not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">

		<?php
		foreach ( $repeater as $row ) :
			$select = $row['select'];
			$title = $row['title'];
			$content = $row['content'];
			$button = $row['button'];
			?>

			<div class="group relative my-6 lg:my-0">
				<?php if ( $button ) : ?>
					<a class="block w-full" href="<?php echo esc_attr( $button['url'] ); ?>">
					<?php endif; ?>
					<div class="flex items-center">
						<?php if ( $select ) : ?>
							<h4
								class="font-normal relative mr-6 bg-senary p-4 rounded-full <?php $button ? 'transition duration-500 transform-gpu group-hover:scale-110' : ''; ?>">
								<?php /*ground_icon_old( $select, 'w-8 text-quaternary aspect-w-1 aspect-h-1' ); */ ?>
							</h4>
						<?php endif; ?>
						<?php if ( $title || $content ) : ?>
							<div>
								<?php if ( $title ) : ?>
									<h6 class="relative lg:pr-12">
										<?php echo esc_attr( $title ); ?>
									</h6>
								<?php endif; ?>
								<?php if ( $content ) : ?>
									<div class="text-quaternary mt-1 lg:mt-2">
										<p class="text-sm"><?php echo $content; ?></p>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php if ( $button ) : ?>
					</a>
				<?php endif; ?>
			</div>

		<?php endforeach ?>
	</div>

	<?php
endif;
