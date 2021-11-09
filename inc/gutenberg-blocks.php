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
