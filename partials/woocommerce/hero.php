<div class="hero">

	<div class="hero__body">

		<?php
		if ( is_product_category() ) {
			$ground_cat   = get_queried_object();
			$thumbnail_id = get_term_meta( $ground_cat->term_id, 'thumbnail_id', true );
			if ( $thumbnail_id ) { ?>
				<img class="hero__image" loading="lazy" src="<?php echo wp_get_attachment_image_src( $thumbnail_id, 'medium_large' )[0]; ?>">
				<div class="hero__image-filter" aria-hidden="true"></div>
				<?php
			}
		}
		?>

		<div class="hero__content">
			<div class="grid grid-cols-12 gap-x-6">
				<div class="col-span-full lg:col-span-3">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 class="color-typo-primary text-3xl font-bold py-3 lg:py-0"><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>
				</div>
				<div class="col-span-full lg:col-start-6 lg:col-span-7">			
					<div class="text-typo-primary text-base py-3 lg:py-0">
						<?php do_action( 'woocommerce_archive_description' ); ?>
					</div>
				</div>
			</div>		
		</div>

	</div>

	<?php
	$page_id             = get_queried_object();
	$category_highlights = get_field( 'category_highlights', $page_id );

	if ( $category_highlights ) :
		?>

	<div class="hero__highlights">

		<div class="hero__cards grid grid-cols-3 gap-x-6">

		<?php
		foreach ( $category_highlights as $category_highlight ) :

			$ground_title = $category_highlight['category_highlight_title'];
			$ground_url   = $category_highlight['category_highlight_url'];
			$ground_image = $category_highlight['category_highlight_image'];
			$ground_size  = '4-3-small'; // (thumbnail, medium, large, full or custom size)
			?>

			<div class="hero__card">
				<div class="hero__card-body">
					<?php if ( $ground_url ) : ?>
						<a href="<?php echo $ground_url; ?>">
					<?php endif; ?>
						<?php if ( $ground_image ) : ?>
							<img class="hero__card-thumb" src="<?php echo wp_get_attachment_image_src( $ground_image, $ground_size )[0]; ?>">
						<?php endif; ?>				
						<?php if ( $ground_title ) : ?>
							<h5 class="hero__card-text"><?php echo $ground_title; ?></h5>
						<?php endif; ?>
					<?php if ( $ground_url ) : ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php endif; ?>

</div>
