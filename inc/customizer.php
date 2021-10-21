<?php

/**
 * Add New Colors Section : ground_background_section
 */
function ground_theme_customizer( $wp_customize ) {

	/**
	 * Add New Section: ground_background_section
	 */
	// $wp_customize->add_section(
	// 'ground_background_section',
	// array(
	// 'title'       => __( 'Background', 'ground-admin' ),
	// 'description' => 'Set Colors For Background',
	// 'priority'    => '40',
	// )
	// );

	// /**
	// * Add Settings
	// */
	// $wp_customize->add_setting(
	// 'color_body_primary',
	// array(
	// 'default' => '#ffffff',
	// )
	// );

	// $wp_customize->add_setting(
	// 'color_body_secondary',
	// array(
	// 'default' => '#F4F4F5',
	// )
	// );

	// /**
	// * Add Controls
	// */
	// $wp_customize->add_control(
	// new WP_Customize_Color_Control(
	// $wp_customize,
	// 'color_body_primary',
	// array(
	// 'label'    => 'Color Body Primary',
	// 'section'  => 'ground_background_section',
	// 'settings' => 'color_body_primary',
	// )
	// )
	// );

	// $wp_customize->add_control(
	// new WP_Customize_Color_Control(
	// $wp_customize,
	// 'color_body_secondary',
	// array(
	// 'label'    => 'Color Body Secondary',
	// 'section'  => 'ground_background_section',
	// 'settings' => 'color_body_secondary',
	// )
	// )
	// );

	/**
	 * WOOCOMMERCE
	 */
	$wp_customize->add_setting(
		'shop_products_columns_mobile',
		array(
			'default'    => 'no',
			'type'       => 'option',
			'capability' => 'manage_woocommerce',
			// 'sanitize_callback'    => 'wc_bool_to_string',
			// 'sanitize_js_callback' => 'wc_string_to_bool',
		)
	);

	$wp_customize->add_control(
		'shop_products_columns_mobile',
		array(
			'label'       => 'Products per row (Mobile)',
			'description' => 'Optionally switch to a 1-column catalog on mobile',
			'section'     => 'woocommerce_product_catalog',
			'settings'    => 'shop_products_columns_mobile',
			'type'        => 'checkbox',
		)
	);

}

add_action( 'customize_register', 'ground_theme_customizer' );


/**
 * Generate theme options
 */
function ground_theme_customizer_generate_css() {

	$color_body_primary   = get_theme_mod( 'color_body_primary' );
	$color_body_secondary = get_theme_mod( 'color_body_secondary' );

	if ( ! empty( $color_body_primary ) ) : ?>
	<style type="text/css" id="ground-theme-option-css">
		.bg-body-primary, body {
			background: <?php echo $color_body_primary; ?>;
		} 
		.bg-body-secondary {
			background: <?php echo $color_body_secondary; ?>;
		}
	</style>
			<?php
	endif;

}

// add_action( 'wp_head', 'ground_theme_customizer_generate_css' );


// Test logo

// function site_logo( $wp_customize ) {
// Settings
// $wp_customize->add_setting( 'site_logo' );// Setting for logo uploader

// Controls
// $wp_customize->add_control(
// new WP_Customize_Image_Control(
// $wp_customize,
// 'site_logo',
// array(
// 'label'    => 'Upload a logo',
// 'section'  => 'title_tagline',
// 'settings' => 'site_logo',
// )
// )
// );
// }

// add_action( 'customize_register', 'site_logo' );
