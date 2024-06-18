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

		<footer class="my-6">
			<div><?php _e( 'Categories' ); ?>: <?php ground_terms( 'category', 'hover:text-primary' ); ?></div>
			<?php if ( has_tag() ) { ?>
				<div><?php _e( 'Tags' ); ?>: <?php ground_terms( 'post_tag', 'hover:text-primary' ); ?></div>
			<?php } ?>
		</footer>
	</article>
</main>