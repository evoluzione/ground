<?php

/**
 * Add New Controls for title_tagline Section
 */
function ground_customizer_title_tagline( $wp_customize ) {

	$wp_customize->add_setting(
		'logo_source_primary',
	);

	$wp_customize->add_setting(
		'no_image_url',
	);

	$wp_customize->add_control(
		'logo_source_primary',
		array(
			'type'        => 'textarea',
			'section'     => 'title_tagline',
			'priority'    => 30,
			'label'       => __( 'Logo SVG', 'ground' ),
			'description' => __( 'Paste the SVG code', 'ground' ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'no_image_url',
			array(
				'label'    => __( 'Placeholder image', 'ground' ),
				'priority' => 40,
				'section'  => 'title_tagline',
				'settings' => 'no_image_url',
			)
		)
	);
}

add_action( 'customize_register', 'ground_customizer_title_tagline' );
