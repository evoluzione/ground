<?php
/**
 * Search results pages
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' );

while ( have_posts() ) :

	the_post();

	/**
	 * Hook: ground_search_post_before.
	 *
	 * @hooked ground_breadcrumbs - 20
	 */
	do_action( 'ground_search_post_before' );

	get_template_part( 'template-parts/search/search-content' );

	/**
	 * Hook: ground_search_post_after.
	 */
	do_action( 'ground_search_post_after' );

endwhile;

get_template_part( 'template-parts/footer/footer' );
