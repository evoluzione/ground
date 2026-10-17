<article>

	<header class="mb-6">
		<h1 class="text-4xl"><?php the_title(); ?></h1>
	</header>

	<?php ground_image( [
		'size' => '16-9-large',
		'attr' => [
			// page.php: lg:col-span-10 of the container, full container below lg.
			'sizes' => '(min-width: 1536px) 1223px, (min-width: 1280px) 1009px, (min-width: 1024px) 796px, (min-width: 768px) 704px, (min-width: 640px) 576px, calc(100vw - 64px)',
			'class' => 'aspect-16/9 object-cover w-full mb-6',
			'alt' => get_the_title(),
		],
		'placeholder' => '',
	] ); ?>

	<div class="prose max-w-none mb-6">
		<?php the_content(); ?>
	</div>

</article>
