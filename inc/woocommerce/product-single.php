<?php
/**
 * Product single
 *
 * @package Ground
 */

function ground_woocommerce_add_gallery_support() {
	// add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );

	if ( GROUND_SHOP_PRODUCT_GALLERY_SLIDER == '1' ) {
		add_theme_support( 'wc-product-gallery-slider' );
	}
}

add_action( 'after_setup_theme', 'ground_woocommerce_add_gallery_support' );


/**
 * Change gallery image size
 */
add_filter(
	'woocommerce_gallery_image_size',
	function( $size ) {
		return 'medium_large';
	}
);

/**
 *  Change gallery thumbnail size
 */
add_filter(
	'woocommerce_gallery_thumbnail_size',
	function( $size ) {
		return 'thumbnail';
	}
);

/**
 * Add brand in product single
 */
function ground_woocommerce_add_brand_single_product() {
	global $post;
	echo '<h2 class="woocommerce-product-details__brand">' . get_the_term_list( $post->ID, 'pa_brand', '', ', ' ) . '</h2>';
}

// add_action('woocommerce_single_product_summary', 'ground_woocommerce_add_brand_single_product', 6);



/**
 * Remove single product tabs
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );




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
function ground_display_quantity_plus() { ?>
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
 * Plus Minus Quantity Buttons @ WooCommerce - 3 Trigger update quantity script
 */
function ground_add_cart_quantity_plus_minus() {

	if ( ! is_product() && ! is_cart() ) {
		return;
	}

	wc_enqueue_js(
		"$('form.cart,form.woocommerce-cart-form').on( 'click', 'button.plus, button.minus', function() {
         	var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         	var val = parseFloat(qty.val());
         	var max = parseFloat(qty.attr( 'max' ));
         	var min = parseFloat(qty.attr( 'min' ));
         	var step = parseFloat(qty.attr( 'step' ));
 
         	if ( $( this ).is( '.plus' ) ) {
            	if ( max && ( max <= val ) ) {
               		qty.val( max );
            	} else {
               		qty.val( val + step );
            	}
         	} else {
            	if ( min && ( min >= val ) ) {
               		qty.val( min );
            	} else if ( val > 1 ) {
               		qty.val( val - step );
            	}
         	}
      	});"
	);
}
add_action( 'wp_footer', 'ground_add_cart_quantity_plus_minus' );


/**
 * Add Page Relation in product details
 */
function ground_add_page_relation_below_product_summary() {
	?>

	<?php
	$shop_product_page_relation = get_field( 'shop_product_page_relation', 'option' );
	if ( $shop_product_page_relation ) :
		?>
	<div class="relative mt-9">
		<?php
		foreach ( $shop_product_page_relation as $page_relation ) :
			$permalink = get_permalink( $page_relation->ID );
			$title     = get_the_title( $page_relation->ID );
			?>
		<div>
			<a class="text-sm text-typo-secondary underline" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>


	<?php
}
add_action( 'woocommerce_single_product_summary', 'ground_add_page_relation_below_product_summary', 55 );







/**
 * Add custom field (REST editable)
 */
function ground_add_custom_tabs( $tabs ) {

	$tabs['ground_product_details'] = array(
		'label'  => __( 'Details', 'ground-admin' ),
		'target' => 'ground_product_details',
		'class'  => array(),
	);

	return $tabs;
}

add_filter( 'woocommerce_product_data_tabs', 'ground_add_custom_tabs' );


/**
 * Add Tab Details
 */
function ground_tab_ground_product_details() {
	echo '<div id="ground_product_details" class="panel woocommerce_options_panel">';
	echo '<div class="options_group">';

	woocommerce_wp_text_input(
		array(
			'id'          => 'product_video',
			'label'       => __( 'Video', 'ground-admin' ),
			'placeholder' => '',
			'desc_tip'    => 'false',
			'description' => __( 'String [product_video]', 'ground-admin' ),
		)
	);

	echo '</div>';
	echo '</div>';
}

add_action( 'woocommerce_product_data_panels', 'ground_tab_ground_product_details' );



/**
 * Save field
 */
function woocommerce_product_custom_field_fields_save( $post_id ) {

	$woocommerce_product_video = $_POST['product_video'];
	update_post_meta( $post_id, 'product_video', esc_attr( $woocommerce_product_video ) );

}

add_action( 'woocommerce_process_product_meta', 'woocommerce_product_custom_field_fields_save' );


/**
 * REST field
 */
add_action(
	'rest_api_init',
	function () {

		// TAB TASSONOMY

		register_rest_field(
			'product',
			'product_video',
			array(
				'get_callback'    => function ( $object, $field_name, $request ) {
					return get_post_meta( $object['id'], 'product_video', true );
				},
				'update_callback' => function ( $value, $object, $field_name ) {
					update_post_meta( $object->id, 'product_video', esc_attr( $value ) );
				},
				'schema'          => array(
					'description' => __( 'Name Vulgar', 'woocommerce' ),
					'type'        => 'string',
					'context'     => array( 'view', 'edit' ),
				),
			)
		);

	}
);


/**
 * Include single product additional info
 */
function ground_woocommerce_after_single_product_summary_info() {
	get_template_part( 'partials/woocommerce/content-single-product' );
};

add_action( 'woocommerce_after_single_product_summary', 'ground_woocommerce_after_single_product_summary_info', 10, 2 );
