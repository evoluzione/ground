<?php

/**
 * Add Gutenberg editor scripts
 */
function ground_enqueue_gutenberg_script() {
	global $pagenow;

	// In widget page wp-editor is already a dependency.
	if ( $pagenow === 'widgets.php' ) {
		$deps = array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components' );
	} else {
		$deps = array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' );
	}

	$path      = get_template_directory_uri() . '/dist/js/ground-gutenberg.min.js';
	$in_footer = true;

	wp_enqueue_script( 'ground/gutenberg', $path, $deps, false, $in_footer );
}

if ( is_admin() ) {
	add_action( 'enqueue_block_assets', 'ground_enqueue_gutenberg_script' );
}

/**
 * Handle custom class to core blocks
 *
 * @param string $block_content The content of the block.
 * @param array  $block The object block.
 * @return string
 */
function ground_wp_blocks_handle_custom_class( string $block_content, array $block ) {

	if ( is_admin() && wp_is_json_request() ) {
		return $block_content;
	}

	$block_name = $block['blockName'];

	// Skip empty blocks.
	$is_empty = strlen( trim( $block_content ) ) == 0;
	if ( ! $block_name && $is_empty ) {
		return $block_content;
	}

	// Classic editor has no name but has content.
	$is_classic_editor = ! $block_name && ! $is_empty;

	if ( $is_classic_editor ) {
		$block_name    = 'core/classic-editor';
		$block_content = '<div class="wp-block-classic-editor">' . $block_content . '</div>';
	}

	$opening_tag   = get_opening_tag( $block_content );
	$has_class     = strpos( $opening_tag, 'class="' );
	$is_fullscreen = strpos( $opening_tag, 'is-fullscreen' ) || strpos( $opening_tag, 'alignfull' );
	$is_full_bleed = strpos( $opening_tag, 'is-full-bleed' );
	$is_wide       = strpos( $opening_tag, 'alignwide' );
	$is_boxed      = strpos( $opening_tag, 'is-boxed' );

	switch ( $block_name ) {
		case 'core/paragraph':
			$block_content = ground_wp_blocks_add_custom_class( $block_content, $has_class, 'wp-block-paragraph' );
			break;

		case 'core/heading':
			$block_content = ground_wp_blocks_add_custom_class( $block_content, $has_class, 'wp-block-heading' );
			break;

		case 'core/list':
			$block_content = ground_wp_blocks_add_custom_class( $block_content, $has_class, 'wp-block-list' );
			break;

		default:
			break;
	}

	if ( isset( $block['attrs']['toWrap'] ) ) {
		$pattern    = '/(.*?)\//';
		$block_name = preg_replace( $pattern, '', $block_name );

		$additional_classes  = 'ground-block-wrapper' . ' ground-block-wrapper--' . $block_name;
		$additional_classes .= $is_fullscreen ? ' is-fullscreen' : '';
		$additional_classes .= $is_full_bleed ? ' is-full-bleed' : '';
		$additional_classes .= $is_wide ? ' is-wide' : '';
		$additional_classes .= $is_boxed ? ' is-boxed' : '';
		$block_content       = '<div class="' . $additional_classes . '">' . $block_content . '</div>';
	}

	return $block_content;
}

add_filter( 'render_block', 'ground_wp_blocks_handle_custom_class', 10, 2 );

/**
 * Add a custom class to native wp blocks
 *
 * @param string  $block_content The content block to handle.
 * @param boolean $has_class Detect if the block has already a class.
 * @param string  $class_to_add The class to add.
 * @return string
 */
function ground_wp_blocks_add_custom_class( $block_content, $has_class, $class_to_add ) {
	if ( ! $has_class ) {
		// Add class attribute.
		// Detect paragraph, heading tag, ordered and unordered list
		$pattern       = '/<(p|h\d|[uo]l)(.*)/i';
		$replacement   = '<$1 class=""$2';
		$block_content = preg_replace( $pattern, $replacement, $block_content );
	}

	// Append custom class.
	$pattern     = '/class="(.*)"/';
	$replacement = 'class="' . $class_to_add . ( $has_class ? ' ' : '' ) . '$1"';
	return preg_replace( $pattern, $replacement, $block_content );
}

/**
 * Detect if a block has a parent.
 *
 * @param array         $parsed_block The block being rendered.
 * @param array         $source_block An un-modified copy of $parsed_block, as it appeared in the source content.
 * @param WP_Block|null $parent_block If this is a nested block, a reference to the parent block.
 * @return string
 */
function ground_block_data_pre_render( $parsed_block, $source_block, $parent_block ) {

	if ( ! $parent_block && ! is_admin() && ! wp_is_json_request() ) {
		$parsed_block['attrs']['toWrap'] = 1;
	}

	return $parsed_block;
}

add_filter( 'render_block_data', 'ground_block_data_pre_render', 12, 3 );

/**
 * Add a custom class to native wp blocks
 *
 * @param [type]  $block The block settings and attributes.
 * @param string  $class Additional classes to add to the block.
 * @param boolean $return Whether to return or echo the block.
 * @return void
 */
function ground_block_class( $block, $class = '', $return = true ) {

	$block_name = $block['name'];

	$pattern    = '/(.*?)\//';
	$block_name = preg_replace( $pattern, '', $block_name );
	$class     .= ' ground-block-' . $block_name;

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

/**
 * Retreive the first opening tag of block
 *
 * @param string $block_content The content block to handle.
 * @return string
 */
function get_opening_tag( $block_content ) {
	preg_match( '/^(<.+?>)/', trim( $block_content ), $re );

	if ( count( $re ) > 0 ) {
		return $re[1];
	}

	return '';
}
