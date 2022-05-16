<?php

/**
 * Add New Panel : ground_panel_colors
 *
 * @param [type] $wp_customize
 * @return void
 */
function ground_customizer_colors( $wp_customize ) {
	$panel_name = 'ground_panel_colors';

	$wp_customize->add_panel(
		$panel_name,
		array(
			'priority'    => 43,
			'title'       => __( 'Colors', 'ground' ),
			'description' => __( 'Set the site color', 'ground' ),
		)
	);

	ground_section_colors_palette( $wp_customize, $panel_name );
	// ground_section_colors_header($wp_customize, $panel_name);
	// ground_section_colors_footer($wp_customize, $panel_name);
}

add_action( 'customize_register', 'ground_customizer_colors' );

/**
 * Add section ground_section_colors_palette to ground_panel_colors
 *
 * @param [type] $wp_customize
 * @param [type] $panel_name
 * @return void
 */
function ground_section_colors_palette( $wp_customize, $panel_name ) {

	$section_name = 'ground_section_colors_palette';

	$wp_customize->add_section(
		$section_name,
		array(
			'title'       => __( 'Palette', 'ground' ),
			'panel'       => $panel_name,
			'description' => __( 'Set the site color palette', 'ground' ),
		)
	);

	// color_primary
	$color_list[] = array(
		'slug'        => 'color_primary',
		'default'     => '#6366F1',
		'label'       => __( 'Color Primary', 'ground' ),
		'description' => null,
	);

	// color_secondary
	$color_list[] = array(
		'slug'        => 'color_secondary',
		'default'     => '#14B8A6',
		'label'       => __( 'Color Secondary', 'ground' ),
		'description' => null,
	);

	// color_tertiary
	$color_list[] = array(
		'slug'        => 'color_tertiary',
		'default'     => '#000000',
		'label'       => __( 'Color Tertiary', 'ground' ),
		'description' => null,
	);

	// color_quaternary
	$color_list[] = array(
		'slug'        => 'color_quaternary',
		'default'     => '#71717A',
		'label'       => __( 'Color Quaternary', 'ground' ),
		'description' => null,
	);

	// color_quinary
	$color_list[] = array(
		'slug'        => 'color_quinary',
		'default'     => '#ffffff',
		'label'       => __( 'Color Quinary', 'ground' ),
		'description' => null,
	);

	// color_senary
	$color_list[] = array(
		'slug'        => 'color_senary',
		'default'     => '#F4F4F5',
		'label'       => __( 'Color Senary', 'ground' ),
		'description' => null,
	);

	// color_septenary
	$color_list[] = array(
		'slug'        => 'color_septenary',
		'default'     => '#D4D4D8',
		'label'       => __( 'Color Septenary', 'ground' ),
		'description' => null,
	);

	// color_octonary
	$color_list[] = array(
		'slug'        => 'color_octonary',
		'default'     => '#D4D4D8',
		'label'       => __( 'Color Octonary', 'ground' ),
		'description' => null,
	);

	ground_declare_color_settings_controls( $wp_customize, $section_name, $color_list );
}


/**
 * Add section ground_section_colors_header to ground_panel_colors
 *
 * @param [type] $wp_customize
 * @param [type] $panel_name
 * @return void
 */
// function ground_section_colors_header( $wp_customize, $panel_name ) {

// 	$section_name = 'ground_section_colors_header';

// 	$wp_customize->add_section(
// 		$section_name,
// 		array(
// 			'title'       => __( 'Header', 'ground' ),
// 			'panel'       => $panel_name,
// 			'description' => __( 'Set the header site color', 'ground' ),
// 		)
// 	);

// 	// color_header
// 	$color_list[] = array(
// 		'slug'    => 'color_header',
// 		'default' => GROUND_COLOR_SEPTENARY,
// 		'label'   => __( 'Color header', 'ground' ),
// 	);

// 	ground_declare_color_settings_controls( $wp_customize, $section_name, $color_list );
// }

/**
 * Add section ground_section_colors_footer to ground_panel_colors
 *
 * @param [type] $wp_customize
 * @param [type] $panel_name
 * @return void
 */
// function ground_section_colors_footer( $wp_customize, $panel_name ) {

// 	$section_name = 'ground_section_colors_footer';

// 	$wp_customize->add_section(
// 		$section_name,
// 		array(
// 			'title'       => __( 'Footer', 'ground' ),
// 			'panel'       => $panel_name,
// 			'description' => __( 'Set the footer site color', 'ground' ),
// 		)
// 	);

// 	// color_header
// 	$color_list[] = array(
// 		'slug'    => 'color_footer',
// 		'default' => GROUND_COLOR_SEPTENARY,
// 		'label'   => __( 'Color header', 'ground' ),
// 	);

// 	ground_declare_color_settings_controls( $wp_customize, $section_name, $color_list );
// }

/**
 * Util function to dynamically add_settings and add_control
 *
 * @param [type] $wp_customize
 * @param [type] $section_name
 * @param [type] $color_list
 * @return void
 */
function ground_declare_color_settings_controls( $wp_customize, $section_name, $color_list ) {

	// add the settings and controls for each color
	foreach ( $color_list as $color ) {

		// SETTINGS
		$wp_customize->add_setting(
			$color['slug'],
			array(
				'type'              => 'theme_mod',
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => $color['default'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'] . '_control',
				array(
					'label'       => $color['label'],
					'description' => $color['description'],
					'section'     => $section_name,
					'settings'    => $color['slug'],
				)
			)
		);
	}
}

/**
 * Add custom palettes to wp.color picker.
 */
function ground_custom_color_palettes() {
	$color_palettes = json_encode(
		array(
			get_theme_mod( 'color_primary' ),
			get_theme_mod( 'color_secondary' ),
			get_theme_mod( 'color_tertiary' ),
			get_theme_mod( 'color_quaternary' ),
			get_theme_mod( 'color_quinary' ),
			get_theme_mod( 'color_senary' ),
			get_theme_mod( 'color_septenary' ),
			get_theme_mod( 'color_octonary' ),
		)
	);
	wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $color_palettes . ';' );
}

add_action( 'customize_controls_enqueue_scripts', 'ground_custom_color_palettes' );

/**
 * Change specific values if palette change
 *
 * @return void
 */
// function ground_customize_save_after($manager)
// {

// Get the setting you want to retrieve value from
// $new_color_septenary = get_theme_mod('color_septenary');

// Update another setting
// if ($new_color_septenary) {
// set_theme_mod('color_header', $new_color_septenary);
// }
// }

// add_action('customize_save_after', 'ground_customize_save_after');
