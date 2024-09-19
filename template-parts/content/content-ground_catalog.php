<main>
	<article class="container">

		<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

		<div class="grid grid-cols-12 gap-6">
			<div class="col-span-6">
				<?php ground_image( [ 
					'size' => '4-3-large',
					'attr' => [ 
						'class' => 'aspect-[4/3] object-cover w-full mb-6',
						'alt' => get_the_title(),
					],
				] ); ?>
			</div>

			<div class="col-span-6">
				<header class="mb-6">
					<h1 class="text-4xl"><?php the_title(); ?></h1>
				</header>
				<div>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</article>
</main>