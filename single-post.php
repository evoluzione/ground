<?php
/**
 * Single posts
 *
 * @package Ground
 */

get_template_part( 'template-parts/header' );

while ( have_posts() ) :
	the_post(); ?>

		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
		<?php get_template_part( 'template-parts/content', 'single-post' ); ?>

	<?php
endwhile;

get_template_part( 'template-parts/footer' );
