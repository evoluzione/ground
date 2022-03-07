<?php

/**
 * Aggiungo i file js che servono a gestire i blocchi Gutenberg
 */


function ground_enqueue_gutenberg_script()
{
	global $pagenow;

	// In widget page wp-editor is already a dependency.
	if ($pagenow === 'widgets.php') {
		$deps = array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-components');
	} else {
		$deps = array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor');
	}

	$path      = get_template_directory_uri() . '/dist/js/ground-gutenberg.min.js';
	$in_footer = true;

	wp_enqueue_script('ground/gutenberg', $path, $deps, false, $in_footer);
}
if (is_admin()) {
	add_action('enqueue_block_assets', 'ground_enqueue_gutenberg_script');
}

/**
 * Function to handle custom class to core blocks
 *
 * @param string $block_content The content of the block.
 * @param array  $block The object block.
 * @return string
 */
function ground_wp_blocks_handle_custom_class(string $block_content, array $block)
{

	$has_class = strpos($block_content, 'class="');

	/**
	 * Paragraph
	 */
	if ($block['blockName'] === 'core/paragraph') {
		return ground_wp_blocks_add_custom_class($block_content, $has_class, 'wp-block-paragraph');
	}

	/**
	 * Heading
	 */
	if ($block['blockName'] === 'core/heading') {
		return ground_wp_blocks_add_custom_class($block_content, $has_class, 'wp-block-heading');
	}

	/**
	 * List
	 */
	if ($block['blockName'] === 'core/list') {
		return ground_wp_blocks_add_custom_class($block_content, $has_class, 'wp-block-list');
	}

	return $block_content;
}
add_filter('render_block', 'ground_wp_blocks_handle_custom_class', 10, 2);

/**
 * Function to add a custom class to native wp blocks
 *
 * @param string  $block_content The content block to handle.
 * @param boolean $has_class Detect if the block has already a class.
 * @param string  $class_to_add The class to add.
 * @return string
 */
function ground_wp_blocks_add_custom_class($block_content, $has_class, $class_to_add)
{
	if (!$has_class) {
		// Add class attribute.
		// Detect paragraph, heading tag, ordered and unordered list
		$pattern = '/<(p|h\d|[uo]l)(.*)/i';
		$replacement = '<$1 class=""$2';
		$block_content = preg_replace($pattern, $replacement, $block_content);
	}

	// Append custom class.
	$pattern = '/class="(.*)"/';
	$replacement =  'class="' . $class_to_add . ($has_class ? ' ' : '') . '$1"';
	return preg_replace($pattern, $replacement, $block_content);
}
