<?php
/**
 * Posts homepage
 *
 * @package Ground
 */

get_template_part( 'partials/header/header' ); ?>

<main class="container grid grid-cols-12 gap-6">

	<div class="col-span-2">
		<?php get_template_part( 'partials/sidebar/sidebar-secondary' ); ?>
	</div>

	<div class="col-span-10">

		<header>
			<h1 class="text-4xl"><?php single_post_title(); ?></h1>
		</header>

		<?php while ( have_posts() ) :

			the_post(); ?>

			<?php get_template_part( 'partials/preview/preview-post' ); ?>

		<?php endwhile; ?>

		<?php get_template_part( 'partials/pagination/pagination-primary' ); ?>

	</div>

</main>

<?php get_template_part( 'partials/footer/footer' );
