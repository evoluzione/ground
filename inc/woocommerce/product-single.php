<?php

/**
 * Product single
 *
 * @package Ground
 */

function ground_woocommerce_add_gallery_support()
{
	// add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support('wc-product-gallery-lightbox');
	// add_theme_support( 'wc-product-gallery-slider' );
}

add_action('after_setup_theme', 'ground_woocommerce_add_gallery_support');


/**
 * Change gallery image size
 */
// add_filter(
// 'woocommerce_gallery_image_size',
// function( $size ) {
// return 'medium_large';
// }
// );

/**
 *  Change gallery thumbnail size
 */
add_filter(
	'woocommerce_gallery_thumbnail_size',
	function ($size) {
		return 'woocommerce_thumbnail';
	}
);

/**
 * Add brand in product single
 */
function ground_woocommerce_add_brand_single_product()
{
	global $post;
	echo '<h2 class="woocommerce-product-details__brand">' . get_the_term_list($post->ID, 'pa_brand', '', ', ') . '</h2>';
}

// add_action('woocommerce_single_product_summary', 'ground_woocommerce_add_brand_single_product', 6);



/**
 * Remove single product tabs
 */
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);


/**
 * Add "Product Attributes" after single product summary
 */

function ground_product_attributes_after_summary()
{
	global $product;

	if ($product && ($product->has_attributes() || apply_filters('wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions()))) { ?>
		<div class="relative my-12 lg:my-24">
			<div class="grid grid-cols-12 gap-6">
				<div class="col-span-full">
					<?php wc_display_product_attributes($product); ?>
				</div>
			</div>
		</div>

	<?php
	}
}

add_action('ground_product_attributes', 'ground_product_attributes_after_summary', 10);

/**
 * Reordering woocommerce_template_single_meta
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5);



/**
 * Reordering woocommerce_template_single_excerpt
 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6);





/**
 * Plus Minus Quantity Buttons @ WooCommerce - 1 Add Plus
 */
function ground_display_quantity_plus()
{
	?>
	<button type="button" class="plus"><?php ground_icon('math-plus'); ?></button>
<?php
}
add_action('woocommerce_after_quantity_input_field', 'ground_display_quantity_plus');

/**
 * Plus Minus Quantity Buttons @ WooCommerce - 2 Add Minus
 */
function ground_display_quantity_minus()
{
?>
	<button type="button" class="minus"><?php ground_icon('math-minus'); ?></button>
	<?php
}
add_action('woocommerce_before_quantity_input_field', 'ground_display_quantity_minus');


/**
 * Add Page Relation in product details
 */
function ground_add_page_relation_below_product_summary()
{

	if (GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1 || GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2 || GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3) :
	?>

		<div class="relative mt-9">

			<?php if (GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1) : ?>
				<div>
					<a class="text-sm text-quaternary underline" href="<?php echo esc_html(get_permalink(GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1)); ?>"><?php echo esc_html(get_the_title(GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1)); ?></a>
				</div>
			<?php endif; ?>

			<?php if (GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2) : ?>
				<div>
					<a class="text-sm text-quaternary underline" href="<?php echo esc_html(get_permalink(GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2)); ?>"><?php echo esc_html(get_the_title(GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2)); ?></a>
				</div>
			<?php endif; ?>

			<?php if (GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3) : ?>
				<div>
					<a class="text-sm text-quaternary underline" href="<?php echo esc_html(get_permalink(GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3)); ?>"><?php echo esc_html(get_the_title(GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3)); ?></a>
				</div>
			<?php endif; ?>

		</div>

<?php

	endif;
}

add_action('woocommerce_single_product_summary', 'ground_add_page_relation_below_product_summary', 55);


// TO DO:
// è stato commentata temporaneamente la parte di codice sottostante che registra i metafiel all'interno del prodotto Woocommerce in quanto si sta testando l'utilizzo di gutemberg anche per il prodotto Woocommerce

/**
 * Add custom field (REST editable)
 */
// function ground_add_custom_tabs( $tabs ) {

// $tabs['ground_product_details'] = array(
// 'label'  => __( 'Details', 'ground-admin' ),
// 'target' => 'ground_product_details',
// 'class'  => array(),
// );

// return $tabs;
// }

// add_filter( 'woocommerce_product_data_tabs', 'ground_add_custom_tabs' );


// /**
// * Add Tab Details
// */
// function ground_tab_ground_product_details() {
// echo '<div id="ground_product_details" class="panel woocommerce_options_panel">';
// echo '<div class="options_group">';

// woocommerce_wp_text_input(
// array(
// 'id'          => 'product_video',
// 'label'       => __( 'Video', 'ground-admin' ),
// 'placeholder' => 'Insert video URL',
// 'desc_tip'    => 'false',
// 'description' => __( 'String [product_video]', 'ground-admin' ),
// ),
// );

// echo '</div>';

// echo '<div class="options_group">';

// woocommerce_wp_text_input(
// array(
// 'id'          => 'product_info_title1',
// 'label'       => __( 'Info Title', 'ground-admin' ),
// 'placeholder' => '',
// 'desc_tip'    => 'false',
// 'description' => __( 'String [product_info_title1]', 'ground-admin' ),
// ),
// );
// woocommerce_wp_textarea_input(
// array(
// 'id'          => 'product_info_content1',
// 'label'       => __( 'Info Content', 'ground-admin' ),
// 'placeholder' => '',
// 'desc_tip'    => 'false',
// 'description' => __( 'String [product_info_content1]', 'ground-admin' ),
// ),
// );

// echo '</div>';

// echo '<div class="options_group">';

// woocommerce_wp_text_input(
// array(
// 'id'          => 'product_info_title2',
// 'label'       => __( 'Info Title', 'ground-admin' ),
// 'placeholder' => '',
// 'desc_tip'    => 'false',
// 'description' => __( 'String [product_info_title2]', 'ground-admin' ),
// ),
// );
// woocommerce_wp_textarea_input(
// array(
// 'id'          => 'product_info_content2',
// 'label'       => __( 'Info Content', 'ground-admin' ),
// 'placeholder' => '',
// 'desc_tip'    => 'false',
// 'description' => __( 'String [product_info_content2]', 'ground-admin' ),
// ),
// );

// echo '</div>';

// echo '<div class="options_group">';

// woocommerce_wp_text_input(
// array(
// 'id'          => 'product_info_title3',
// 'label'       => __( 'Info Title', 'ground-admin' ),
// 'placeholder' => '',
// 'desc_tip'    => 'false',
// 'description' => __( 'String [product_info_title3]', 'ground-admin' ),
// ),
// );
// woocommerce_wp_textarea_input(
// array(
// 'id'          => 'product_info_content3',
// 'label'       => __( 'Info Content', 'ground-admin' ),
// 'placeholder' => '',
// 'desc_tip'    => 'false',
// 'description' => __( 'String [product_info_content3]', 'ground-admin' ),
// ),
// );

// echo '</div>';

// echo '</div>';
// }

// add_action( 'woocommerce_product_data_panels', 'ground_tab_ground_product_details' );



// /**
// * Save field
// */
// function woocommerce_product_custom_field_fields_save( $post_id ) {

// $woocommerce_product_video = $_POST['product_video'];
// update_post_meta( $post_id, 'product_video', esc_attr( $woocommerce_product_video ) );
// $woocommerce_product_info_title1 = $_POST['product_info_title1'];
// update_post_meta( $post_id, 'product_info_title1', esc_attr( $woocommerce_product_info_title1 ) );
// $woocommerce_product_info_content1 = $_POST['product_info_content1'];
// update_post_meta( $post_id, 'product_info_content1', esc_attr( $woocommerce_product_info_content1 ) );
// $woocommerce_product_info_title2 = $_POST['product_info_title2'];
// update_post_meta( $post_id, 'product_info_title2', esc_attr( $woocommerce_product_info_title2 ) );
// $woocommerce_product_info_content2 = $_POST['product_info_content2'];
// update_post_meta( $post_id, 'product_info_content2', esc_attr( $woocommerce_product_info_content2 ) );
// $woocommerce_product_info_title3 = $_POST['product_info_title3'];
// update_post_meta( $post_id, 'product_info_title3', esc_attr( $woocommerce_product_info_title3 ) );
// $woocommerce_product_info_content3 = $_POST['product_info_content3'];
// update_post_meta( $post_id, 'product_info_content3', esc_attr( $woocommerce_product_info_content3 ) );

// }

// add_action( 'woocommerce_process_product_meta', 'woocommerce_product_custom_field_fields_save' );


// /**
// * REST field
// */
// add_action(
// 'rest_api_init',
// function () {

// register_rest_field(
// 'product',
// 'product_video',
// array(
// 'get_callback'    => function ( $object, $field_name, $request ) {
// return get_post_meta( $object['id'], 'product_video', true );
// },
// 'update_callback' => function ( $value, $object, $field_name ) {
// update_post_meta( $object->id, 'product_video', esc_attr( $value ) );
// },
// 'schema'          => array(
// 'description' => __( 'Product Video', 'woocommerce' ),
// 'type'        => 'string',
// 'context'     => array( 'view', 'edit' ),
// ),
// )
// );

// register_rest_field(
// 'product',
// 'product_info_title1',
// array(
// 'get_callback'    => function ( $object, $field_name, $request ) {
// return get_post_meta( $object['id'], 'product_info_title1', true );
// },
// 'update_callback' => function ( $value, $object, $field_name ) {
// update_post_meta( $object->id, 'product_info_title1', esc_attr( $value ) );
// },
// 'schema'          => array(
// 'description' => __( 'Product Info Title1', 'woocommerce' ),
// 'type'        => 'string',
// 'context'     => array( 'view', 'edit' ),
// ),
// )
// );

// register_rest_field(
// 'product',
// 'product_info_content1',
// array(
// 'get_callback'    => function ( $object, $field_name, $request ) {
// return get_post_meta( $object['id'], 'product_info_content1', true );
// },
// 'update_callback' => function ( $value, $object, $field_name ) {
// update_post_meta( $object->id, 'product_info_content1', esc_attr( $value ) );
// },
// 'schema'          => array(
// 'description' => __( 'Product Info Content1', 'woocommerce' ),
// 'type'        => 'string',
// 'context'     => array( 'view', 'edit' ),
// ),
// )
// );

// register_rest_field(
// 'product',
// 'product_info_title2',
// array(
// 'get_callback'    => function ( $object, $field_name, $request ) {
// return get_post_meta( $object['id'], 'product_info_title2', true );
// },
// 'update_callback' => function ( $value, $object, $field_name ) {
// update_post_meta( $object->id, 'product_info_title2', esc_attr( $value ) );
// },
// 'schema'          => array(
// 'description' => __( 'Product Info Title2', 'woocommerce' ),
// 'type'        => 'string',
// 'context'     => array( 'view', 'edit' ),
// ),
// )
// );

// register_rest_field(
// 'product',
// 'product_info_content2',
// array(
// 'get_callback'    => function ( $object, $field_name, $request ) {
// return get_post_meta( $object['id'], 'product_info_content2', true );
// },
// 'update_callback' => function ( $value, $object, $field_name ) {
// update_post_meta( $object->id, 'product_info_content2', esc_attr( $value ) );
// },
// 'schema'          => array(
// 'description' => __( 'Product Info Content2', 'woocommerce' ),
// 'type'        => 'string',
// 'context'     => array( 'view', 'edit' ),
// ),
// )
// );

// register_rest_field(
// 'product',
// 'product_info_title3',
// array(
// 'get_callback'    => function ( $object, $field_name, $request ) {
// return get_post_meta( $object['id'], 'product_info_title3', true );
// },
// 'update_callback' => function ( $value, $object, $field_name ) {
// update_post_meta( $object->id, 'product_info_title3', esc_attr( $value ) );
// },
// 'schema'          => array(
// 'description' => __( 'Product Info Title3', 'woocommerce' ),
// 'type'        => 'string',
// 'context'     => array( 'view', 'edit' ),
// ),
// )
// );

// register_rest_field(
// 'product',
// 'product_info_content3',
// array(
// 'get_callback'    => function ( $object, $field_name, $request ) {
// return get_post_meta( $object['id'], 'product_info_content3', true );
// },
// 'update_callback' => function ( $value, $object, $field_name ) {
// update_post_meta( $object->id, 'product_info_content3', esc_attr( $value ) );
// },
// 'schema'          => array(
// 'description' => __( 'Product Info Content3', 'woocommerce' ),
// 'type'        => 'string',
// 'context'     => array( 'view', 'edit' ),
// ),
// )
// );

// }
// );


/**
 * Include single product additional info
 */
function ground_woocommerce_after_single_product_summary_info()
{
	get_template_part('partials/woocommerce/content-single-product');
};

add_action('woocommerce_after_single_product_summary', 'ground_woocommerce_after_single_product_summary_info', 10, 2);


/**
 * Add product brand single_product_summary
 */
function ground_woocommerce_add_product_brand_single_product_summary()
{
	global $post;
	echo get_the_term_list($post->ID, 'product_brand', '<span class="product_brand">Brand: ', ',<a>', '</a></span>');
}

add_action('woocommerce_product_meta_end', 'ground_woocommerce_add_product_brand_single_product_summary', 5);
