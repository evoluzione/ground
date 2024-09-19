<?php
/**
 * Single ground_catalog
 */

get_template_part( 'template-parts/header/header-primary' );

while ( have_posts() ) :

	the_post();
	get_template_part( 'template-parts/content/content-ground_catalog' );

endwhile;

get_template_part( 'template-parts/footer/footer-primary' );
