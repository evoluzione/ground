<?php
/**
 * Single posts
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' );

while ( have_posts() ) :
	the_post(); ?>

		<?php get_template_part( 'template-parts/shared/breadcrumbs' ); ?>
		<?php get_template_part( 'template-parts/content/post-content' ); ?>

	<?php
endwhile;

get_template_part( 'template-parts/footer/footer' );
