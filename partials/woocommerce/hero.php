<?php
	$page_id             = get_queried_object();
	$category_highlights = get_field( 'category_highlights', $page_id );

if ( $category_highlights ) :
	$repeater_count = count( get_field( 'category_highlights', $page_id ) );
	endif;
?>


<?php if ( is_product_category() ) { ?>
	<?php	// Pagina categoria catalogo ?>

	<div class="hero hero--full-width">

		<div class="hero__body">
		<?php
			$ground_cat   = get_queried_object();
			$thumbnail_id = get_term_meta( $ground_cat->term_id, 'thumbnail_id', true );
		if ( $thumbnail_id ) {
			?>
				<img class="hero__image" loading="lazy" src="<?php echo wp_get_attachment_image_src( $thumbnail_id, 'large' )[0]; ?>">
					<div class="hero__image-filter" aria-hidden="true"></div>
				<div class="hero__content hero-has-thumbnail">
				<?php
		} else {
			?>
				<div class="hero__content">

			<?php
		}
		?>

			<div class="grid grid-cols-12 gap-x-6 <?php echo $repeater_count == 1 ? 'lg:items-center' : ''; ?>">
				<div class="col-span-full lg:col-span-5">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 class="hero__title mb-6"><?php woocommerce_page_title(); ?></h1>
					<?php endif; ?>

				<?php if ( $repeater_count > 1 ) : ?>
				</div>
				<div class="col-span-full lg:col-start-6 lg:col-span-7">
				<?php endif; ?>
					<div class="hero__excerpt mb-6">
						<?php do_action( 'woocommerce_archive_description' ); ?>
					</div>
				</div>

				<?php if ( $repeater_count <= 1 ) : ?>
				<div class="relative col-span-full lg:col-start-7 lg:col-span-6">

					<?php
						$title = $category_highlights[0]['category_highlight_title'];
						$url   = $category_highlights[0]['category_highlight_url'];
						$image = $category_highlights[0]['category_highlight_image'];
					?>

					<div class="rounded-media overflow-hidden">
						<?php if ( $url ) : ?>
							<a href="<?php echo esc_attr( $url ); ?>">
						<?php endif; ?>
						<?php if ( $image ) : ?>
							<figure class="overflow-hidden aspect-w-16 aspect-h-9">
								<img class="object-cover"
										srcset="<?php echo esc_attr( $image['sizes']['16-9-small'] ); ?> 480w,
												<?php echo esc_attr( $image['sizes']['16-9-medium'] ); ?> 900w,
												<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?> 1200w"
										sizes="(min-width: 1200px) 1200px,
												(min-width: 768px) 900px,
												100vh"
										src="<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?>"

										alt=""
										loading="lazy">
							</figure>
						<?php endif; ?>
						<?php if ( $url ) : ?>
							</a>
						<?php endif; ?>
						<?php if ( $title ) : ?>
						<div class="absolute bottom-0 left-0 right-0 p-6 z-2">
							<?php if ( $url ) { ?>
								<a class="no-underline" href="<?php echo esc_attr( $url ); ?>">
							<?php } ?>
								<div class="max-w-2xl md:max-w-lg">
									<h2 class="text-lg md:text-3xl text-typo-primary mb-3 <?php echo $repeater_count > 1 ? 'text-xl md:text-2xl' : ''; ?>"><?php echo esc_attr( $title ); ?></h2>
								</div>
							<?php if ( $url ) { ?>
								</a>
							<?php } ?>
						</div>
							<?php if ( $url ) : ?>
							<a href="<?php echo esc_attr( $url ); ?>">
						<?php endif; ?>
						<div class="absolute inset-0 bg-gradient-to-t from-body-primary opacity-80 rounded-none lg:rounded-media z-1"> </div>
							<?php if ( $url ) { ?>
							</a>
						<?php } ?>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>

			</div>
		</div>

	</div>

	<?php if ( $category_highlights && $repeater_count > 1 ) : ?>
			<div class="hero__highlights">

				<div class="hero__cards grid grid-cols-<?php echo esc_attr( $repeater_count ); ?> gap-x-6">

				<?php
				foreach ( $category_highlights as $category_highlight ) :

					$title = $category_highlight['category_highlight_title'];
					$url   = $category_highlight['category_highlight_url'];
					$image = $category_highlight['category_highlight_image'];
					?>

					<div class="rounded-media overflow-hidden">
						<?php if ( $url ) : ?>
							<a href="<?php echo esc_attr( $url ); ?>">
						<?php endif; ?>
						<?php if ( $image ) : ?>
							<figure class="overflow-hidden aspect-w-16 aspect-h-9">
								<img class="object-cover"
										srcset="<?php echo esc_attr( $image['sizes']['16-9-small'] ); ?> 480w,
												<?php echo esc_attr( $image['sizes']['16-9-medium'] ); ?> 900w,
												<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?> 1200w"
										sizes="(min-width: 1200px) 1200px,
												(min-width: 768px) 900px,
												100vh"
										src="<?php echo esc_attr( $image['sizes']['16-9-large'] ); ?>"

										alt=""
										loading="lazy">
							</figure>
						<?php endif; ?>
						<?php if ( $url ) : ?>
							</a>
						<?php endif; ?>
						<?php if ( $title ) : ?>
						<div class="absolute bottom-0 left-0 right-0 p-6 z-2">
							<?php if ( $url ) { ?>
								<a class="no-underline" href="<?php echo esc_attr( $url ); ?>">
							<?php } ?>
								<div class="max-w-2xl md:max-w-lg">
									<h2 class="text-lg md:text-3xl text-typo-primary mb-3 <?php echo $repeater_count > 1 ? 'text-xl md:text-2xl' : ''; ?>"><?php echo esc_attr( $title ); ?></h2>
								</div>
							<?php if ( $url ) { ?>
								</a>
							<?php } ?>
						</div>
							<?php if ( $url ) : ?>
							<a href="<?php echo esc_attr( $url ); ?>">
						<?php endif; ?>
						<div class="absolute inset-0 bg-gradient-to-t from-body-primary opacity-80 rounded-none lg:rounded-media z-1"> </div>
							<?php if ( $url ) { ?>
							</a>
						<?php } ?>
						<?php endif; ?>
					</div>

				<?php endforeach; ?>

				</div>
			</div>

	<?php endif; ?>

</div>

<?php } else { ?>
	<?php	// es. Pagina Shop ?>
	<div class="hero hero--full-width">

		<div class="relative">
			<?php
				$page_id      = get_option( 'woocommerce_shop_page_id' );
				$thumbnail_id = get_post_thumbnail_id( $page_id );
			if ( $thumbnail_id ) {
				?>
					<img class="hero__image" loading="lazy" src="<?php echo wp_get_attachment_image_src( $thumbnail_id, 'large' )[0]; ?>">
					<div class="hero__image-filter" aria-hidden="true"></div>
					<div class="hero__content hero-has-thumbnail">
					<?php
			} else {
				?>
					<div class="container my-12 lg:my-24 border-b border-line-primary">
				<?php
			}
			?>

				<div class="grid grid-cols-12 gap-x-6">
					<div class="col-span-full lg:col-span-3">
						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
							<h1 class="hero__title mb-6"><?php woocommerce_page_title(); ?></h1>
						<?php endif; ?>
					</div>
					<div class="col-span-full lg:col-start-6 lg:col-span-7">
						<div class="hero__excerpt">
							<?php do_action( 'woocommerce_archive_description' ); ?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
<?php } ?>
