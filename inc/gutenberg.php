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

		$block['render_template'] = $block['render_template'] ?? '/partials/blocks/' . $block['name'] . '.php';
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




// function ground_block_class( $block, $class = '', $return = true ) {

// 	$block_name = $block['name'];

// 	$pattern = '/(.*?)\//';
// 	$block_name = preg_replace( $pattern, '', $block_name );
// 	$class .= ' ground-block-' . $block_name;

// 	if ( ! empty( $block['className'] ) ) {
// 		$class .= ' ' . $block['className'];
// 	}

// 	if ( ! empty( $block['align'] ) ) {
// 		$class .= ' align' . $block['align'];
// 	}

// 	if ( $return ) {
// 		return $class;
// 	}

// 	echo 'class="' . esc_attr( $class ) . '"';

// }