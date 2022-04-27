<?php


/**
 * Add New Settings Section : ground_section_settings
 */
function ground_customizer_settings( $wp_customize ) {

	/**
	 * Add New Section: ground_section_settings
	 */
	$wp_customize->add_section(
		'ground_section_settings',
		array(
			'title'       => __( 'Settings', 'ground' ),
			'description' => '',
			'priority'    => 46,
			'capability'  => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting(
		'container',
		array(
			'default' => 'container-boxed',
			'type'    => 'theme_mod',
		)
	);

	$wp_customize->add_setting(
		'rounded_theme',
		array(
			'default'           => '10',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_setting(
		'rounded_media',
		array(
			'default'           => '10',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'container_control',
			array(
				'label'       => __( 'Select Container Size', 'ground' ),
				'description' => __( 'Using this option you can change the container size', 'ground' ),
				'settings'    => 'container',
				'priority'    => 10,
				'section'     => 'ground_section_settings',
				'type'        => 'select',
				'choices'     => array(
					'container-boxed' => 'Container boxed',
					'container-full'  => 'Container full',
				),
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'rounded_theme_control',
			array(
				'label'       => __( 'Border Radius Theme', 'ground' ),
				'description' => __( 'Sets the border radius of the site elements ( Buttons, forms )', 'ground' ),
				'section'     => 'ground_section_settings',
				'settings'    => 'rounded_theme',
				'type'        => 'number',
				'priority'    => 10,
				'input_attrs' => array(
					'min' => 0,
					'max' => 100,
				),
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'rounded_media_control',
			array(
				'label'       => __( 'Border Radius Media', 'ground' ),
				'description' => __( 'Set the border radius of media / images', 'ground' ),
				'section'     => 'ground_section_settings',
				'settings'    => 'rounded_media',
				'type'        => 'number',
				'priority'    => 10,
				'input_attrs' => array(
					'min' => 0,
					'max' => 100,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'infinite_scroll',
		array(
			'default' => '',
		)
	);

	$wp_customize->add_control(
		'infinite_scroll_control',
		array(
			'label'    => 'Enable Infinite Scroll',
			'type'     => 'checkbox',
			'section'  => 'ground_section_settings',
			'settings' => 'infinite_scroll',
		)
	);
}

add_action( 'customize_register', 'ground_customizer_settings' );
