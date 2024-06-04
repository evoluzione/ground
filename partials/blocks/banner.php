<?php
/**
 * Banner block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$repeater  = get_field( 'repeater' );
$no_margin = get_field( 'no_margin' );
?>

<?php
if ( $repeater ) :
	$repeater_count = count( get_field( 'repeater' ) );

	if ( $repeater_count == 1 ) {
		$block_ratio = 'lg:aspect-w-7 lg:aspect-h-3';
	} elseif ( $repeater_count == 2 ) {
		$block_ratio = 'lg:aspect-w-1 lg:aspect-h-1';
	} elseif ( $repeater_count == 3 ) {
		$block_ratio = 'lg:aspect-w-4 lg:aspect-h-5';
	}

	?>
	<div class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
		<div class="grid grid-cols-1 lg:grid-cols-<?php echo esc_attr( $repeater_count ); ?> <?php echo $repeater_count > 1 ? 'gap-6' : ''; ?>">
			<?php
			foreach ( $repeater as $key => $value ) :
				$image   = $value['image'];
				$title   = $value['title'];
				$content = $value['content'];
				$button  = $value['button'];
				?>

				<div class="group relative">

					<div class="relative aspect-w-4 aspect-h-5 md:aspect-w-1 md:aspect-h-1 <?php echo $block_ratio; ?>">

						<?php if ( $button ) { ?>
							<a class="no-underline" href="<?php echo esc_attr( $button['url'] ); ?>">
							<?php } ?>
							<?php if ( $image ) { ?>
								<figure class="overflow-hidden aspect-w-4 aspect-h-5 md:aspect-w-1 md:aspect-h-1 <?php echo $block_ratio; ?>">
									<img class="object-cover <?php echo $button ? 'transition duration-500 transform-gpu group-hover:scale-105' : ''; ?>" srcset="<?php echo esc_attr( $image['sizes']['1-1-small'] ); ?> 480w,
												<?php echo esc_attr( $image['sizes']['16-9-medium'] ); ?> 900w,
												<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?> 1200w" sizes="(min-width: 1200px) 1200px,
												(min-width: 768px) 900px,
												100vh" src="<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?>" alt="" loading="lazy">
								</figure>
							<?php } ?>
							<?php if ( $button ) { ?>
							</a>
						<?php } ?>
					</div>

					<div class="absolute bottom-0 left-0 right-0 mb-6 <?php echo $repeater_count == 1 ? 'lg:mb-24' : ''; ?>">
						<div class="relative container">
							<div class="relative bg-quinary rounded-theme">
								<div class="container lg:flex lg:items-center lg:justify-between">
									<?php if ( $button ) { ?>
										<a class="no-underline" href="<?php echo esc_attr( $button['url'] ); ?>">
										<?php } ?>
										<div class="relative py-6 px-3">
											<?php if ( $title ) : ?>
												<div class="max-w-2xl md:max-w-lg">
													<h2 class="text-tertiary <?php echo $repeater_count > 1 ? 'md:text-2xl' : ''; ?>"><?php echo esc_attr( $title ); ?></h2>
												</div>
											<?php endif; ?>
											<?php if ( $content ) : ?>
												<div class="max-w-xl">
													<div class="max-w-full text-quaternary mt-3"><?php echo esc_attr( $content ); ?></div>
												</div>
											<?php endif; ?>
										</div>
										<?php if ( $button ) { ?>
										</a>
									<?php } ?>
									<?php if ( $repeater_count == 1 && $button ) : ?>
										<a class="hidden lg:inline-block lg:button lg:button--primary lg:button--large" href="<?php echo esc_attr( $button['url'] ); ?>"><?php echo esc_attr( $button['title'] ); ?> </a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>

				</div>

			<?php endforeach; ?>

		</div>

	</div>

	<?php
endif;
