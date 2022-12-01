<?php

/**
 * Add New not_purchasable Section : ground_section_not_purchasable
 */
function ground_customizer_shop_not_purchasable( $wp_customize ) {

	/**
	 * Add New Section: ground_section_not_purchasable
	 */
	$wp_customize->add_section(
		'ground_section_not_purchasable',
		array(
			'title'       => __( 'Products Not Purchasable', 'ground' ),
			'description' => 'Insert url of your social channels',
			'priority'    => '15',
			'capability'  => 'edit_theme_options',
			'panel'       => 'woocommerce',

		)
	);

	$wp_customize->add_setting( 'shop_not_purchasable_product_button' );
	$wp_customize->add_setting( 'shop_not_purchasable_product_text' );
	$wp_customize->add_setting( 'shop_not_purchasable_product_cta' );

	$wp_customize->add_control(
		'shop_not_purchasable_product_button',
		array(
			'type'        => 'text',
			'section'     => 'ground_section_not_purchasable',
			'label'       => __( 'Product Button & Label', 'ground' ),
			'description' => __( 'Text visible on the archive page for each non-purchasable product', 'ground' ),
		)
	);

	$wp_customize->add_control(
		'shop_not_purchasable_product_text',
		array(
			'type'        => 'textarea',
			'section'     => 'ground_section_not_purchasable',
			'label'       => __( 'Single Product Message', 'ground' ),
			'description' => __( 'Text visible on the single product page', 'ground' ),
		)
	);

	$wp_customize->add_control(
		'shop_not_purchasable_product_cta_control',
		array(
			'label'       => 'Select Page',
			'description' => __( 'Button visible on the single product page', 'ground' ),
			'type'        => 'dropdown-pages',
			'section'     => 'ground_section_not_purchasable',
			'settings'    => 'shop_not_purchasable_product_cta',
		)
	);
}

add_action( 'customize_register', 'ground_customizer_shop_not_purchasable' );


/**
 * Add New Shop single product Section : ground_section_product_single
 */
function ground_customizer_shop_single_product( $wp_customize ) {

	/**
	 * Add New Section: ground_section_product_single
	 */
	$wp_customize->add_section(
		'ground_section_product_single',
		array(
			'title'       => __( 'Product Single', 'ground' ),
			'description' => __( 'Select the pages you want to show on the product page after the summary', 'ground' ),
			'priority'    => '15',
			'capability'  => 'edit_theme_options',
			'panel'       => 'woocommerce',

		)
	);

	$wp_customize->add_setting( 'shop_product_summary_page_1' );
	$wp_customize->add_setting( 'shop_product_summary_page_2' );
	$wp_customize->add_setting( 'shop_product_summary_page_3' );

	$wp_customize->add_control(
		'shop_product_summary_page_1_control',
		array(
			'label'    => 'Select Page',
			'type'     => 'dropdown-pages',
			'section'  => 'ground_section_product_single',
			'settings' => 'shop_product_summary_page_1',
		)
	);
	$wp_customize->add_control(
		'shop_product_summary_page_2_control',
		array(
			'label'    => 'Select Page',
			'type'     => 'dropdown-pages',
			'section'  => 'ground_section_product_single',
			'settings' => 'shop_product_summary_page_2',
		)
	);
	$wp_customize->add_control(
		'shop_product_summary_page_3_control',
		array(
			'label'    => 'Select Page',
			'type'     => 'dropdown-pages',
			'section'  => 'ground_section_product_single',
			'settings' => 'shop_product_summary_page_3',
		)
	);
}

add_action( 'customize_register', 'ground_customizer_shop_single_product' );


/**
 * Add New Controls for Woocommerce Sections
 */
function ground_customizer_shop( $wp_customize ) {

	$wp_customize->add_setting(
		'shop_products_columns_mobile',
		array(
			'default' => '',
			// 'sanitize_callback'    => 'wc_bool_to_string',
			// 'sanitize_js_callback' => 'wc_string_to_bool',
		)
	);

	$wp_customize->add_setting(
		'shop_remove_add_to_cart',
		array(
			'default' => '1',
		)
	);

	$wp_customize->add_control(
		'shop_remove_add_to_cart_control',
		array(
			'label'    => 'Remove Add to cart button',
			'type'     => 'checkbox',
			'section'  => 'woocommerce_product_catalog',
			'settings' => 'shop_remove_add_to_cart',
		)
	);

	$wp_customize->add_control(
		'shop_products_columns_mobile_control',
		array(
			'label'       => 'Products per row (Mobile)',
			'type'        => 'checkbox',
			'description' => 'Optionally switch to a 1-column catalog on mobile',
			'section'     => 'woocommerce_product_catalog',
			'settings'    => 'shop_products_columns_mobile',
		)
	);

	$wp_customize->add_setting( 'shop_order_comments_details' );

	$wp_customize->add_control(
		'shop_order_comments_details_control',
		array(
			'type'        => 'textarea',
			'section'     => 'woocommerce_checkout',
			'settings'    => 'shop_order_comments_details',
			'priority'    => 30,
			'label'       => __( 'Order Comments Details', 'ground' ),
			'description' => __( 'Add Order Comments Details', 'ground' ),
		)
	);
}

add_action( 'customize_register', 'ground_customizer_shop' );
