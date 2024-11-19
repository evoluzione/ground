<?php
/**
 * Starter Block template.
 * Register block here: "config/blocks.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$example = get_field( 'example' );

?>

<div <?php echo ground_block_attributes( $block, 'ground-block' ); ?>>
	Starter
</div>