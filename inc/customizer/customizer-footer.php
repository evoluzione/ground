<?php

/**
 * Add New Footer Section : ground_section_footer
 */
function ground_customizer_footer( $wp_customize ) {

	/**
	 * Add New Section: ground_section_footer
	 */
	$wp_customize->add_panel(
		'ground_section_footer',
		array(
			'title'       => __( 'Footer', 'ground' ),
			'description' => __( 'Theme Modifications like color scheme, theme texts and layout preferences can be done here', 'ground' ),
			'priority'    => 41,
		)
	);

	$wp_customize->add_section(
		'ground_section_footer_payments',
		array(
			'title' => __( 'Payments', 'ground' ),
			'panel' => 'ground_section_footer',
		)
	);

	$wp_customize->add_section(
		'ground_section_footer_shipping',
		array(
			'title' => __( 'Shipping', 'ground' ),
			'panel' => 'ground_section_footer',
		)
	);

	/* Footer: Payments */
	$wp_customize->add_setting( 'payments_title' );
	$wp_customize->add_setting( 'payments_content' );

	/* Footer: Shipping */
	$wp_customize->add_setting( 'shipping_title' );
	$wp_customize->add_setting( 'shipping_content' );

	/* Footer: Payments */
	$wp_customize->add_control(
		'payments_title',
		array(
			'type'        => 'text',
			'section'     => 'ground_section_footer_payments',
			'label'       => __( 'Payments Title', 'ground' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'payments_content',
		array(
			'type'        => 'textarea',
			'section'     => 'ground_section_footer_payments',
			'label'       => __( 'Payments Content', 'ground' ),
			'description' => '',
		)
	);

	/* Footer: Shipping */
	$wp_customize->add_control(
		'shipping_title',
		array(
			'type'        => 'text',
			'section'     => 'ground_section_footer_shipping',
			'label'       => __( 'Shipping Title', 'ground' ),
			'description' => '',
		)
	);
	$wp_customize->add_control(
		'shipping_content',
		array(
			'type'        => 'textarea',
			'section'     => 'ground_section_footer_shipping',
			'label'       => __( 'Shipping Content', 'ground' ),
			'description' => '',
		)
	);
}

add_action( 'customize_register', 'ground_customizer_footer' );
