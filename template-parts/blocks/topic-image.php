<?php
/**
 * Topic image block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$image     = get_field( 'image' );
$title     = get_field( 'title' );
$button    = get_field( 'button' );
$content   = get_field( 'content' );
$repeater  = get_field( 'repeater' );
$no_margin = get_field( 'no_margin' );
?>

<div class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
	<div class="pb-12 lg:pb-24 relative">

		<div class="absolute is-fullscreen top-0 left-0 w-full -z-10">
			<?php if ( $image ) { ?>
				<figure class="opacity-50 overflow-hidden aspect-w-3 aspect-h-4 lg:aspect-w-16 lg:aspect-h-9">
					<img class="object-cover" srcset="<?php echo esc_attr( $image['sizes']['1-1-small'] ); ?> 480w,
									<?php echo esc_attr( $image['sizes']['1-1-medium'] ); ?> 900w,
									<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?> 1200w" sizes="(min-width: 1200px) 1200px,
									(min-width: 768px) 900px,
									100vh" src="<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
				</figure>
			<?php } ?>
			<div class="absolute inset-0 bg-gradient-to-t from-quinary w-full h-full" aria-hidden="true"></div>
		</div>

		<?php if ( $title || $content || $repeater ) : ?>
			<div class="relative <?php echo $image ? 'pt-64' : ''; ?> ">

				<div class="container">
					<?php if ( $title ) : ?>
						<h2 class="text-3xl mb-3 lg:text-6xl lg:w-4/6 lg:mb-6"><?php echo $title; ?></h2>
					<?php endif; ?>

					<?php if ( $content ) : ?>
						<div class="mb-3 lg:w-3/6 lg:mb-6 text-quaternary"><?php echo $content; ?></div>
					<?php endif; ?>
				</div>

				<?php
				if ( $repeater ) :
					foreach ( $repeater as $row ) :
						$button      = $row['button'];
						$image       = $row['image'];
						$description = $row['description'];
						?>
						<?php if ( $button ) : ?>
							<a class="group block" href="<?php echo $button['url']; ?>">
								<div class="flex justify-between items-center container border-septenary border-b">
									<div class="py-10">
										<h2 class="text-3xl lg:text-5xl"><?php echo $button['title']; ?></h2>
										<?php if ( $description ) : ?>
											<div class="text-quaternary pt-3 lg:pt-6"><?php echo $description; ?></div>
										<?php endif; ?>
									</div>

									<div class="text-quaternary pt-3 lg:pt-6">
										<div class="icon-arrow-special transition duration-500 transform-gpu group-hover:-rotate-45"></div>
									</div>
								</div>

								<?php if ( $image ) { ?>
									<div class="opacity-0 pointer-events-none absolute overflow-hidden is-fullscreen top-0 left-0 w-full group-hover:opacity-100 -z-5">
										<figure class="bg-quinary transition duration-500 transform-gpu overflow-hidden aspect-w-3 aspect-h-4 -translate-y-6 lg:aspect-w-16 lg:aspect-h-9 group-hover:-translate-y-0">
											<img class="object-cover opacity-50" srcset="<?php echo esc_attr( $image['sizes']['1-1-small'] ); ?> 480w,
															<?php echo esc_attr( $image['sizes']['1-1-medium'] ); ?> 900w,
															<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?> 1200w" sizes="(min-width: 1200px) 1200px,
															(min-width: 768px) 900px,
															100vh" src="<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
										</figure>
										<div class="absolute inset-0 bg-gradient-to-t from-quinary w-full h-full z-1" aria-hidden="true"></div>
									</div>
								<?php } ?>
							</a>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

		<?php endif; ?>

	</div>
</div>
