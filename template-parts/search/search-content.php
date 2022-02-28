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
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/post/post-preview' );

		endwhile;

			get_template_part( 'template-parts/shared/pagination' );

		else :
			?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ground' ); ?></p>

		<?php endif; ?>

	</div> <!-- End .page__body -->

</section> <!-- End .page -->
