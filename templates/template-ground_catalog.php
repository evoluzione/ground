<?php
/**
 * Template Name: Catalog
 *
 */
get_template_part( 'template-parts/header/header-primary' ); ?>

<div class="container">

	<div class="grid grid-cols-12 gap-6">
		<div class="col-span-2">
			<?php get_template_part( 'template-parts/sidebar/sidebar-tertiary' ); ?>
		</div>

		<div class="col-span-10">

			<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

			<?php while ( have_posts() ) :
				the_post();
				?>

				<?php get_template_part( 'template-parts/content/content-page' ); ?>

				<?php get_template_part( 'template-parts/loop/loop-ground_catalog', null, [
						'mode'     => ground_config( 'catalog.mode' ),
						'parent'   => 0,
						'per_page' => ground_config( 'catalog.per_page' ),
					] ); ?>

			<?php endwhile; ?>
			</div>

	</div>
</div>

<?php get_template_part( 'template-parts/footer/footer-primary' );
