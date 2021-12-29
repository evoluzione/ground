<?php

/**
 * Section: Customizer
 *
 * Basic Customizer section with basic controls.
 *
 * @package Ground
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// Customize function.
if ( ! function_exists( 'wpc_panel_wpcustomize' ) ) {


	/**
	 * Add New Controls for title_tagline Section
	 */
	function ground_customizer_title_tagline( $wp_customize ) {

		$wp_customize->add_setting(
			'logo_url_primary',
			array(
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_setting(
			'logo_source_primary',
		);

		$wp_customize->add_setting(
			'no_image_url',
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'logo_url_primary_control',
				array(
					'label'    => __( 'Logo', 'ground-admin' ),
					'priority' => 20,
					'section'  => 'title_tagline',
					'settings' => 'logo_url_primary',
				)
			)
		);

		$wp_customize->add_control(
			'logo_source_primary',
			array(
				'type'        => 'textarea',
				'section'     => 'title_tagline',
				'priority'    => 30,
				'label'       => __( 'Logo SVG', 'ground-admin' ),
				'description' => __( 'Paste the SVG code', 'ground-admin' ),
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'no_image_url',
				array(
					'label'    => __( 'Placeholder image', 'ground-admin' ),
					'priority' => 40,
					'section'  => 'title_tagline',
					'settings' => 'no_image_url',
				)
			)
		);

	}

	add_action( 'customize_register', 'ground_customizer_title_tagline' );


	/**
	 * Add New Header Section : ground_section_header
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
			'header_advice',
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
	 * Add New Footer Section : ground_section_footer
	 */
	function ground_customizer_footer( $wp_customize ) {

		/**
		 * Add New Section: ground_section_footer
		 */
		$wp_customize->add_panel(
			'ground_section_footer',
			array(
				'title'       => __( 'Footer', 'ground-admin' ),
				'description' => __( 'Theme Modifications like color scheme, theme texts and layout preferences can be done here', 'ground-admin' ),
				'priority'    => 41,
			)
		);

		$wp_customize->add_section(
			'ground_section_footer_payments',
			array(
				'title' => __( 'Payments', 'ground-admin' ),
				'panel' => 'ground_section_footer',
			)
		);

		$wp_customize->add_section(
			'ground_section_footer_shipping',
			array(
				'title' => __( 'Shipping', 'ground-admin' ),
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
				'label'       => __( 'Payments Title', 'ground-admin' ),
				'description' => '',
			)
		);
		$wp_customize->add_control(
			'payments_content',
			array(
				'type'        => 'textarea',
				'section'     => 'ground_section_footer_payments',
				'label'       => __( 'Payments Content', 'ground-admin' ),
				'description' => '',
			)
		);

		/* Footer: Shipping */
		$wp_customize->add_control(
			'shipping_title',
			array(
				'type'        => 'text',
				'section'     => 'ground_section_footer_shipping',
				'label'       => __( 'Shipping Title', 'ground-admin' ),
				'description' => '',
			)
		);
		$wp_customize->add_control(
			'shipping_content',
			array(
				'type'        => 'textarea',
				'section'     => 'ground_section_footer_shipping',
				'label'       => __( 'Shipping Content', 'ground-admin' ),
				'description' => '',
			)
		);

	}

	add_action( 'customize_register', 'ground_customizer_footer' );



	/**
	 * Add New Fonts Section : ground_section_fonts
	 */
	function ground_customizer_fonts( $wp_customize ) {

		/**
		 * Add New Section: ground_section_fonts
		 */
		$wp_customize->add_section(
			'ground_section_fonts',
			array(
				'title'       => __( 'Fonts', 'ground-admin' ),
				'description' => __( 'Insert your Fonts here', 'ground-admin' ),
				'priority'    => 42,
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
				'label'       => __( 'Font Source Primary', 'ground-admin' ),
				'description' => __( 'To embed a font, copy the source code here', 'ground-admin' ),
			)
		);

		$wp_customize->add_control(
			'font_family_primary',
			array(
				'type'        => 'text',
				'section'     => 'ground_section_fonts',
				'label'       => __( 'Font Family Primary', 'ground-admin' ),
				'description' => __( 'Example: Roboto', 'ground-admin' ),
			)
		);

		$wp_customize->add_control(
			'font_source_secondary',
			array(
				'type'        => 'textarea',
				'section'     => 'ground_section_fonts',
				'label'       => __( 'Font Source Secondary', 'ground-admin' ),
				'description' => __( 'To embed a font, copy the source code here', 'ground-admin' ),
			)
		);

		$wp_customize->add_control(
			'font_family_secondary',
			array(
				'type'        => 'text',
				'section'     => 'ground_section_fonts',
				'label'       => __( 'Font Family Secondary', 'ground-admin' ),
				'description' => __( 'Example: Playfair Display', 'ground-admin' ),
			)
		);

	}

	add_action( 'customize_register', 'ground_customizer_fonts' );



	/**
	 * Add New Header Section : ground_section_header
	 */
	function ground_customizer_payments( $wp_customize ) {

		/**
		 * Add New Section: ground_section_header
		 */
		$wp_customize->add_section(
			'ground_section_payments',
			array(
				'title'       => __( 'Payments', 'ground-admin' ),
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

	}

	add_action( 'customize_register', 'ground_customizer_payments' );




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
				'description' => __( 'Set the site color palette', 'ground-admin' ),
				'priority'    => 43,
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
				'color_primary_control',
				array(
					'label'    => __( 'Color Primary', 'ground-admin' ),
					'section'  => 'ground_section_colors',
					'settings' => 'color_primary',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_secondary_control',
				array(
					'label'    => __( 'Color Secondary', 'ground-admin' ),
					'section'  => 'ground_section_colors',
					'settings' => 'color_secondary',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_typo_primary_control',
				array(
					'label'    => __( 'Color Typo Primary', 'ground-admin' ),
					'section'  => 'ground_section_colors',
					'settings' => 'color_typo_primary',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_typo_secondary_control',
				array(
					'label'    => __( 'Color Typo Secondary', 'ground-admin' ),
					'section'  => 'ground_section_colors',
					'settings' => 'color_typo_secondary',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_body_primary_control',
				array(
					'label'    => __( 'Color Body Primary', 'ground-admin' ),
					'section'  => 'ground_section_colors',
					'settings' => 'color_body_primary',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_body_secondary_control',
				array(
					'label'    => __( 'Color Body Secondary', 'ground-admin' ),
					'section'  => 'ground_section_colors',
					'settings' => 'color_body_secondary',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_line_primary_control',
				array(
					'label'    => __( 'Color Line Primary', 'ground-admin' ),
					'section'  => 'ground_section_colors',
					'settings' => 'color_line_primary',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_line_secondary_control',
				array(
					'label'    => __( 'Color Line Secondary', 'ground-admin' ),
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
				'label'       => __( 'Linkedin', 'ground-admin' ),
				'description' => '',
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
	 * Add New Company Section : ground_section_company
	 */
	function ground_customizer_company( $wp_customize ) {

		/**
		 * Add New Section: ground_section_company
		 */
		$wp_customize->add_panel(
			'ground_section_company',
			array(
				'priority'    => 45,
				'title'       => __( 'Company', 'ground-admin' ),
				'description' => __( 'Theme Modifications like color scheme, theme texts and layout preferences can be done here', 'ground-admin' ),
			)
		);

		$wp_customize->add_section(
			'ground_section_company_general_info',
			array(
				'title' => __( 'General Info', 'ground-admin' ),
				'panel' => 'ground_section_company',
			)
		);

		$wp_customize->add_section(
			'ground_section_company_address',
			array(
				'title' => __( 'Address', 'ground-admin' ),
				'panel' => 'ground_section_company',
			)
		);

		$wp_customize->add_section(
			'ground_section_company_phones',
			array(
				'title' => __( 'Phones', 'ground-admin' ),
				'panel' => 'ground_section_company',
			)
		);

		$wp_customize->add_section(
			'ground_section_company_email',
			array(
				'title' => __( 'Emails', 'ground-admin' ),
				'panel' => 'ground_section_company',
			)
		);

		$wp_customize->add_section(
			'ground_section_company_hours',
			array(
				'title' => __( 'Hours', 'ground-admin' ),
				'panel' => 'ground_section_company',
			)
		);

		/* Company: General info */
		$wp_customize->add_setting( 'company_name' );
		$wp_customize->add_setting( 'company_zip_code' );
		$wp_customize->add_setting( 'company_vat' );
		$wp_customize->add_setting( 'company_fiscal_code' );

		/* Company: Address */
		$wp_customize->add_setting( 'company_address' );
		$wp_customize->add_setting( 'company_city' );
		$wp_customize->add_setting( 'company_province' );
		$wp_customize->add_setting( 'company_country' );
		$wp_customize->add_setting(
			'company_address_url',
			array(
				'sanitize_callback' => 'esc_url',
			)
		);
		$wp_customize->add_setting( 'company_address_latitude' );
		$wp_customize->add_setting( 'company_address_longitude' );

		/* Company: Phones */
		$wp_customize->add_setting( 'company_phone' );
		$wp_customize->add_setting( 'company_whatsapp' );
		$wp_customize->add_setting( 'company_fax' );

		/* Company: Emails */
		$wp_customize->add_setting( 'company_email' );
		$wp_customize->add_setting( 'company_pec' );

		/* Company: Hours */
		$wp_customize->add_setting( 'company_opening_hours' );
		$wp_customize->add_setting( 'company_closing_time' );

		/* Company: General info */
		$wp_customize->add_control(
			'company_name',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_general_info',
				'label'   => __( 'Company Name', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_zip_code',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_general_info',
				'label'   => __( 'Company ZIP Code', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_vat',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_general_info',
				'label'   => __( 'Company VAT', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_fiscal_code',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_general_info',
				'label'   => __( 'Company Fiscal Code', 'ground-admin' ),
			)
		);

		/* Company: Address */
		$wp_customize->add_control(
			'company_address',
			array(
				'type'    => 'textarea',
				'section' => 'ground_section_company_address',
				'label'   => __( 'Company Address', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_city',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_address',
				'label'   => __( 'Company City', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_province',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_address',
				'label'   => __( 'Company Province', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_country',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_address',
				'label'   => __( 'Company Country', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_address_url',
			array(
				'type'    => 'url',
				'section' => 'ground_section_company_address',
				'label'   => __( 'Company Address Url', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_address_latitude',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_address',
				'label'   => __( 'Company Address Latitude', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_address_longitude',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_address',
				'label'   => __( 'Company Address Longitude', 'ground-admin' ),
			)
		);

		/* Company: Phones */
		$wp_customize->add_control(
			'company_phone',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_phones',
				'label'   => __( 'Phones', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_whatsapp',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_phones',
				'label'   => __( 'Whatsapp', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_fax',
			array(
				'type'    => 'text',
				'section' => 'ground_section_company_phones',
				'label'   => __( 'Fax', 'ground-admin' ),
			)
		);

		/* Company: Emails */
		$wp_customize->add_control(
			'company_email',
			array(
				'type'    => 'email',
				'section' => 'ground_section_company_email',
				'label'   => __( 'Email', 'ground-admin' ),
			)
		);

		$wp_customize->add_control(
			'company_pec',
			array(
				'type'    => 'Email',
				'section' => 'ground_section_company_email',
				'label'   => __( 'Email Pec', 'ground-admin' ),
			)
		);

		/* Company: Hours */
		$wp_customize->add_control(
			'company_opening_hours',
			array(
				'type'    => 'textarea',
				'section' => 'ground_section_company_hours',
				'label'   => __( 'Opening Hours', 'ground-admin' ),
			)
		);
		$wp_customize->add_control(
			'company_closing_time',
			array(
				'type'    => 'textarea',
				'section' => 'ground_section_company_hours',
				'label'   => __( 'Closing Time', 'ground-admin' ),
			)
		);

	}

	add_action( 'customize_register', 'ground_customizer_company' );




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
				'title'       => __( 'Settings', 'ground-admin' ),
				'description' => '',
				'priority'    => 46,
				'capability'  => 'edit_theme_options',
			)
		);

		$wp_customize->add_setting(
			'container',
			array(
				'default' => 'container',
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
					'label'       => __( 'Select Container Size', 'ground-admin' ),
					'description' => __( 'Using this option you can change the container size', 'ground-admin' ),
					'settings'    => 'container',
					'priority'    => 10,
					'section'     => 'ground_section_settings',
					'type'        => 'select',
					'choices'     => array(
						'container'      => 'Container boxed',
						'container-full' => 'Container full',
					),
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'rounded_theme_control',
				array(
					'label'       => __( 'Border Radius Theme', 'ground-admin' ),
					'description' => __( 'Sets the border radius of the site elements ( Buttons, forms )', 'ground-admin' ),
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
					'label'       => __( 'Border Radius Media', 'ground-admin' ),
					'description' => __( 'Set the border radius of media / images', 'ground-admin' ),
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

	}

	add_action( 'customize_register', 'ground_customizer_settings' );


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
				'title'       => __( 'Newsletter', 'ground-admin' ),
				'description' => 'Insert newsletter information (Remember to install this plugin: MC4WP - Mailchimp for WordPress',
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

		$wp_customize->add_setting(
			'newsletter_auto_modal',
			array(
				'default' => '',
				'type'    => 'theme_mod',
			)
		);

		$wp_customize->add_setting(
			'newsletter_footer',
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
				'label'       => __( 'Title', 'ground-admin' ),
				'description' => '',
			)
		);
		$wp_customize->add_control(
			'newsletter_content',
			array(
				'type'        => 'textarea',
				'section'     => 'ground_section_newsletter',
				'label'       => __( 'Description', 'ground-admin' ),
				'description' => '',
			)
		);
		$wp_customize->add_control(
			'newsletter_shortcode',
			array(
				'type'        => 'text',
				'section'     => 'ground_section_newsletter',
				'label'       => __( 'MC4WP Shortcode', 'ground-admin' ),
				'description' => '',
			)
		);

		$wp_customize->add_control(
			'newsletter_auto_modal',
			array(
				'label'   => 'Do you want it to open automatically after 10s?',
				'type'    => 'checkbox',
				'section' => 'ground_section_newsletter',
			)
		);

		$wp_customize->add_control(
			'newsletter_footer',
			array(
				'label'   => 'Do you want newsletter section before footer?',
				'type'    => 'checkbox',
				'section' => 'ground_section_newsletter',
			)
		);

	}

	add_action( 'customize_register', 'ground_customizer_newsletter' );





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
				'title'       => __( 'Products Not Purchasable', 'ground-admin' ),
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
				'label'       => __( 'Product Button & Label', 'ground-admin' ),
				'description' => __( 'Text visible on the archive page for each non-purchasable product', 'ground-admin' ),
			)
		);

		$wp_customize->add_control(
			'shop_not_purchasable_product_text',
			array(
				'type'        => 'textarea',
				'section'     => 'ground_section_not_purchasable',
				'label'       => __( 'Single Product Message', 'ground-admin' ),
				'description' => __( 'Text visible on the single product page', 'ground-admin' ),
			)
		);

		$wp_customize->add_control(
			'shop_not_purchasable_product_cta_control',
			array(
				'label'       => 'Select Page',
				'description' => __( 'Button visible on the single product page', 'ground-admin' ),
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
				'title'       => __( 'Product Single', 'ground-admin' ),
				'description' => __( 'Select the pages you want to show on the product page after the summary', 'ground-admin' ),
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

	}

	add_action( 'customize_register', 'ground_customizer_shop' );


}
