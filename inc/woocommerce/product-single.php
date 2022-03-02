<?php

/**
 * Product single
 *
 * @package Ground
 */

function ground_woocommerce_add_gallery_support() {
	 // add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	// add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'ground_woocommerce_add_gallery_support' );

/**
 *  Change gallery thumbnail size
 */
add_filter(
	'woocommerce_gallery_thumbnail_size',
	function ( $size ) {
		return 'woocommerce_thumbnail';
	}
);

/**
 * Remove single product tabs
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

/**
 * Add "Product Attributes" after single product summary
 */
function ground_product_attributes_after_summary() {
	global $product;

	if ( $product && ( $product->has_attributes() || apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() ) ) ) { ?>
		<div class="relative my-12 lg:my-24">
			<div class="grid grid-cols-12 gap-6">
				<div class="col-span-full">
					<?php wc_display_product_attributes( $product ); ?>
				</div>
			</div>
		</div>

		<?php
	}
}

add_action( 'woocommerce_after_single_product_summary', 'ground_product_attributes_after_summary', 5 );

/**
 * Reordering woocommerce_template_single_meta
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );

/**
 * Reordering woocommerce_template_single_excerpt
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );

/**
 * Plus Minus Quantity Buttons @ WooCommerce - 1 Add Plus
 */
function ground_display_quantity_plus() {
	?>
	<button type="button" class="plus"><?php ground_icon( 'math-plus' ); ?></button>
	<?php
}
add_action( 'woocommerce_after_quantity_input_field', 'ground_display_quantity_plus' );

/**
 * Plus Minus Quantity Buttons @ WooCommerce - 2 Add Minus
 */
function ground_display_quantity_minus() {
	?>
	<button type="button" class="minus"><?php ground_icon( 'math-minus' ); ?></button>
	<?php
}
add_action( 'woocommerce_before_quantity_input_field', 'ground_display_quantity_minus' );


/**
 * Add Page Relation in product details
 */
function ground_add_page_relation_below_product_summary() {
	if ( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1 || GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2 || GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3 ) :
		?>

		<div class="relative mt-9">

			<?php if ( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1 ) : ?>
				<div>
					<a class="text-sm text-quaternary underline" href="<?php echo esc_html( get_permalink( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1 ) ); ?>"><?php echo esc_html( get_the_title( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1 ) ); ?></a>
				</div>
			<?php endif; ?>

			<?php if ( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2 ) : ?>
				<div>
					<a class="text-sm text-quaternary underline" href="<?php echo esc_html( get_permalink( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2 ) ); ?>"><?php echo esc_html( get_the_title( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2 ) ); ?></a>
				</div>
			<?php endif; ?>

			<?php if ( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3 ) : ?>
				<div>
					<a class="text-sm text-quaternary underline" href="<?php echo esc_html( get_permalink( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3 ) ); ?>"><?php echo esc_html( get_the_title( GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3 ) ); ?></a>
				</div>
			<?php endif; ?>

		</div>

		<?php

	endif;
}

add_action( 'woocommerce_single_product_summary', 'ground_add_page_relation_below_product_summary', 55 );

/**
 * Include single product additional info
 */
function ground_woocommerce_after_single_product_summary_info() {
	?>
	<div class="prose">
		<?php the_content(); ?>
	</div>
	<?php
};

add_action( 'woocommerce_after_single_product_summary', 'ground_woocommerce_after_single_product_summary_info', 10, 2 );


/**
 * Add product brand single_product_summary
 */
function ground_woocommerce_add_product_brand_single_product_summary() {
	global $post;
	echo get_the_term_list( $post->ID, 'product_brand', '<span class="product_brand">Brand: ', ',<a>', '</a></span>' );
}

add_action( 'woocommerce_product_meta_end', 'ground_woocommerce_add_product_brand_single_product_summary', 5 );


/**
 * Add figure wrapped image product
 */
add_action(
	'woocommerce_before_shop_loop_item_title',
	function() {
		echo '<figure class="woocommerce-loop-product__figure overflow-hidden rounded-media">';
	},
	9
);
add_action(
	'woocommerce_before_shop_loop_item_title',
	function() {
		echo '</figure>';
	},
	11
);



