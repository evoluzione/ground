<?php

/**
 * Pages
 *
 * @package Ground
 */

get_template_part( 'partials/header' );
?>

	<?php get_template_part( 'partials/breadcrumbs' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'partials/content', 'page' );

	endwhile;
	?>

<?php
get_template_part( 'partials/footer' );
