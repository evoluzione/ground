<?php
/**
 * Taxonomy: ground_catalog_taxonomy
 */
get_template_part( 'template-parts/header/header-primary' ); ?>

<main class="container">

	<div class="grid grid-cols-12 gap-6">

		<div class="col-span-2">
			<?php get_template_part( 'template-parts/sidebar/sidebar-tertiary' ); ?>
		</div>

		<div class="col-span-10">

			<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

			<header class="mb-6">
				<h1 class="text-4xl"><?php single_term_title(); ?></h1>
			</header>
			<?php if ( get_the_archive_description() ) : ?>
				<div class="prose max-w-none mb-6"><?php the_archive_description(); ?></div>
			<?php endif; ?>

			<?php
			$term = get_queried_object();
			get_template_part( 'template-parts/catalog/catalog-browser', null, [
				'mode'     => ground_config( 'catalog.mode' ),
				'parent'   => $term->term_id,
				'per_page' => ground_config( 'catalog.per_page' ),
			] ); ?>

		</div>

	</div>

</main>

<?php get_template_part( 'template-parts/footer/footer-primary' );
