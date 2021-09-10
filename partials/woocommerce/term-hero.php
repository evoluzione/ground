<div class="hero">

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

	<div class="hero__body">
		<div class="grid grid-cols-12 gap-x-6">
			<div class="col-span-full lg:col-start-2 lg:col-span-3">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="color-typo-primary text-3xl font-bold py-3 lg:py-0"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>
			</div>
			<div class="col-span-full lg:col-start-6 lg:col-span-6">			
				<div class="text-typo-primary text-base">
					<?php do_action( 'woocommerce_archive_description' ); ?>
				</div>
			</div>
		</div>
	</div>

</div>
