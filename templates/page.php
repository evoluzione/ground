<?php
/**
 * Pages
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' ); ?>

<main class="container grid grid-cols-12 gap-6">

	<div class="col-span-2">
		<?php get_template_part( 'template-parts/sidebar/sidebar-primary' ); ?>
	</div>

	<div class="col-span-10">
		<?php while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content/content-page' );

		endwhile; ?>
	</div>

</main>

<?php get_template_part( 'template-parts/footer/footer' );
