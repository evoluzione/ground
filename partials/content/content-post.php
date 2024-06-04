<main>
	<article class="container">

		<header class="mb-6">
			<h1 class="text-4xl"><?php the_title(); ?></h1>
		</header>

		<?php ground_image( [ 
			'size' => '16-9-large',
			'attr' => [ 
				'class' => 'aspect-[16/9] object-cover w-full mb-6',
				'alt' => get_the_title(),
			],
		] ); ?>

		<div class="prose">
			<?php the_content(); ?>
		</div>

		<?php if ( has_tag() ) { ?>
			<footer class="my-6"><?php _e( 'Tags' ) ?>: <?php ground_tags( 'hover:text-primary' ); ?></footer>
		<?php } ?>

	</article> <!-- End .container -->
</main>