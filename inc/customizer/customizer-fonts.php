<?php

/**
 * Add New Fonts Section : ground_section_fonts
 */
function ground_customizer_fonts($wp_customize)
{

    /**
     * Add New Section: ground_section_fonts
     */
    $wp_customize->add_section(
        'ground_section_fonts',
        array(
            'title'       => __('Fonts', 'ground-admin'),
            'description' => __('Insert your Fonts here', 'ground-admin'),
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
            'label'       => __('Font Source Primary', 'ground-admin'),
            'description' => __('To embed a font, copy the source code here', 'ground-admin'),
        )
    );

    $wp_customize->add_control(
        'font_family_primary',
        array(
            'type'        => 'text',
            'section'     => 'ground_section_fonts',
            'label'       => __('Font Family Primary', 'ground-admin'),
            'description' => __('Example: Roboto', 'ground-admin'),
        )
    );

    $wp_customize->add_control(
        'font_source_secondary',
        array(
            'type'        => 'textarea',
            'section'     => 'ground_section_fonts',
            'label'       => __('Font Source Secondary', 'ground-admin'),
            'description' => __('To embed a font, copy the source code here', 'ground-admin'),
        )
    );

    $wp_customize->add_control(
        'font_family_secondary',
        array(
            'type'        => 'text',
            'section'     => 'ground_section_fonts',
            'label'       => __('Font Family Secondary', 'ground-admin'),
            'description' => __('Example: Playfair Display', 'ground-admin'),
        )
    );
}

add_action('customize_register', 'ground_customizer_fonts');
