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
		$block['api_version'] = $block['api_version'] ?? 3;
		$block['acf_block_version'] = $block['acf_block_version'] ?? 3;

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
 * Generates the wrapper HTML attributes for an ACF Gutenberg block.
 *
 * On the frontend the attributes come from get_block_wrapper_attributes(), so
 * every block support declared in config/blocks.php (className, align, anchor,
 * color, spacing…) lands on the wrapper as core outputs it. In the editor
 * preview the block editor already puts those on its own wrapper around the
 * ACF block, and get_block_wrapper_attributes() has no block to read: only the
 * theme's own classes are printed, so alignment and anchor are not doubled.
 *
 * @param array  $block      The block settings and attributes from Gutenberg.
 * @param string $class_name Additional class names to add to the block (optional).
 * @param bool   $is_preview True when rendered in the block editor.
 *
 * @return string The HTML attributes for the block.
 */
function ground_block_attributes( $block, $class_name = '', $is_preview = false ) {
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

	$classes = implode( ' ', $class_names );

	if ( ! $is_preview && ! empty( WP_Block_Supports::$block_to_render ) ) {
		$attributes = get_block_wrapper_attributes( array( 'class' => $classes ) );

		// ACF registers `align` with an empty-string default and core's align
		// support only checks isset(): unaligned blocks would get a bare "align" class.
		return preg_replace( '/ align(?=[ "])|(?<=")align /', '', $attributes );
	}

	return $classes ? 'class="' . esc_attr( $classes ) . '"' : '';
}
