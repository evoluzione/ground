<?php
/**
 * Secondary menu: one level.
 */
$items = ground_menu( 'navigation-header-secondary' );

if ( ! $items ) {
	return;
}
?>
<nav class="flex" aria-label="<?php esc_attr_e( 'Secondary menu', 'ground' ); ?>">
	<ul class="flex flex-wrap gap-4 list-none text-sm">
		<?php foreach ( $items as $item ) : ?>
			<li>
				<a class="hover:text-primary current:text-primary" <?php echo ground_link_attributes( $item ); ?>><?php echo wp_kses_post( $item['title'] ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
