<?php

/**
 * Pages
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' );
?>

	<?php get_template_part( 'template-parts/shared/breadcrumbs' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/page/page-content' );

	endwhile;
	?>

<?php
get_template_part( 'template-parts/footer/footer' );
