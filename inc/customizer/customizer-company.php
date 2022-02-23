<?php

/**
 * Add New Company Section : ground_section_company
 */
function ground_customizer_company($wp_customize)
{

    /**
     * Add New Section: ground_section_company
     */
    $wp_customize->add_panel(
        'ground_section_company',
        array(
            'priority'    => 45,
            'title'       => __('Company', 'ground-admin'),
            'description' => __('Theme Modifications like color scheme, theme texts and layout preferences can be done here', 'ground-admin'),
        )
    );

    $wp_customize->add_section(
        'ground_section_company_general_info',
        array(
            'title' => __('General Info', 'ground-admin'),
            'panel' => 'ground_section_company',
        )
    );

    $wp_customize->add_section(
        'ground_section_company_address',
        array(
            'title' => __('Address', 'ground-admin'),
            'panel' => 'ground_section_company',
        )
    );

    $wp_customize->add_section(
        'ground_section_company_phones',
        array(
            'title' => __('Phones', 'ground-admin'),
            'panel' => 'ground_section_company',
        )
    );

    /* Company: General info */
    $wp_customize->add_setting('company_name');
    $wp_customize->add_setting('company_vat');
    $wp_customize->add_setting('company_fiscal_code');

    /* Company: Address */
    $wp_customize->add_setting('company_address');
    $wp_customize->add_setting('company_city');
    $wp_customize->add_setting('company_province');
    $wp_customize->add_setting('company_zip_code');
    $wp_customize->add_setting('company_country');
    $wp_customize->add_setting(
        'company_address_url',
        array(
            'sanitize_callback' => 'esc_url',
        )
    );

    /* Company: Phones */
    $wp_customize->add_setting('company_phone');
    $wp_customize->add_setting('company_whatsapp');
    $wp_customize->add_setting('company_fax');

    /* Company: General info */
    $wp_customize->add_control(
        'company_name',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_general_info',
            'label'   => __('Company Name', 'ground-admin'),
        )
    );
    $wp_customize->add_control(
        'company_vat',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_general_info',
            'label'   => __('Company VAT', 'ground-admin'),
        )
    );
    $wp_customize->add_control(
        'company_fiscal_code',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_general_info',
            'label'   => __('Company Fiscal Code', 'ground-admin'),
        )
    );

    /* Company: Address */
    $wp_customize->add_control(
        'company_address',
        array(
            'type'    => 'textarea',
            'section' => 'ground_section_company_address',
            'label'   => __('Company Address', 'ground-admin'),
        )
    );
    $wp_customize->add_control(
        'company_city',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_address',
            'label'   => __('Company City', 'ground-admin'),
        )
    );
    $wp_customize->add_control(
        'company_province',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_address',
            'label'   => __('Company Province', 'ground-admin'),
        )
    );
    $wp_customize->add_control(
        'company_zip_code',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_address',
            'label'   => __('Company ZIP Code', 'ground-admin'),
        )
    );
    $wp_customize->add_control(
        'company_country',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_address',
            'label'   => __('Company Country', 'ground-admin'),
        )
    );

    /* Company: Phones */
    $wp_customize->add_control(
        'company_phone',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_phones',
            'label'   => __('Phones', 'ground-admin'),
        )
    );
    $wp_customize->add_control(
        'company_whatsapp',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_phones',
            'label'   => __('Whatsapp', 'ground-admin'),
        )
    );
    $wp_customize->add_control(
        'company_fax',
        array(
            'type'    => 'text',
            'section' => 'ground_section_company_phones',
            'label'   => __('Fax', 'ground-admin'),
        )
    );
}

add_action('customize_register', 'ground_customizer_company');
