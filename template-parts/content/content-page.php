<main>
	<article class="container">

		<header>
			<h1 class="text-4xl"><?php the_title(); ?></h1>
		</header>

		<?php //TODO: FIX ?>
		<?php if ( has_post_thumbnail() ) { ?>
			<figure class="media">
				<?php ground_image( '1-1-large', [ 
					'attr' => [ 
						'class' => 'media__img full-width',
					],
				] ); ?>
			</figure>
		<?php } ?>

		<div class="prose">
			<?php the_content(); ?>
		</div>

	</article> <!-- End .container -->
</main>