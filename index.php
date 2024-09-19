<?php
/**
 * Index
 */

get_template_part( 'template-parts/header/header-primary' ); ?>

<main class="container">

	<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

	<header class="mb-6">
		<h1 class="text-4xl"><?php single_post_title(); ?></h1>
	</header>

	<?php if ( is_home() ) {
		$page_for_posts_id = get_option( 'page_for_posts' );
		echo '<div class="prose mb-6">' . apply_filters( 'the_content', get_post_field( 'post_content', $page_for_posts_id ) ) . '</div>';
	} ?>

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
