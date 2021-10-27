<?php


/**
 * Add New Colors Section : ground_section_fonts
 */
function ground_customizer_header( $wp_customize ) {

	/**
	 * Add New Section: ground_section_header
	 */
	$wp_customize->add_section(
		'ground_section_header',
		array(
			'title'       => __( 'Header', 'ground-admin' ),
			'description' => '',
			'priority'    => '40',
			'capability'  => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting(
		'header_type',
		array(
			'default' => 'megaMenu',
			'type'    => 'theme_mod',
		)
	);

	$wp_customize->add_setting(
		'header_advice',
		array(
			'type' => 'theme_mod',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'header_type',
			array(
				'label'       => __( 'Select Header Type', 'parsmizban' ),
				'description' => __( 'Using this option you can change the Header' ),
				'settings'    => 'header_type',
				'priority'    => 10,
				'section'     => 'ground_section_header',
				'type'        => 'select',
				'choices'     => array(
					'menu'         => 'Simple menu',
					'menuCentered' => 'Simple menu - Logo centered',
					'megaMenu'     => 'Mega menu',
				),
			)
		)
	);

	$wp_customize->add_control(
		'header_advice',
		array(
			'type'        => 'text',
			'section'     => 'ground_section_header',
			'label'       => __( 'Header Advice', 'ground-admin' ),
			'description' => '',
		)
	);

}

add_action( 'customize_register', 'ground_customizer_header' );


/**
 * Add New Colors Section : ground_section_fonts
 */
function ground_customizer_fonts( $wp_customize ) {

	/**
	 * Add New Section: ground_section_fonts
	 */
	$wp_customize->add_section(
		'ground_section_fonts',
		array(
			'title'       => __( 'Fonts', 'ground-admin' ),
			'description' => 'Insert your Fonts here',
			'priority'    => '40',
			'capability'  => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting(
		'font_source_primary',
	);

	$wp_customize->add_setting(
		'font_family_primary',
	);

	$wp_customize->add_setting(
		'font_source_secondary',
	);

	$wp_customize->add_setting(
		'font_family_secondary',
	);

	$wp_customize->add_control(
		'font_source_primary',
		array(
			'type'        => 'textarea',
			'section'     => 'ground_section_fonts',
			'label'       => __( 'Font Source Primary' ),
			'description' => __( 'To embed a font, copy the source code here' ),
		)
	);

	$wp_customize->add_control(
		'font_family_primary',
		array(
			'type'        => 'text',
			'section'     => 'ground_section_fonts',
			'label'       => __( 'Font Family Primary' ),
			'description' => __( 'Example: Roboto' ),
		)
	);

	$wp_customize->add_control(
		'font_source_secondary',
		array(
			'type'        => 'textarea',
			'section'     => 'ground_section_fonts',
			'label'       => __( 'Font Source Secondary' ),
			'description' => __( 'To embed a font, copy the source code here' ),
		)
	);

	$wp_customize->add_control(
		'font_family_secondary',
		array(
			'type'        => 'text',
			'section'     => 'ground_section_fonts',
			'label'       => __( 'Font Family Secondary' ),
			'description' => __( 'Example: Playfair Display' ),
		)
	);

}

add_action( 'customize_register', 'ground_customizer_fonts' );

/**
 * Add New Colors Section : ground_section_colors
 */
function ground_customizer_colors( $wp_customize ) {

	/**
	 * Add New Section: ground_section_colors
	 */
	$wp_customize->add_section(
		'ground_section_colors',
		array(
			'title'       => __( 'Colors', 'ground-admin' ),
			'description' => 'Set Colors For Theme',
			'priority'    => '40',
			'capability'  => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting(
		'color_primary',
		array(
			'default' => '#6366F1',
		)
	);

	$wp_customize->add_setting(
		'color_secondary',
		array(
			'default' => '#14B8A6',
		)
	);

	$wp_customize->add_setting(
		'color_typo_primary',
		array(
			'default' => '#000000',
		)
	);

	$wp_customize->add_setting(
		'color_typo_secondary',
		array(
			'default' => '#71717A',
		)
	);

	$wp_customize->add_setting(
		'color_body_primary',
		array(
			'default' => '#ffffff',
		)
	);

	$wp_customize->add_setting(
		'color_body_secondary',
		array(
			'default' => '#F4F4F5',
		)
	);

	$wp_customize->add_setting(
		'color_line_primary',
		array(
			'default' => '#D4D4D8',
		)
	);

	$wp_customize->add_setting(
		'color_line_secondary',
		array(
			'default' => '#D4D4D8',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_primary',
			array(
				'label'    => 'Color Primary',
				'section'  => 'ground_section_colors',
				'settings' => 'color_primary',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_secondary',
			array(
				'label'    => 'Color Secondary',
				'section'  => 'ground_section_colors',
				'settings' => 'color_secondary',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_typo_primary',
			array(
				'label'    => 'Color Typo Primary',
				'section'  => 'ground_section_colors',
				'settings' => 'color_typo_primary',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_typo_secondary',
			array(
				'label'    => 'Color Typo Secondary',
				'section'  => 'ground_section_colors',
				'settings' => 'color_typo_secondary',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_body_primary',
			array(
				'label'    => 'Color Body Primary',
				'section'  => 'ground_section_colors',
				'settings' => 'color_body_primary',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_body_secondary',
			array(
				'label'    => 'Color Body Secondary',
				'section'  => 'ground_section_colors',
				'settings' => 'color_body_secondary',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_line_primary',
			array(
				'label'    => 'Color Line Primary',
				'section'  => 'ground_section_colors',
				'settings' => 'color_line_primary',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'color_line_secondary',
			array(
				'label'    => 'Color Line Secondary',
				'section'  => 'ground_section_colors',
				'settings' => 'color_line_secondary',
			)
		)
	);

}

add_action( 'customize_register', 'ground_customizer_colors' );



/**
 * Add New Socials Section : ground_section_socials
 */
function ground_customizer_socials( $wp_customize ) {

	/**
	 * Add New Section: ground_section_socials
	 */
	$wp_customize->add_section(
		'ground_section_socials',
		array(
			'title'       => __( 'Socials', 'ground-admin' ),
			'description' => 'Insert url of your social channels',
			'priority'    => '40',
			'capability'  => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting(
		'social_linkedin_url',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_setting(
		'social_facebook_url',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_setting(
		'social_twitter_url',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_setting(
		'social_instagram_url',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_setting(
		'social_youtube_url',
		array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		'social_linkedin_url',
		array(
			'type'        => 'url',
			'section'     => 'ground_section_socials',
			'label'       => __( 'Linkedin', 'ground-admin' ),
			'description' => '',
			'input_attrs' => array(
				'placeholder' => __( 'https://www.linkedin.com/...' ),
			),
		)
	);
	$wp_customize->add_control(
		'social_facebook_url',
		array(
			'type'        => 'url',
			'section'     => 'ground_section_socials',
			'label'       => __( 'Facebook', 'ground-admin' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'social_twitter_url',
		array(
			'type'        => 'url',
			'section'     => 'ground_section_socials',
			'label'       => __( 'Twitter', 'ground-admin' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'social_instagram_url',
		array(
			'type'        => 'url',
			'section'     => 'ground_section_socials',
			'label'       => __( 'Instagram', 'ground-admin' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'social_youtube_url',
		array(
			'type'        => 'url',
			'section'     => 'ground_section_socials',
			'label'       => __( 'Youtube', 'ground-admin' ),
			'description' => '',
		)
	);

}

add_action( 'customize_register', 'ground_customizer_socials' );







/**
 * Add New Controls for Woocommerce Sections
 */
function ground_customizer_shop( $wp_customize ) {

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

add_action( 'customize_register', 'ground_customizer_shop' );
