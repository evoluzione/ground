<?php
/**
 * Starter Block template.
 * Register block here: "config/blocks.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True when rendered in the block editor (ACF Blocks v3: always a live preview, no separate edit/preview mode).
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$example = get_field( 'title' );
?>

<div <?php echo ground_block_attributes( $block, 'ground-block', $is_preview ); ?>>
	Starter: <?php echo esc_html( $example ); ?>
</div>
