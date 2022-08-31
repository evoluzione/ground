<?php

/**
 * Products loop
 *
 * @package Ground
 */

/**
 *  Remove add to cart button in product loop
 */
function ground_woocommerce_remove_addtocart_button( $array ) {
	if ( GROUND_SHOP_REMOVE_ADD_TO_CART == 1 ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	}
};

add_action( 'wp_head', 'ground_woocommerce_remove_addtocart_button', 10, 1 );


/**
 * Add term attribute in product loop
 */
function ground_woocommerce_add_product_loop_term() {
	global $product;
	$product_id    = $product->get_id();
	$product_terms = wc_get_product_terms(
		$product_id,
		'product_cat',
		array( 'fields' => 'all' )
	); // For attribute use "pa_nameofattribute.

	if ( count( $product_terms ) ) {
		echo '<div class="product__terms">';
		foreach ( $product_terms as $term ) {
			$term_name = "$term->name";
			if ( next( $product_terms ) == true ) {
				$term_name .= ',';
			}
			echo $term_name;
		}
		echo '</div>';
	}
}

// add_action( 'woocommerce_after_shop_loop_item_title', 'ground_woocommerce_add_product_loop_term', 9 );

/**
 * Remove, Rename, Reorder or Add Custom Sorting Options
 *
 * @param [type] $options
 * @return void
 */
function ground_woocommerce_customize_product_sorting( $options ) {
	$options = array(
		'menu_order' => __( 'Default sorting', 'woocommerce' ),
		'popularity' => __( 'Sort by popularity', 'woocommerce' ),
		'rating'     => __( 'Sort by average rating', 'woocommerce' ),
		'date'       => __( 'Sort by newness', 'woocommerce' ),
		'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
		'price-desc' => __( 'Sort by price: high to low', 'woocommerce' ),
	);

	// unset( $options[ 'popularity' ] );
	// unset( $options[ 'menu_order' ] );
	// unset( $options[ 'rating' ] );
	// unset( $options[ 'date' ] );
	// unset( $options[ 'price' ] );
	// unset( $options[ 'price-desc' ] );

	return $options;
}

// add_filter('woocommerce_catalog_orderby', 'ground_woocommerce_customize_product_sorting');

/**
 * Remove product sorting dropdown
 */
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
// remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );

/**
 * Remove result count
 */
// remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );


/**
 * WooCommerce, Add Short Description to Products on Shop Page
 */
function ground_add_short_description_to_product_loop() {
	global $product;
	if ( $product->get_short_description() ) : ?>
		<div class="woocommerce-loop-product__description">
			<?php echo substr( ucfirst( strtolower( strip_tags( $product->get_short_description() ) ) ), 0, 100 ) . '...'; ?>
		</div>
		<?php
	endif;
}
add_action( 'woocommerce_after_shop_loop_item_title', 'ground_add_short_description_to_product_loop', 2 );


/**
 * WooCommerce, Remove woocommerce_catalog_ordering
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


/**
 * WooCommerce, Refactoring filters_buttons + WC_Widget_Layered_Nav_Filters
 */
function ground_archive_filters_buttons() {
	?>

	<div class="sticky top-16 bg-quinary border-b border-septenary z-20 transform -translate-x-2/4 w-screen ml-1/2 lg:relative lg:bg-transparent lg:ml-auto lg:translate-x-0 lg:w-auto lg:border-0 lg:top-0">
		<div class="container px-0 overflow-hidden">
			<div class="flex flex-wrap pt-3 lg:pt-0">
				<div class="w-1/2 gap-6 lg:w-2/3 pb-3 lg:pb-0 pl-3 lg:pl-0">
					<?php if ( is_active_sidebar( 'sidebar-woocommerce' ) ) : ?>
					<button class="button button--small button--bordered button--full-width block lg:hidden js-toggle" data-toggle-target="#overlay-panel-filter-woocommerce-advanced html" data-toggle-class-name="is-overlay-panel-open">
						<?php ground_icon( 'options', 'button__icon w-6 h-6' ); ?> <?php _e( 'Filters', 'ground' ); ?>
					</button>
					<?php endif; ?>
				</div>
				<div class="w-1/2 lg:w-1/3 pb-3 pl-3 pr-3 lg:pr-0">
					<?php $result = woocommerce_catalog_ordering(); ?>
				</div>
				<div class="w-full col-span-full lg:order-first">

					<?php
					if ( is_plugin_active( 'facetwp/index.php' ) ) {
						echo do_shortcode( '[facetwp selections="true"] ' );
					} else {
						the_widget( 'WC_Widget_Layered_Nav_Filters' );
					}
					?>
					
				</div>
			</div>
		</div>
	</div>

	<?php
}

add_action( 'woocommerce_before_shop_loop', 'ground_archive_filters_buttons', 10 );


/**
 * WooCommerce, Add Sidebar Woocommerce
 */
function ground_add_sidebar_woocommerce() {
	if ( is_active_sidebar( 'sidebar-woocommerce' ) ) :
		?>

		<div class="sidebar sidebar--woocommerce hidden lg:block">
			<div class="sidebar__body">
				<?php dynamic_sidebar( 'sidebar-woocommerce' ); ?>
				<?php if ( is_active_sidebar( 'sidebar-woocommerce-advanced' ) ) : ?>
					<div class="button button--bordered w-full js-toggle" data-toggle-target="#overlay-panel-filter-woocommerce-advanced html" data-toggle-class-name="is-overlay-panel-open"><?php ground_icon( 'options', 'button__icon' ); ?> <?php _e( 'Advanced Filters', 'ground' ); ?></div>
				<?php endif; ?>
			</div>
			<div class="sidebar__close js-toggle" data-toggle-target=".sidebar--woocommerce html" data-toggle-class-name="is-sidebar-open"><?php ground_icon( 'close' ); ?></div>
		</div>

		<?php
	endif;
}

add_action( 'woocommerce_sidebar', 'ground_add_sidebar_woocommerce', 10 );


/**
 * WooCommerce, Add Sidebar Woocommerce Advanced
 */
function ground_add_sidebar_woocommerce_advanced() {
	if ( is_active_sidebar( 'sidebar-woocommerce-advanced' ) ) :
		?>

		<div class="overlay-panel overlay-panel--from-left" id="overlay-panel-filter-woocommerce-advanced">
			<div class="overlay-panel__mask js-toggle" data-toggle-target="#overlay-panel-filter-woocommerce-advanced html" data-toggle-class-name="is-overlay-panel-open"></div>
			<div class="overlay-panel__body">
				<div class="overlay-panel__close js-toggle" data-toggle-target="#overlay-panel-filter-woocommerce-advanced html" data-toggle-class-name="is-overlay-panel-open">
					<?php ground_icon( 'close' ); ?>
				</div>
				<div class="overlay-panel__content p-6 lg:p-12">
					<?php
					if ( is_plugin_active( 'facetwp/index.php' ) ) {
						echo do_shortcode( '[facetwp selections="true"] ' );
					}
					?>
					<div class="block lg:hidden">
						<?php dynamic_sidebar( 'sidebar-woocommerce' ); ?>
					</div>
					<?php dynamic_sidebar( 'sidebar-woocommerce-advanced' ); ?>
				</div>
			</div>
		</div>


		<?php
	endif;
}

add_action( 'woocommerce_sidebar', 'ground_add_sidebar_woocommerce_advanced', 10 );



/**
 * WooCommerce, Add Additional image change on hover on Product Loop
 */
function ground_add_on_hover_shop_loop_image() {
	$product = wc_get_product( get_the_ID() );

	$image_id = $product->get_gallery_image_ids();

	if ( $image_id ) {
		?>

		<div class="woocommerce-loop-product__additional-image">
			<?php echo wp_get_attachment_image( $image_id[0], 'woocommerce_thumbnail' ); ?>
		</div>

		<?php
	}
}

add_action( 'woocommerce_before_shop_loop_item_title', 'ground_add_on_hover_shop_loop_image' );


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );


/**
 * WooCommerce, Add Product label container
 */
function ground_product_loop_sale_flash() {
	?>

	<div class="woocommerce-loop-product__label">
		<?php
		/**
		 * Hook: ground_sale_flash.
		 *
		 * @ ground_show_sale_percentage - 25
		 * @ ground_show_not_purchasable_label - 30
		 */
		do_action( 'ground_sale_flash' );
		?>
	</div>

	<?php

}

add_action( 'woocommerce_before_shop_loop_item_title', 'ground_product_loop_sale_flash' );



/**
 * Display Discount Percentage @ Loop Pages - WooCommerce
 */
function ground_show_sale_percentage() {
	global $product;
	if ( ! $product->is_on_sale() ) {
		return;
	}
	$max_percentage = true;
	if ( $product->is_type( 'simple' ) ) {
		$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
	} elseif ( $product->is_type( 'variable' ) ) {
		$max_percentage = 0;
		foreach ( $product->get_children() as $child_id ) {
			$variation  = wc_get_product( $child_id );
			$price      = $variation->get_regular_price();
			$sale       = $variation->get_sale_price();
			$percentage = true;
			if ( $price != 0 && ! empty( $sale ) ) {
				$percentage = ( $price - $sale ) / $price * 100;
			}
			if ( $percentage > $max_percentage ) {
				$max_percentage = $percentage;
			}
		}
	}
	if ( $max_percentage > 0 ) {
		?>
		<div class='onsale'><span class="onsale__label"> <?php _e( 'Sale!', 'woocommerce' ); ?> </span> <span class="onsale__percentage">-<?php echo round( $max_percentage ); ?>%</span></div>
		<?php
	}
}

add_action( 'ground_sale_flash', 'ground_show_sale_percentage', 25 );



/**
 * Display hero on woocommerce archive
 */
function ground_add_shop_hero() {
	if ( ! is_search() && is_post_type_archive( 'product' ) && in_array( absint( get_query_var( 'paged' ) ), array( 0, 1 ), true ) ) {

		$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : 0;
		$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : 0;

		if ( 0 < count( WC_Query::get_layered_nav_chosen_attributes() ) || 0 < $min_price || 0 < $max_price ) {
			// Ci sono filtri attivi
			// get_template_part( 'template-parts/woocommerce/hero' );
		} else {
			get_template_part( 'template-parts/woocommerce/hero' );
		}
	}
}

add_action( 'woocommerce_before_main_content', 'ground_add_shop_hero', 20 );
