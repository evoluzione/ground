<?php
/**
 * Pages
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' );

while ( have_posts() ) :

	the_post();

	/**
	 * Hook: ground_page_before.
	 *
	 * @hooked ground_breadcrumbs - 20
	 */
	do_action( 'ground_page_before' );

	get_template_part( 'template-parts/page/page-content' );

	/**
	 * Hook: ground_page_after.
	 */
	do_action( 'ground_page_after' );

endwhile;

get_template_part( 'template-parts/footer/footer' );
