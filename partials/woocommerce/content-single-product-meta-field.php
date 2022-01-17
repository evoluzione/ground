<?php
global $product;
$product_id            = get_the_ID();
$product_video         = get_post_meta($product_id, 'product_video', true);
$product_info_title1   = get_post_meta($product_id, 'product_info_title1', true);
$product_info_title2   = get_post_meta($product_id, 'product_info_title2', true);
$product_info_title3   = get_post_meta($product_id, 'product_info_title3', true);
$product_info_content1 = get_post_meta($product_id, 'product_info_content1', true);
$product_info_content2 = get_post_meta($product_id, 'product_info_content2', true);
$product_info_content3 = get_post_meta($product_id, 'product_info_content3', true);
?>

<?php if (!empty(get_the_content() || $product_video)) : ?>

	<div class="relative my-16 bg-body-secondary py-6 px-6 lg:py-12 lg:px-0 transform -translate-x-2/4 w-screen ml-1/2 lg:rounded-theme lg:ml-0 lg:translate-x-0 lg:w-auto">

		<?php if (!empty(get_the_content())) : ?>
			<div class="grid grid-cols-12 gap-6 pt-3 pb-6 lg:py-12">
				<div class="col-span-full lg:col-start-2 lg:col-span-3">
					<h4><?php _e('Product specifications', 'ground'); ?></h4>
				</div>
				<div class="col-span-full lg:col-start-7 lg:col-span-5">
					<div class="text-quaternary text-base">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($product_video) : ?>
			<div class="grid grid-cols-12 gap-6 lg:py-12">
				<div class="col-span-full lg:col-start-2 lg:col-span-10">
					<?php
					$product_video_iframe = apply_filters('the_content', $product_video);
					echo $product_video_iframe;
					?>
				</div>
			</div>
		<?php endif; ?>

	</div>

<?php endif; ?>


<?php
/**
 * Hook: ground_product_attributes.
 */
do_action('ground_product_attributes');
?>


<?php
if ($product_info_title1 || $product_info_title2 || $product_info_title3) :;
?>


	<div class="grid grid-cols-12 gap-6 my-16">
		<div class="col-span-full lg:col-start-2 lg:col-end-12">

			<h4 class="mb-9"><?php _e('Technical info', 'ground'); ?></h4>

			<?php if ($product_info_title1) : ?>

				<div class="accordion accordion-1">
					<span class="accordion__head js-toggle" data-toggle-target=".accordion-1" data-toggle-class-name="is-accordion-open">
						<?php echo $product_info_title1; ?> jdhsgf jdshgfjdhsgfjdshgfhsdgfjhsdgf jh gjfsg djfgs jg jg
						<?php if ($product_info_content1) : ?>
							<span class="accordion__icon"></span>
						<?php endif; ?>
					</span>
					<?php if ($product_info_content1) : ?>
						<div class="accordion__body">
							<div class="accordion__content">
								<?php echo $product_info_content1; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>

			<?php endif; ?>

			<?php if ($product_info_title2) : ?>

				<div class="accordion accordion-2">
					<span class="accordion__head js-toggle" data-toggle-target=".accordion-2" data-toggle-class-name="is-accordion-open">
						<?php echo $product_info_title2; ?>
						<?php if ($product_info_content2) : ?>
							<span class="accordion__icon"></span>
						<?php endif; ?>
					</span>
					<?php if ($product_info_content2) : ?>
						<div class="accordion__body">
							<div class="accordion__content">
								<?php echo $product_info_content2; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>

			<?php endif; ?>

			<?php if ($product_info_title3) : ?>

				<div class="accordion accordion-3">
					<span class="accordion__head js-toggle" data-toggle-target=".accordion-3" data-toggle-class-name="is-accordion-open">
						<?php echo $product_info_title3; ?>
						<?php if ($product_info_content3) : ?>
							<span class="accordion__icon"></span>
						<?php endif; ?>
					</span>
					<?php if ($product_info_content3) : ?>
						<div class="accordion__body">
							<div class="accordion__content">
								<?php echo $product_info_content3; ?>
							</div>
						</div>
					<?php endif; ?>
				</div>

			<?php endif; ?>

		</div>
	</div>

<?php endif; ?>