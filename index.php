<?php
/**
 * The main template file
 *
 * @package Ground
 */

get_template_part( 'partials/header' );
?>
<div class="container">
	<?php get_template_part( 'partials/breadcrumbs' ); ?>
</div>
	<div class="container relative mb-12 lg:mb-32">

		<?php get_template_part( 'partials/navigation', 'blog' ); ?>
		<section class="page page--blog">

			<?php
			if ( have_posts() ) :

				if ( single_post_title( '', false ) ) :
					?>
					<header class="page__header">
						<h1 class="page__title"><?php single_post_title(); ?></h1>
					</header>
				<?php endif; ?>

				<div class="page__body">

					<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-12 js-infinite-container">

						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'partials/abstract', 'post' );

						endwhile;
						?>

					</div>

				</div> <!-- End .page__body -->

				<?php get_template_part( 'partials/pagination' ); ?>

				<?php
			endif;
			?>

		</section> <!-- End .page -->

	</div> <!-- End .container -->

<?php
get_template_part( 'partials/footer' );
