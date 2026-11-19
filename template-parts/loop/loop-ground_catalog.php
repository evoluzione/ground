<?php
/**
 * Catalog loop — renders the categories or the items of one catalog level.
 *
 * Args:
 *   - categories (WP_Term[])  Categories to list. Default none: items are listed.
 *   - query      (WP_Query)   Items to list. Default the main query.
 *
 * @var array $args
 */

$categories = $args['categories'] ?? [];
$query = $args['query'] ?? $wp_query;

if ( $categories ) : ?>

	<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
		<?php foreach ( $categories as $category ) {
			get_template_part( 'template-parts/preview/preview-ground_catalog_taxonomy', null, [ 'taxonomy' => $category ] );
		} ?>
	</div>

<?php elseif ( $query->have_posts() ) : ?>

	<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
		<?php while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( 'template-parts/preview/preview-ground_catalog' );
		endwhile; ?>
	</div>
	<?php get_template_part( 'template-parts/pagination/pagination-primary', null, [ 'query' => $query ] );

	wp_reset_postdata();

endif;
