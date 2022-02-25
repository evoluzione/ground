<?php
/**
 * Error 404 Page (not found)
 *
 * @package Ground
 */

get_template_part( 'template-parts/header/header' );
?>

	<article class="page page--404">

		<header class="page__header">
			<h1 class="page__title"><?php esc_html_e( 'Oops!', 'ground' ); ?></h1>
		</header>

		<div class="page__body">
			<h3><?php esc_html_e( "The page you're looking for can't be found", 'ground' ); ?></h3>
			<p><em><?php esc_html_e( 'Error code: 404', 'ground' ); ?></em></p>
		</div> <!-- End .page__body -->

	</article> <!-- End .page -->

<?php
get_template_part( 'template-parts/footer/footer' );
