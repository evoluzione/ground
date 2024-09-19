<?php
/**
 * Front page
 */

get_template_part( 'template-parts/header/header-primary' ); ?>

<main class="container">

	<?php while ( have_posts() ) :

		the_post();
		get_template_part( 'template-parts/content/content-front-page' );

	endwhile; ?>

</main>

<?php get_template_part( 'template-parts/footer/footer-primary' );
