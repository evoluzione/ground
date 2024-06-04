<?php
/**
 * Pages
 *
 * @package Ground
 */

get_template_part( 'partials/header/header' ); ?>

<main class="container grid grid-cols-12 gap-6">

	<div class="col-span-2">
		<?php get_template_part( 'partials/sidebar/sidebar-primary' ); ?>
	</div>

	<div class="col-span-10">
		<?php while ( have_posts() ) :

			the_post();

			get_template_part( 'partials/content/content-page' );

		endwhile; ?>
	</div>

</main>

<?php get_template_part( 'partials/footer/footer' );
