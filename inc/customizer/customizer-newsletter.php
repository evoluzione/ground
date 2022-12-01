<?php

/**
 * Add New Newsletter Section : ground_section_newsletter
 */
function ground_customizer_newsletter( $wp_customize ) {

	/**
	 * Add New Section: ground_section_newsletter
	 */
	$wp_customize->add_section(
		'ground_section_newsletter',
		array(
			'title'       => __( 'Newsletter', 'ground' ),
			'description' => 'Insert newsletter information',
			'priority'    => 47,
			'capability'  => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting(
		'newsletter_title',
		array(
			'default' => '',
			'type'    => 'theme_mod',
		)
	);

	$wp_customize->add_setting(
		'newsletter_content',
		array(
			'default' => '',
			'type'    => 'theme_mod',
		)
	);

	$wp_customize->add_setting(
		'newsletter_shortcode',
		array(
			'default' => '',
			'type'    => 'theme_mod',
		)
	);

	$wp_customize->add_control(
		'newsletter_title',
		array(
			'type'        => 'text',
			'section'     => 'ground_section_newsletter',
			'label'       => __( 'Title', 'ground' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'newsletter_content',
		array(
			'type'        => 'textarea',
			'section'     => 'ground_section_newsletter',
			'label'       => __( 'Description', 'ground' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'newsletter_shortcode',
		array(
			'type'        => 'textarea',
			'section'     => 'ground_section_newsletter',
			'label'       => __( 'Shortcode/Form', 'ground' ),
			'description' => '',
		)
	);
}

add_action( 'customize_register', 'ground_customizer_newsletter' );
