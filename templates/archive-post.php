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

	<?php ground_pagination( [ 
		'nav_class' => 'flex justify-center',
		'list_class' => 'flex',
		'prev_class' => 'pl-3 py-1',
		'next_class' => 'pr-3 py-1',
		'dots_class' => 'px-3 py-1',
		'page_class' => 'px-3 py-1',
		'page_active_class' => 'px-3 py-1 font-bold text-primary',
	] ); ?>
</main>

<?php get_template_part( 'template-parts/footer/footer' );
