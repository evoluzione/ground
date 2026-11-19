<?php
/**
 * Template Name: Catalog
 *
 */

// The catalog opens on its categories and lists the items where there are
// none. To always list the items, replace the call with: $categories = [];
$categories = get_terms( [
	'taxonomy' => 'ground_catalog_taxonomy',
	'parent' => 0,
] );

// Same reading as ground_pagination(): a static front page moves the number to 'page'.
$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );

// Paged and ordered as the post type's 'listing' in config/post-types.php says.
$items = $categories ? null : new WP_Query( [
	'post_type' => 'ground_catalog',
	'posts_per_page' => ground_config( 'post-types.post_types.ground_catalog.listing.per_page' ),
	'orderby' => ground_config( 'post-types.post_types.ground_catalog.listing.orderby' ),
	'paged' => $paged,
] );

// A page past the last one is a 404, as on the blog. The main query is the
// page itself, so WordPress can't tell: decided here, before the header, while
// the response can still change.
if ( $paged > 1 && ! $items?->have_posts() ) {
	ground_not_found();

	return;
}

get_template_part( 'template-parts/header/header-primary' ); ?>

<div class="container">

	<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
		<div class="order-last lg:order-0 lg:col-span-2">
			<?php get_template_part( 'template-parts/sidebar/sidebar-tertiary' ); ?>
		</div>

		<div class="lg:col-span-10">

			<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

			<?php while ( have_posts() ) :
				the_post();
				?>

				<?php get_template_part( 'template-parts/content/content-page' ); ?>

				<?php get_template_part( 'template-parts/loop/loop-ground_catalog', null, [
					'categories' => $categories,
					'query' => $items,
				] ); ?>

			<?php endwhile; ?>
		</div>

	</div>
</div>

<?php get_template_part( 'template-parts/footer/footer-primary' );
