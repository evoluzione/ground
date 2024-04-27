<?php
/**
 * Archive blog
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' ); ?>

<main class="container">
	<header class="">
		<h1 class="text-4xl"><?php single_post_title(); ?></h1>
	</header>

	<?php while ( have_posts() ) :

		the_post(); ?>

		<?php get_template_part( 'template-parts/preview/preview-post' ); ?>

	<?php endwhile; ?>

	<?php ground_pagination( [] ); ?>
</main>

<?php get_template_part( 'template-parts/footer/footer' );
