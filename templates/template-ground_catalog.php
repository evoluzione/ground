<?php
/**
 * Template Name: Catalog
 *
 */
get_template_part( 'template-parts/header/header-primary' ); ?>

<div class="container">

	<div class="grid grid-cols-12 gap-6">

		<div class="col-span-2">
			<?php
			ground_terms( [ 
				'taxonomy' => 'ground_catalog_taxonomy',
			] );
			?>
		</div>

		<div class="col-span-10">

			<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

			<?php while ( have_posts() ) :
				the_post();
				?>

				<?php get_template_part( 'template-parts/content/content-page' ); ?>

				<?php // Taxonomies first.
					$taxonomies = get_terms( [ 
						'taxonomy' => 'ground_catalog_taxonomy',
						'parent' => 0,
					] );

					if ( ! empty( $taxonomies ) && ! is_wp_error( $taxonomies ) ) : ?>

					<div class="grid grid-cols-4 gap-6">
						<?php foreach ( $taxonomies as $taxonomy ) {
							get_template_part( 'template-parts/preview/preview-ground_catalog_taxonomy', null, [ 'taxonomy' => $taxonomy ] );
						} ?>
					</div>

				<?php else : // Show Products.
				
						$query = new WP_Query( [ 
							'post_type' => 'ground_catalog',
							'orderby' => 'menu_order',
							'posts_per_page' => 12,
							'paged' => get_query_var( 'paged' ) ?: 1,
						] );

						if ( $query->have_posts() ) : ?>
						<div class="grid grid-cols-4 gap-6">
							<?php
							while ( $query->have_posts() ) :
								$query->the_post();
								get_template_part( 'template-parts/preview/preview-ground_catalog' );
							endwhile; ?>
						</div>
						<?php
						get_template_part( 'template-parts/pagination/pagination-primary', null, [ 'query' => $query ] );
						wp_reset_postdata();
						endif;

					endif; ?>
			</div>

		<?php endwhile; ?>

	</div>
</div>

<?php get_template_part( 'template-parts/footer/footer-primary' );
