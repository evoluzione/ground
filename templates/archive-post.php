<?php
/**
 * Archive blog
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' ); ?>

<main class="container grid grid-cols-12 gap-6">

	<div class="col-span-2">
		<?php get_template_part( 'template-parts/sidebar/sidebar-secondary' ); ?>
	</div>

	<div class="col-span-10">

		<header class="">
			<h1 class="text-4xl"><?php single_post_title(); ?></h1>
		</header>

		<?php while ( have_posts() ) :

			the_post(); ?>

			<?php get_template_part( 'template-parts/preview/preview-post' ); ?>

		<?php endwhile; ?>

		<?php get_template_part( 'template-parts/pagination/pagination-primary' ); ?>

	</div>

</main>

<?php get_template_part( 'template-parts/footer/footer' );
