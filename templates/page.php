<?php
/**
 * Pages
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' );

while ( have_posts() ) :

	the_post();

	get_template_part( 'template-parts/content/content-page' );

endwhile;

get_template_part( 'template-parts/footer/footer' );
