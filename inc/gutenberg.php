<?php
/**
 * Register ACF Gutenberg Blocks.
 *
 * @return void
 */
function ground_register_acf_blocks() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	$blocks = ground_config( 'blocks.blocks' );

	if ( empty( $blocks ) || ! is_array( $blocks ) ) {
		return;
	}

	foreach ( $blocks as $block ) {
		if ( empty( $block['name'] ) ) {
			continue;
		}

		$block['render_template'] = $block['render_template'] ?? '/template-parts/blocks/' . $block['name'] . '.php';
		$block['category'] = $block['category'] ?? 'ground';

		acf_register_block_type( $block );
	}
}

add_action( 'acf/init', 'ground_register_acf_blocks' );


/**
 * Register custom block categories.
 *
 * @param array                   $categories           Array of existing block categories.
 * @param WP_Block_Editor_Context $block_editor_context Block editor context.
 * @return array Modified array of block categories.
 */
function ground_register_block_categories( $categories, $block_editor_context ) {
	$custom_category = array(
		array(
			'slug' => 'ground',
			'title' => __( 'Ground', 'ground' ),
			'icon' => null,
		),
	);

	return array_merge( $categories, $custom_category );
}

add_filter( 'block_categories_all', 'ground_register_block_categories', 10, 2 );


/**
 * Generates HTML attributes for a ACF Gutenberg block.
 *
 * @param array  $block      The block settings and attributes from Gutenberg.
 * @param string $class_name Additional class names to add to the block (optional).
 *
 * @return string The HTML attributes for the block.
 */
function ground_block_attributes( $block, $class_name = '' ) {
	$class_names = array();

	if ( ! empty( $class_name ) ) {
		$class_names[] = $class_name;
	}

	// Extract block name without namespace.
	if ( ! empty( $block['name'] ) ) {
		$block_name_parts = explode( '/', $block['name'] );
		$block_name = end( $block_name_parts );
		$class_names[] = 'ground-block-' . $block_name;
	}

	if ( ! empty( $block['className'] ) ) {
		$class_names[] = $block['className'];
	}

	if ( ! empty( $block['align'] ) ) {
		$class_names[] = 'align' . $block['align'];
	}

	$attributes = array();

	if ( ! empty( $block['anchor'] ) ) {
		$attributes[] = 'id="' . esc_attr( $block['anchor'] ) . '"';
	}

	if ( ! empty( $class_names ) ) {
		$attributes[] = 'class="' . esc_attr( implode( ' ', $class_names ) ) . '"';
	}

	return implode( ' ', $attributes );
}

