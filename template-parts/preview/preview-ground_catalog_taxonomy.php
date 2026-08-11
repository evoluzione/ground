<?php if ( isset( $args['taxonomy'] ) ) : ?>
	<article class="mb-6">
		<?php if ( $args['taxonomy'] instanceof WP_Term ) : ?>
			<a class="group no-underline"
				href="<?php echo esc_url( get_term_link( $args['taxonomy'] ) ); ?>">
				<?php
				// TODO: Aggiungere immagine come custom fields
				ground_image( [
					'size' => '1-1-large',
					'attr' => [
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
