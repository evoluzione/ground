<article class="page">

	<?php if ( ! is_front_page() ) : ?>
		<header class="page__header">
			<h1 class="page__title"><?php the_title(); ?></h1>
		</header>
	<?php endif; ?>

	<div class="page__body">
		<?php if ( has_post_thumbnail() ) { ?>
			<figure class="media">
				<img class="media__img full-width" srcset="<?php ground_image( 'large' ); ?> 1200w,
						<?php ground_image( 'medium_large' ); ?> 768w,
						<?php ground_image( 'medium' ); ?> 480w" src="<?php ground_image( 'small' ); ?>">
			</figure>
		<?php } ?>

		<div class="
		<?php
		if ( class_exists( 'WooCommerce' ) && ! is_checkout() && ! is_cart() ) :
			echo 'prose';
		endif;
		?>
		">
			<?php the_content(); ?>
		</div>
	</div> <!-- End .page__body -->

	<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template( '/template-parts/comment/comments.php' );
	}
	?>

</article> <!-- End .page -->
