<main>
	<article class="container">

		<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

		<div class="grid grid-cols-12 gap-6">
			<div class="col-span-6">
				<?php ground_image( [
					'size' => '4-3-medium',
					'attr' => [
						// col-span-6 of the container at every width.
						'sizes' => '(min-width: 1536px) 724px, (min-width: 1280px) 596px, (min-width: 1024px) 468px, (min-width: 768px) 340px, (min-width: 640px) 276px, calc(50vw - 44px)',
						'class' => 'aspect-4/3 object-cover w-full mb-6',
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
