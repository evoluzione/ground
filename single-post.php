<?php
/**
 * Single posts
 *
 * @package Ground
 */

get_template_part( 'partials/header' );

while ( have_posts() ) :
	the_post(); ?>

		<?php get_template_part( 'partials/breadcrumbs' ); ?>
		<?php get_template_part( 'partials/content', 'single-post' ); ?>

	<?php
endwhile;

get_template_part( 'partials/footer' );
