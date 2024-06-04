<?php
/**
 * Home
 */

get_template_part( 'partials/header/header' );

while ( have_posts() ) :

	the_post();

	get_template_part( 'partials/content/content-home' );

endwhile;

get_template_part( 'partials/footer/footer' );
