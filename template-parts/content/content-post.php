<main>

	<article class="max-w-3xl mx-auto px-6">

		<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

		<header class="mb-6">
			<h1 class="text-4xl mb-6"><?php the_title(); ?></h1>
			<time class="italic" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
			<div class="flex items-center font-medium whitespace-nowrap mt-6">
				<?php
				$author_id = get_the_author_meta( 'ID' );
				$author_name = get_the_author();
				$avatar_url = get_avatar_url( $author_id, array( 'size' => 96 ) );
				?>
				<img src="<?php echo esc_url( $avatar_url ); ?>" alt="<?php echo esc_attr( $author_name ); ?>"
					class="mr-3 w-9 h-9 rounded-full" decoding="async">
				<div class="text-sm leading-4">
					<div class="text-slate-900 dark:text-slate-200"><?php echo esc_html( $author_name ); ?></div>
				</div>
			</div>
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

		<footer class="my-6 border p-6">
			<div><?php _e( 'Categories' ); ?>: <?php ground_current_terms( 'category', 'hover:text-primary' ); ?></div>
			<?php if ( has_tag() ) { ?>
				<div><?php _e( 'Tags' ); ?>: <?php ground_current_terms( 'post_tag', 'hover:text-primary' ); ?></div>
			<?php } ?>
		</footer>
	</article>
</main>