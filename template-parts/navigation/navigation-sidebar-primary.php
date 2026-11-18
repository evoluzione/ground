<?php
/**
 * Pages of the current section.
 *
 * One foreach per level shown: two here, nest another for a third.
 */
$items = ground_subpages();

if ( ! $items ) {
	return;
}
?>
<nav aria-label="<?php esc_attr_e( 'In this section', 'ground' ); ?>">
	<ul>
		<?php foreach ( $items as $item ) : ?>
			<li>
				<a class="hover:text-primary current:text-primary" <?php echo ground_link_attributes( $item ); ?>><?php echo wp_kses_post( $item['title'] ); ?></a>

				<?php if ( $item['children'] ) : ?>
					<ul class="pl-6">
						<?php foreach ( $item['children'] as $child ) : ?>
							<li>
								<a class="hover:text-primary current:text-primary" <?php echo ground_link_attributes( $child ); ?>><?php echo wp_kses_post( $child['title'] ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
