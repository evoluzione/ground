<?php
/**
 * Card block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$repeater       = get_field( 'repeater' );
$no_margin      = get_field( 'no_margin' );
$repeater_count = count( get_field( 'repeater' ) );

if ( $repeater_count == 1 ) {
	$class_ratio = 'lg:aspect-w-2 lg:aspect-h-1';
} elseif ( $repeater_count == 2 ) {
	$class_ratio = 'lg:aspect-w-1 lg:aspect-h-1';
} elseif ( $repeater_count == 3 ) {
	$class_ratio = 'lg:aspect-w-4 lg:aspect-h-5';
}

if ( $repeater ) : ?>

	<div class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">


		<div class="lg:grid lg:grid-flow-col lg:grid-cols-<?php echo $repeater_count; ?> lg:gap-6">

			<?php
			foreach ( $repeater as $row ) :

				// Vars
				$image   = $row['image'];
				$title   = $row['title'];
				$content = $row['content'];
				$button  = $row['button'];
				?>


				<div class="group relative mb-12 lg:mb-0">
					<div class="relative bg-gray-400 aspect-w-4 aspect-h-5 <?php echo $class_ratio; ?> rounded-media">

						<?php if ( $image ) { ?>
							<?php if ( $button ) { ?>
							<a class="no-underline" href="<?php echo $button['url']; ?>">
							<?php } ?>
								<figure class="overflow-hidden aspect-w-4 aspect-h-5 <?php echo $class_ratio; ?> rounded-media">
									<img class="object-cover <?php echo $button ? 'transition duration-500 transform-gpu group-hover:scale-105' : ''; ?>" srcset="<?php echo $image['sizes']['1-1-small']; ?> 480w,
													<?php echo $image['sizes']['1-1-medium']; ?> 900w,
													<?php echo $image['sizes']['16-9-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px,
													(min-width: 768px) 900px,
													100vh" src="<?php echo $image['sizes']['16-9-large']; ?>" alt="" loading="lazy">
								</figure>
							<?php if ( $button ) { ?>
							</a>
							<?php } ?>
						<?php } ?>
					</div>
					<?php if ( $title ) : ?>
						<h4 class="mt-6"><?php echo $title; ?></h4>
					<?php endif; ?>
					<?php if ( $content ) : ?>
						<p class="mt-3 text-quaternary"><?php echo $content; ?></p>
					<?php endif; ?>
					<!-- <?php if ( $button ) : ?>
							<a class="text-base text-primary font-secondary inline-block underline mt-6" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>
						<?php endif; ?> -->
				</div>


			<?php endforeach; ?>

		</div>


	</div>

	<?php
endif;
