<?php

/**
 * Aggiungo i file js che servono a gestire i blocchi Gutenberg
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
 * Function to handle custom class to core blocks
 *
 * @param string $block_content The content of the block.
 * @param array  $block The object block.
 * @return string
 */
function ground_wp_blocks_handle_custom_class( string $block_content, array $block ) {

	$block_name = $block['blockName'];

	// Skip empty blocks
	$is_empty = strlen(trim($block_content)) == 0;
	if ( !$block_name && $is_empty ) return $block_content;

	// Classic editor has no name but has content
	$is_classic_editor = !$block_name && !$is_empty;

	$has_class     = strpos( $block_content, 'class="' );
	$is_fullscreen = strpos( $block_content, 'is-fullscreen' );

	switch ($block_name) {
		case 'core/paragraph':
			$block_content = ground_wp_blocks_add_custom_class( $block_content, $has_class, 'wp-block-paragraph' );
			break;

		case 'core/heading':
			$block_content = ground_wp_blocks_add_custom_class( $block_content, $has_class, 'wp-block-heading' );
			break;

		case 'core/list':
			$block_content = ground_wp_blocks_add_custom_class( $block_content, $has_class, 'wp-block-list' );
			break;
		
		case 'core/image':
			// Add wp-block class to block and avoid to wrap it because of core/gallery
			$block_content = ground_wp_blocks_add_custom_class( $block_content, $has_class, 'wp-block' );
			break;
		
		default:
			break;
	}
	
	if ( $is_classic_editor || is_block_to_wrap($block_name) ) {
		$additional_classes = 'wp-block';
		$additional_classes .= $is_classic_editor ? ' wp-block-classic-editor' : '';
		$additional_classes .= $is_fullscreen ? ' is-fullscreen' : '';

		$block_content      = '<div class="' . $additional_classes . '">' . $block_content . '</div>';
	}

	// var_dump($block_name);

	return $block_content;
}

add_filter( 'render_block', 'ground_wp_blocks_handle_custom_class', 10, 2 );

/**
 * Function to determine if wrap the block with custom div
 *
 * @param string $block_name
 * @return boolean
 */
function is_block_to_wrap( string $block_name ) {
	// Avoid to wrap native blocks because of style e.g. columns
	$blocks_black_list = array('core/column', 'core/image', 'core/cover', 'core/button');
	return ! in_array( $block_name , $blocks_black_list );
}

/**
 * Function to add a custom class to native wp blocks
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
