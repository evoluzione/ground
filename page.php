<?php
/**
 * Pages
 */

get_template_part( 'template-parts/header/header-primary' ); ?>

<main class="container grid grid-cols-1 lg:grid-cols-12 gap-6">

	<div class="order-last lg:order-none lg:col-span-2">
		<?php get_template_part( 'template-parts/sidebar/sidebar-primary' ); ?>
	</div>

	<div class="lg:col-span-10">

		<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

		<?php while ( have_posts() ) :

			the_post();
			get_template_part( 'template-parts/content/content-page' );

		endwhile; ?>
	</div>

</main>

<?php get_template_part( 'template-parts/footer/footer-primary' );
