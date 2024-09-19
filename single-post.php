<?php
/**
 * Single post
 */

get_template_part( 'template-parts/header/header-primary' );

while ( have_posts() ) :

	the_post();
	get_template_part( 'template-parts/content/content-post' );

endwhile;

get_template_part( 'template-parts/footer/footer-primary' );
