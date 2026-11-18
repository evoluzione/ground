<?php
/**
 * Catalog categories.
 *
 * One foreach per level shown: two here, nest another for a third.
 */
$taxonomy = 'ground_catalog_taxonomy';
$items = ground_terms( [ 'taxonomy' => $taxonomy ] );

if ( ! $items ) {
	return;
}
?>
<?php // The landmark is named after the taxonomy, already translated where it's registered. ?>
<nav aria-label="<?php echo esc_attr( get_taxonomy( $taxonomy )->labels->name ); ?>">
	<ul class="list-disc ps-6 mb-24">
		<?php foreach ( $items as $item ) : ?>
			<li>
				<a class="current:text-primary" <?php echo ground_link_attributes( $item ); ?>><?php echo wp_kses_post( $item['title'] ); ?></a>

				<?php if ( $item['children'] ) : ?>
					<ul class="list-disc ps-6 pl-6">
						<?php foreach ( $item['children'] as $child ) : ?>
							<li>
								<a class="current:text-primary" <?php echo ground_link_attributes( $child ); ?>><?php echo wp_kses_post( $child['title'] ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
