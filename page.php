<?php

/**
 * Pages
 *
 * @package Ground
 */

get_template_part( 'template-parts/header' );
?>

	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'page' );

	endwhile;
	?>

<?php
get_template_part( 'template-parts/footer' );
