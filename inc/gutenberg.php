<?php
/**
 * Register blocks
 */
function ground_register_blocks() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	foreach ( ground_config( 'blocks.blocks' ) as $block ) {
		if ( empty( $block['name'] ) ) {
			continue;
		}

		$block['render_template'] = $block['render_template'] ?? '/template-parts/blocks/' . $block['name'] . '.php';
		$block['category'] = $block['category'] ?? 'ground';

		// $classNameList = array_filter( [
		// 	$block['className'] ?? null,
		// 	$block['fullscreen'] ? 'is-fullscreen' : null,
		// 	$block['fullbleed'] ? 'is-full-bleed' : null,
		// 	$block['boxed'] ? 'is-boxed' : null,
		// ] );

		// $block['className'] = implode( ' ', $classNameList );

		acf_register_block_type( $block );
	}
}

add_action( 'acf/init', 'ground_register_blocks' );











/**
 * Register block categories
 *
 * @param array $default_categories Array of block categories.
 * @return array An associative array of registered block data.
 */
function ground_child_register_block_categories( $default_categories ) {

	$category_slugs = wp_list_pluck( $default_categories, 'slug' );

	return in_array( 'ground', $category_slugs, true ) ? $default_categories : array_merge(
		$default_categories,
		array(
			array(
				'slug' => 'ground',
				'title' => __( 'Ground', 'ground' ),
				'icon' => null,
			),
		)
	);
}

add_filter( 'block_categories_all', 'ground_child_register_block_categories' );


function ground_block_class( $block, $class = '', $return = true ) {

	$block_name = $block['name'];

	$pattern = '/(.*?)\//';
	$block_name = preg_replace( $pattern, '', $block_name );
	$class .= ' ground-block-' . $block_name;

	if ( ! empty( $block['className'] ) ) {
		$class .= ' ' . $block['className'];
	}

	if ( ! empty( $block['align'] ) ) {
		$class .= ' align' . $block['align'];
	}

	if ( $return ) {
		return $class;
	}

	echo 'class="' . esc_attr( $class ) . '"';

}