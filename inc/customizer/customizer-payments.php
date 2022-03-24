<?php

/**
 * Add New Header Section : ground_section_payments
 */
function ground_customizer_payments( $wp_customize ) {

	/**
	 * Add New Section: ground_section_payments
	 */
	$wp_customize->add_section(
		'ground_section_payments',
		array(
			'title'       => __( 'Payments', 'ground' ),
			'description' => '',
			'priority'    => 80,
			'capability'  => 'edit_theme_options',
		)
	);

	$wp_customize->add_setting( 'payment_amex' );
	$wp_customize->add_setting( 'payment_applepay' );
	$wp_customize->add_setting( 'payment_gpay' );
	$wp_customize->add_setting( 'payment_mastercard' );
	$wp_customize->add_setting( 'payment_maestro' );
	$wp_customize->add_setting( 'payment_paypal' );
	$wp_customize->add_setting( 'payment_satispay' );
	$wp_customize->add_setting( 'payment_sepa' );
	$wp_customize->add_setting( 'payment_visa' );
	$wp_customize->add_setting( 'payment_scalapay' );

	$wp_customize->add_control(
		'payment_amex_control',
		array(
			'label'    => 'Amex',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_amex',
		)
	);
	$wp_customize->add_control(
		'payment_applepay_control',
		array(
			'label'    => 'Applepay',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_applepay',
		)
	);
	$wp_customize->add_control(
		'payment_gpay_control',
		array(
			'label'    => 'Gpay',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_gpay',
		)
	);
	$wp_customize->add_control(
		'payment_mastercard_control',
		array(
			'label'    => 'Mastercard',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_mastercard',
		)
	);
	$wp_customize->add_control(
		'payment_maestro_control',
		array(
			'label'    => 'Maestro',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_maestro',
		)
	);
	$wp_customize->add_control(
		'payment_paypal_control',
		array(
			'label'    => 'Paypal',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_paypal',
		)
	);
	$wp_customize->add_control(
		'payment_satispay_control',
		array(
			'label'    => 'Satispay',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_satispay',
		)
	);
	$wp_customize->add_control(
		'payment_sepa_control',
		array(
			'label'    => 'Sepa',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_sepa',
		)
	);
	$wp_customize->add_control(
		'payment_visa_control',
		array(
			'label'    => 'Visa',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_visa',
		)
	);
	$wp_customize->add_control(
		'payment_scalapay_control',
		array(
			'label'    => 'Scalapay',
			'type'     => 'checkbox',
			'section'  => 'ground_section_payments',
			'settings' => 'payment_scalapay',
		)
	);
}

add_action( 'customize_register', 'ground_customizer_payments' );
