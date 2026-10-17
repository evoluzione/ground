<?php if ( isset( $args['taxonomy'] ) ) : ?>
	<article class="mb-6">
		<?php if ( $args['taxonomy'] instanceof WP_Term ) : ?>
			<a class="group no-underline"
				href="<?php echo esc_url( get_term_link( $args['taxonomy'] ) ); ?>">
				<?php
				// TODO: Aggiungere immagine come custom fields
				ground_image( [
					'size' => '1-1-small',
					'attr' => [
						// Same grid as preview-ground_catalog.php.
						'sizes' => '(min-width: 1536px) 288px, (min-width: 1280px) 234px, (min-width: 1024px) 181px, (min-width: 768px) 219px, (min-width: 640px) 276px, calc(50vw - 44px)',
						'class' => 'aspect-1/1 object-cover w-full mb-6',
						'alt' => esc_attr( $args['taxonomy']->name ?? '' ),
					]
				] );
				?>
				<header>
					<?php if ( isset( $args['taxonomy']->name ) ) : ?>
						<h2 class="text-2xl group-hover:text-primary"><?php echo esc_html( $args['taxonomy']->name ); ?></h2>
					<?php endif; ?>
				</header>
				<?php if ( isset( $args['taxonomy']->description ) ) : ?>
					<p><?php echo esc_html( $args['taxonomy']->description ); ?></p>
				<?php endif; ?>
			</a>
		<?php endif; ?>
	</article>
<?php endif;
