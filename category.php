<?php
/**
 * Post category
 */
get_template_part( 'template-parts/header/header-primary' ); ?>

<main class="container">

	<header class="mb-6">
		<h1 class="text-4xl"><?php single_cat_title(); ?></h1>
	</header>

	<?php if ( category_description() ) : ?>
		<div class="prose mb-6"><?php echo category_description(); ?></div>
	<?php endif; ?>

	<div class="grid grid-cols-12 gap-6">

		<div class="col-span-10">

			<?php while ( have_posts() ) :

				the_post(); ?>

				<?php get_template_part( 'template-parts/preview/preview-post' ); ?>

			<?php endwhile; ?>

			<?php get_template_part( 'template-parts/pagination/pagination-primary' ); ?>

		</div>

		<div class="col-span-2">
			<?php get_template_part( 'template-parts/sidebar/sidebar-secondary' ); ?>
		</div>

	</div>

</main>

<?php get_template_part( 'template-parts/footer/footer-primary' );
