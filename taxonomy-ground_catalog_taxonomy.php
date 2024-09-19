<?php
/**
 * Taxonomy: ground_catalog_taxonomy
 */
get_template_part( 'template-parts/header/header-primary' ); ?>

<main class="container">

	<div class="grid grid-cols-12 gap-6">

		<div class="col-span-2">
			<?php
			ground_terms( [ 
				'taxonomy' => 'ground_catalog_taxonomy',
				//'child_of' => get_queried_object_id(),
			] );
			?>
		</div>

		<div class="col-span-10">

			<header class="mb-6">
				<h1 class="text-4xl"><?php single_cat_title(); ?></h1>
			</header>
			<?php if ( get_the_archive_description() ) : ?>
				<div class="prose mb-6"><?php the_archive_description(); ?></div>
			<?php endif; ?>

			<?php
			$term_id = get_queried_object_id();
			$taxonomies = get_terms( [ 
				'taxonomy' => 'ground_catalog_taxonomy',
				// 'child_of' => $term_id,
				'parent' => $term_id,
			] );

			// Taxonomies first.
			if ( ! empty( $taxonomies ) && ! is_wp_error( $taxonomies ) ) : ?>

				<div class="grid grid-cols-4 gap-6">
					<?php foreach ( $taxonomies as $taxonomy ) {
						get_template_part( 'template-parts/preview/preview-ground_catalog_taxonomy', null, [ 'taxonomy' => $taxonomy ] );
					} ?>
				</div>

			<?php else : // Show Products.
			
				if ( have_posts() ) : ?>
					<div class="grid grid-cols-4 gap-6">
						<?php while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/preview/preview-ground_catalog' );
						endwhile; ?>
					</div>
					<?php get_template_part( 'template-parts/pagination/pagination-primary' );
				endif;

			endif; ?>

		</div>

	</div>

</main>

<?php get_template_part( 'template-parts/footer/footer-primary' );
