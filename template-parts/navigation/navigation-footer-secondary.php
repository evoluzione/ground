<?php
/**
 * Footer secondary menu: one level.
 */
$items = ground_menu( 'navigation-footer-secondary' );

if ( ! $items ) {
	return;
}
?>
<nav class="flex" aria-label="<?php esc_attr_e( 'Footer secondary menu', 'ground' ); ?>">
	<ul class="flex flex-wrap gap-4 list-none">
		<?php foreach ( $items as $item ) : ?>
			<li>
				<a class="hover:text-primary current:text-primary" <?php echo ground_link_attributes( $item ); ?>><?php echo wp_kses_post( $item['title'] ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
