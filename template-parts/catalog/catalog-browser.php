<?php
/**
 * Catalog browser — renders catalog categories or products for one level.
 *
 * Args:
 *   - mode     (string) 'auto' | 'products'. Default 'auto'.
 *   - parent   (int)    Parent term ID (0 = top level / all products). Default 0.
 *   - per_page (int)    Products per page. Default 12.
 *
 * In 'auto' mode the categories under $parent are listed; when there are none
 * (leaf level) the products of that term are shown instead. In 'products' mode
 * categories are skipped and products are always listed, filtered by $parent.
 *
 * @var array $args
 */

$mode     = $args['mode'] ?? 'auto';
$parent   = (int) ( $args['parent'] ?? 0 );
$per_page = (int) ( $args['per_page'] ?? 12 );

$terms = ( 'products' === $mode ) ? [] : get_terms( [
	'taxonomy'   => 'ground_catalog_taxonomy',
	'parent'     => $parent,
	'pad_counts' => true, // conta anche i prodotti delle sotto-categorie
] );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>

	<div class="grid grid-cols-4 gap-6">
		<?php foreach ( $terms as $term ) {
			get_template_part( 'template-parts/preview/preview-ground_catalog_taxonomy', null, [ 'taxonomy' => $term ] );
		} ?>
	</div>

<?php else :

	$query = new WP_Query( [
		'post_type'      => 'ground_catalog',
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'posts_per_page' => $per_page,
		'paged'          => max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) ),
		'tax_query'      => $parent ? [ [
			'taxonomy' => 'ground_catalog_taxonomy',
			'terms'    => $parent,
		] ] : [],
	] );

	if ( $query->have_posts() ) : ?>
		<div class="grid grid-cols-4 gap-6">
			<?php while ( $query->have_posts() ) :
				$query->the_post();
				get_template_part( 'template-parts/preview/preview-ground_catalog' );
			endwhile; ?>
		</div>
		<?php get_template_part( 'template-parts/pagination/pagination-primary', null, [ 'query' => $query ] );
	endif;

	wp_reset_postdata();

endif;
