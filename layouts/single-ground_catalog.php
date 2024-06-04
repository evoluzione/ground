<?php
/**
 * Search
 */

get_template_part( 'partials/header/header' );

while ( have_posts() ) :

	the_post();

	/**
	 * Hook: ground_page_before.
	 *
	 * @hooked ground_breadcrumbs - 20
	 */
	do_action( 'ground_page_before' );

	//get_template_part( 'partials/content/content-page' );

	echo "SINGLE GROUND CATALOG";

	/**
	 * Hook: ground_page_after.
	 */
	do_action( 'ground_page_after' );

endwhile;

get_template_part( 'partials/footer/footer' );
