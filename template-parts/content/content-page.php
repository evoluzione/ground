<main>
	<article class="container">

		<header>
			<h1 class="text-4xl"><?php the_title(); ?></h1>
		</header>

		<?php ground_image( [ 
			'size' => '1-1-large',
			'attr' => [ 
				'class' => 'aspect-[3/2] object-cover w-full',
			],
			'alt' => get_the_title(),
			'default_image' => '',
		] ); ?>

		<div class="prose">
			<?php the_content(); ?>
		</div>

	</article> <!-- End .container -->
</main>