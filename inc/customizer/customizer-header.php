<?php

/**
 * Add New Header Section : ground_section_header
 */
function ground_customizer_header( $wp_customize ) {

	$wp_customize->add_section(
		'ground_section_header',
		array(
			'title'       => __( 'Header', 'ground-admin' ),
			'description' => '',
			'priority'    => 40,
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
		'header_advice_primary',
		array(
			'type' => 'theme_mod',
		)
	);
	$wp_customize->add_setting(
		'header_advice_secondary',
		array(
			'type' => 'theme_mod',
		)
	);
	$wp_customize->add_setting(
		'header_advice_tertiary',
		array(
			'type' => 'theme_mod',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'header_type_control',
			array(
				'label'       => __( 'Select Header Type', 'ground-admin' ),
				'description' => __( 'Using this option you can change the Header', 'ground-admin' ),
				'settings'    => 'header_type',
				'priority'    => 10,
				'section'     => 'ground_section_header',
				'type'        => 'select',
				'choices'     => array(
					'menu'         => __( 'Simple', 'ground-admin' ),
					'menuCentered' => __( 'Simple with logo centered', 'ground-admin' ),
					'megaMenu'     => __( 'Mega', 'ground-admin' ),
					'custom'       => __( 'Custom', 'ground-admin' ),
				),
			)
		)
	);

	$wp_customize->add_setting(
		'header_advice_primary',
		array(
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'header_advice_primary',
		array(
			'type'    => 'textarea',
			'section' => 'ground_section_header',
			'label'   => __( 'Header advice primary', 'ground-admin' ),
		)
	);

	$wp_customize->add_setting(
		'header_advice_secondary',
		array(
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'header_advice_secondary',
		array(
			'type'    => 'textarea',
			'section' => 'ground_section_header',
			'label'   => __( 'Header advice secondary', 'ground-admin' ),
		)
	);

	$wp_customize->add_setting(
		'header_advice_tertiary',
		array(
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'header_advice_tertiary',
		array(
			'type'    => 'textarea',
			'section' => 'ground_section_header',
			'label'   => __( 'Header advice tertiary', 'ground-admin' ),
		)
	);
}

add_action( 'customize_register', 'ground_customizer_header' );
