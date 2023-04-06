<?php if (class_exists('ACF')) : ?>
	<?php
	if (is_tax('product_cat')) {
		$page_id = get_queried_object();
	} else {
		$page_id = wc_get_page_id('shop');
	}

	$category_highlights = get_field('category_highlights', $page_id);

	?>

	<div class="hero hero--full-width">
		<div class="hero__body">
			<?php
			if (is_tax('product_cat')) {
				$ground_cat   = get_queried_object();
				$thumbnail_id = get_term_meta($ground_cat->term_id, 'thumbnail_id', true);
			} elseif (is_tax('product_brand')) {
				$ground_cat      = get_queried_object();
				$thumbnail_image = get_field('image', $ground_cat);
				$thumbnail_id    = $thumbnail_image['id'];
			} else {
				$thumbnail_id = get_post_thumbnail_id(wc_get_page_id('shop'));
			}
			?>

			<?php if ($thumbnail_id) : ?>
				<img class="hero__image" loading="lazy" src="<?php echo wp_get_attachment_image_src($thumbnail_id, 'large')[0]; ?>">
				<div class="hero__image-filter" aria-hidden="true"></div>
			<?php endif; ?>

			<div class="hero__content text-tertiary container font-normal">
				<div class="grid grid-cols-12 gap-x-6">
					<div class="col-span-full lg:col-span-5">

						<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
							<h1 class="hero__title"><?php woocommerce_page_title(); ?></h1>
						<?php endif; ?>

					</div>

					<div class="col-span-full lg:col-start-6 lg:col-span-7">

						<div class="hero__excerpt">
							<?php
							if (function_exists('flrt_get_seo_data')) {
								$seoText = flrt_get_seo_data('text');
								if ($seoText) {
									$seoText = apply_filters('the_content', wp_kses_post($seoText));
									echo sprintf('<div class="wpc-page-seo-description">%s</div>', $seoText) . "\r\n";
								}
							} else {
								do_action('woocommerce_archive_description');
							}
							?>
						</div>
					</div>

				</div>
			</div>

		</div>

		<?php if ($category_highlights) : ?>
			<!-- safelist bug <div class="grid-cols-3"></div> -->
			<div class="hero__highlights">

				<div class="hero__cards grid grid-cols-3 gap-x-6">

					<?php
					foreach ($category_highlights as $category_highlight) :

						$title = $category_highlight['category_highlight_title'];
						$url   = $category_highlight['category_highlight_url'];
						$image = $category_highlight['category_highlight_image'];
					?>

						<?php if ($url) : ?>
							<a class="rounded-media overflow-hidden" href=" <?php echo esc_attr($url); ?>">
							<?php endif; ?>

							<div class="hero__card">

								<?php if ($image) : ?>
									<figure class="overflow-hidden aspect-w-16 aspect-h-9">
										<img class="hero__card-thumb <?php echo $url ? 'transition duration-500 transform-gpu group-hover:scale-105 cursor-pointer' : ''; ?>" srcset="<?php echo esc_attr($image['sizes']['16-9-small']); ?> 480w,
												<?php echo esc_attr($image['sizes']['16-9-medium']); ?> 900w,
												<?php echo esc_attr($image['sizes']['16-9-large']); ?> 1200w" sizes="(min-width: 1200px) 1200px,
												(min-width: 768px) 900px,
												100vh" src="<?php echo esc_attr($image['sizes']['16-9-large']); ?>" alt="" loading="lazy">
									</figure>
								<?php endif; ?>

								<?php if ($title) : ?>
									<div class="absolute bottom-0 left-0 right-0 p-6 z-2">
										<div class="max-w-2xl md:max-w-lg">
											<h2 class="text-base md:text-xl text-white lg:mb-2"><?php echo esc_attr($title); ?></h2>
										</div>
									</div>

									<div class="absolute inset-0 bg-gradient-to-t from-black opacity-80 rounded-none lg:rounded-media z-1"> </div>

								<?php endif; ?>
							</div>

							<?php if ($url) : ?>
							</a>
						<?php endif; ?>

					<?php endforeach; ?>

				</div>
			</div>

		<?php endif; ?>

	</div>
<?php endif;
