<article class="page page--post-single">

	<div class="hero">

		<?php
		if ( has_post_thumbnail() ) { ?>
			<img class="hero__image" srcset="<?php ground_image( 'large' ); ?> 1200w,
						<?php ground_image( 'medium_large' ); ?> 768w,
						<?php ground_image( 'medium' ); ?> 480w" src="<?php ground_image( 'small' ); ?>">
				<div class="hero__image-filter" aria-hidden="true"></div>
				<?php
		}
		?>

		<div class="hero__body">
			<div class="grid grid-cols-12 gap-x-6">
				<div class="col-span-full lg:col-start-2 lg:col-span-3">
					<h1 class="color-typo-primary text-3xl font-bold py-3 lg:py-0"><?php the_title(); ?></h1>
				</div>
				<div class="col-span-full lg:col-start-6 lg:col-span-6">
					<div class="text-typo-primary text-base">
						<?php ground_excerpt( 9999 ); ?>
					</div>
				</div>
			</div>
		</div>

	</div>

	<header class="page__header hidden">
		<h1 class="page__title"><?php the_title(); ?></h1>
		<span class="page__data page__data--date"><time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time></span>
	</header>

	<div class="page__body">
		<?php the_content(); ?>
	</div> <!-- End .page__body -->

	<footer class="page__footer hidden">
		<span class="page__data page__data--category"><?php _e( 'Category', 'ground' ); ?>: <?php the_category( ', ' ); ?></span>
		<?php if ( comments_open() && ! post_password_required() ) { ?>
			<span class="page__data page__data--comments"><?php _e( 'Comments', 'ground' ); ?>: <?php comments_popup_link(); ?></span>
		<?php } ?>
		<?php
		if ( has_tag() ) {
			?>
			<?php the_tags( '<span class="page__data page__data--tag">', '', '</span>' ); ?><?php } ?>
	</footer> <!-- End .page__footer -->

	<?php
	// if ( comments_open() || get_comments_number() ) {
	// comments_template( '/partials/comments.php' );
	// }
	?>

</article> <!-- End .page -->
