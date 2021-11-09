<?php

/**
 * Aggiungo i file js che servono a gestire i blocchi Gutenberg
 */

add_action(
	'enqueue_block_assets',
	function () {
		$deps = array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor' );

		wp_enqueue_script( 'ground-gutenberg-extraprops', get_template_directory_uri() . '/src/blocks-getSaveContent-extraProps.js', $deps );
		wp_enqueue_script( 'ground-gutenberg-registerblockstyle', get_template_directory_uri() . '/src/blocks-registerBlockStyle.js', $deps );
		wp_enqueue_script( 'ground-gutenberg-registerblocktype', get_template_directory_uri() . '/src/blocks-registerBlockType.js', $deps );
	}
);


function ground_wp_blocks_add_custom_class( string $block_content, array $block ) {

	$has_class       = strpos( $block_content, 'class="' );
	$class_paragraph = 'wp-block-paragraph';
	$class_heading   = 'wp-block-heading';
	$class_list      = 'wp-block-list';

	/**
	 * Paragraph
	 */
	if ( $block['blockName'] === 'core/paragraph' ) {
		return handle_function_class_paragraph( $block_content, $has_class, $class_paragraph );
	}

	/**
	 * Heading
	 */
	if ( $block['blockName'] === 'core/heading' ) {
		return handle_function_class_heading( $block_content, $has_class, $class_heading );
	}

	/**
	 * List
	 */
	if ( $block['blockName'] === 'core/list' ) {
		return handle_function_class_list( $block_content, $has_class, $class_list );
	}

	return $block_content;
}
add_filter( 'render_block', 'ground_wp_blocks_add_custom_class', 10, 2 );

/**
 * Function to add a custom class to paragraph block
 *
 * @param string  $block_content Is the block to handle.
 * @param boolean $has_class It detect if the block has a class.
 * @param string  $class_to_add Is the class to add.
 * @return string
 */
function handle_function_class_paragraph( $block_content, $has_class, $class_to_add ) {
	// Add class attribute.
	$new_block_content = preg_replace( '/<p>/i', '<p class="">', $block_content );
	// Appen custom class.
	return preg_replace( '/class="(.*)"/', 'class="' . $class_to_add . ( $has_class ? ' ' : '' ) . '$1"', $new_block_content );
}

/**
 * Function to add a custom class to heading block
 *
 * @param string  $block_content Is the block to handle.
 * @param boolean $has_class It detect if the block has a class.
 * @param string  $class_to_add Is the class to add.
 * @return string
 */
function handle_function_class_heading( $block_content, $has_class, $class_to_add ) {
	// Add class attribute.
	$new_block_content = preg_replace( '/<h(.)>/i', '<h$1 class="">', $block_content );
	// Appen custom class.
	return preg_replace( '/class="(.*)"/', 'class="' . $class_to_add . ( $has_class ? ' ' : '' ) . '$1"', $new_block_content );
}

/**
 * Function to add a custom class to list block
 *
 * @param string  $block_content Is the block to handle.
 * @param boolean $has_class It detect if the block has a class.
 * @param string  $class_to_add Is the class to add.
 * @return string
 */
function handle_function_class_list( $block_content, $has_class, $class_to_add ) {
	// Add class attribute.
	$new_block_content = preg_replace( '/<(ol|ul)>/i', '<$1 class="">', $block_content );
	// Appen custom class.
	return preg_replace( '/class="(.*)"/', 'class="' . $class_to_add . ( $has_class ? ' ' : '' ) . '$1"', $new_block_content );
}
