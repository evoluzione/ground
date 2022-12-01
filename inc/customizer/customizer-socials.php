<?php

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
			'title'       => __( 'Socials', 'ground' ),
			'description' => 'Insert url of your social channels',
			'priority'    => 44,
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
			'label'       => __( 'LinkedIn', 'ground' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'social_facebook_url',
		array(
			'type'        => 'url',
			'section'     => 'ground_section_socials',
			'label'       => __( 'Facebook', 'ground' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'social_twitter_url',
		array(
			'type'        => 'url',
			'section'     => 'ground_section_socials',
			'label'       => __( 'Twitter', 'ground' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'social_instagram_url',
		array(
			'type'        => 'url',
			'section'     => 'ground_section_socials',
			'label'       => __( 'Instagram', 'ground' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'social_youtube_url',
		array(
			'type'        => 'url',
			'section'     => 'ground_section_socials',
			'label'       => __( 'Youtube', 'ground' ),
			'description' => '',
		)
	);
}

add_action( 'customize_register', 'ground_customizer_socials' );
