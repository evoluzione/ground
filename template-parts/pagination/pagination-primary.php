<?php
/**
 * Pagination of the main query, or of the query passed as 'query'.
 */
$query = $args['query'] ?? $wp_query;

$links = ground_pagination( [
	'total' => $query->max_num_pages,
	'mid_size' => 1,
] );

if ( ! $links ) {
	return;
}
?>
<nav class="flex justify-center" aria-label="<?php esc_attr_e( 'Pagination', 'ground' ); ?>">
	<ul class="flex gap-4">
		<?php foreach ( $links as $link ) : ?>
			<li>
				<?php if ( 'prev' === $link['type'] ) : ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>">&laquo; <?php esc_html_e( 'Previous', 'ground' ); ?></a>
				<?php elseif ( 'next' === $link['type'] ) : ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>"><?php esc_html_e( 'Next', 'ground' ); ?> &raquo;</a>
				<?php elseif ( 'dots' === $link['type'] ) : ?>
					<span>&hellip;</span>
				<?php elseif ( $link['current'] ) : ?>
					<?php // A bare "3" says nothing out of context: screen readers hear "Page 3". ?>
					<span class="font-bold text-primary" aria-current="page"><span class="sr-only"><?php esc_html_e( 'Page', 'ground' ); ?> </span><?php echo esc_html( $link['number'] ); ?></span>
				<?php else : ?>
					<a href="<?php echo esc_url( $link['url'] ); ?>"><span class="sr-only"><?php esc_html_e( 'Page', 'ground' ); ?> </span><?php echo esc_html( $link['number'] ); ?></a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
