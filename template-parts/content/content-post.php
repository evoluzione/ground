<main>
	<article class="container">

		<header>
			<h1 class="text-4xl"><?php the_title(); ?></h1>
		</header>

		<?php ground_image( [ 
			'size' => '16-9-large',
			'attr' => [ 
				'class' => 'aspect-[16/9] object-cover w-full',
				'alt' => get_the_title(),
			],
		] ); ?>

		<div class="prose">
			<?php the_content(); ?>
		</div>

	</article> <!-- End .container -->
</main>