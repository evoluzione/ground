<?php
/**
 * Search results pages
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' ); ?>

<section class="page page--search">

	<header class="page__header">
		<h1 class="page__title">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'ground' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h1>
	</header>

	<div class="page__body">

	<?php
	if ( have_posts() ) {

		while ( have_posts() ) :

			the_post();

			/**
			 * Hook: ground_search_post_before.
			 *
			 * @hooked ground_breadcrumbs - 20
			 */
			do_action( 'ground_search_post_before' );
			?>

			<?php get_template_part( 'template-parts/search/search-content' ); ?>

			<?php
			/**
			 * Hook: ground_search_post_after.
			 */
			do_action( 'ground_search_post_after' );

		endwhile;

		get_template_part( 'template-parts/shared/pagination' );

	} else {
		?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ground' ); ?></p>
		<?php
	}

	get_template_part( 'template-parts/footer/footer' );
