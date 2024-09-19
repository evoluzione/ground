<?php

/**
 * Accordion block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$repeater       = get_field('repeater');
$repeater_count = count(get_field('repeater'));
$no_margin      = get_field('no_margin');

$block_id = $block['id'];
?>


<?php if ($repeater) : ?>
	<div class="ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> relative not-prose <?php echo esc_attr(ground_block_class($block)); ?>">

		<?php
		$counter = 0;
		foreach ($repeater as $row) :
			$counter++;
			$title   = $row['title'];
			$content = $row['content'];
		?>

			<?php if ($title) : ?>
				<div class="accordion accordion-<?php echo $counter . '-' . $block_id; ?>">
					<span class="accordion__head js-toggle" data-toggle-target=".accordion-<?php echo $counter . '-' . $block_id; ?>" data-toggle-class-name="is-accordion-open">
						<h4><?php echo $title; ?></h4>
						<?php if ($content) : ?>
							<span class="accordion__icon"></span>
						<?php endif; ?>
					</span>
					<?php if ($content) : ?>
						<div class="accordion__body">
							<div class="accordion__content">
								<?php echo $content; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>


		<?php endforeach ?>

	</div>

<?php
endif;
