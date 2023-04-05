<?php

/**
 * Category
 *
 * @package Ground
 */

/**
 * Display category image on category archive
 */
function ground_woocommerce_category_image() {
	if ( is_product_category() ) {
		global $wp_query;
		$cat          = $wp_query->get_queried_object();
		$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image        = wp_get_attachment_url( $thumbnail_id );
		if ( $image ) {
			echo '<img src="' . $image . '" alt="' . $cat->name . '" />';
		}
	}
}

// add_action('woocommerce_before_main_content', 'ground_woocommerce_category_image', 30);


/**
 * Display term hero on category/attribute archive
 */
function ground_add_term_hero() {
	if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_tax( 'product_brand' ) || is_product_taxonomy() ) {

		$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : 0;
		$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : 0;

		if ( 0 < count( WC_Query::get_layered_nav_chosen_attributes() ) || 0 < $min_price || 0 < $max_price ) {
			// Ci sono filtri attivi
			get_template_part( 'template-parts/woocommerce/hero' );
		} else {
			get_template_part( 'template-parts/woocommerce/hero' );
		}
	}
}

add_action( 'woocommerce_before_main_content', 'ground_add_term_hero', 40 );

remove_action( 'ground_add_term_hero', 'woocommerce_before_main_content', 40 );


/**
 * Add Category Description
 */
function ground_add_category_description( $category ) {
	$cat_id      = $category->term_id;
	$prod_term   = get_term( $cat_id, 'product_cat' );
	$description = $prod_term->description;
	?>

	<?php if ( $description ) : ?>
		<p class="woocommerce-loop-category__description"><?php echo $description; ?></p>
		<?php
endif;
}

add_action( 'woocommerce_after_subcategory_title', 'ground_add_category_description', 12 );




/**
 * @snippet Add Body Class product-layout (grid/list)
 */
    
function ground_woocommerce_products_layout( $classes ){

    if (class_exists('ACF')) {
	    
        if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_tax( 'product_brand' ) || is_product_taxonomy() ) {
            $page_id = get_queried_object();    
            $products_layout = get_field('products_layout', $page_id);        
            if ($products_layout != 'default' ) { 
                $classes[] = 'product-layout-'.$products_layout;
            } else {
                $classes[] = 'product-layout-'.GROUND_SHOP_PRODUCTS_LAYOUT;
            }        
        } else if(is_shop()) {
            $classes[] = 'product-layout-'.GROUND_SHOP_PRODUCTS_LAYOUT;
        }
        
    }

    return $classes;

}

add_filter( 'body_class', 'ground_woocommerce_products_layout' );
