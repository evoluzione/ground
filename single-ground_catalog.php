<?php get_template_part( 'partials/header' ); ?>

	<div class="gr-12 gr-9@md push-3@md">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

			get_template_part( 'partials/content', 'single-ground_catalog' );

		endwhile; endif; ?>

	</div>

	<div class="gr-12 gr-3@md pull-9@md">
		<?php get_template_part( 'partials/sidebar', 'secondary' ); ?>
	</div>

<?php get_template_part( 'partials/footer' ); ?>
