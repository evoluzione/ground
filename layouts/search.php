<?php
/**
 * Search results pages
 */

get_template_part( 'partials/header/header' ); ?>

<section class="page page--search">

	<div class="container">
		<header class="page__header">
			<h1 class="page__title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'ground' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
		</header>
	</div>

	<div class="page__body">

		<div class="grid grid-cols-12 gap-6">

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

					<?php get_template_part( 'partials/content/content-search' ); ?>

					<?php
					/**
					 * Hook: ground_search_post_after.
					 */
					do_action( 'ground_search_post_after' );

				endwhile;

				?>

				<div class="col-span-12">

					<?php get_template_part( 'partials/shared/pagination' ); ?>

				</div>

				<?php
			} else {
				?>
				<div class="col-span-12">
					<p>
						<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ground' ); ?>
					</p>
				</div>
				<?php
			}

			?>

		</div>

	</div>

	<?php
	get_template_part( 'partials/footer/footer' );
