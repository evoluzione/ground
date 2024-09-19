<?php
/**
 * Products category block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$category = get_field( 'category' );
$checkbox = get_field( 'checkbox' );
$custom_category_repeater = get_field( 'repeater' );
$no_margin = get_field( 'no_margin' );
?>

<div
	class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> bg-senary overflow-hidden rounded-theme not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
	<div class="flex flex-wrap -mx-3 overflow-hidden">
		<?php if ( ! $checkbox && $category ) { ?>
			<?php
			foreach ( $category as $category ) :
				$term_name = $category->name;
				$term_link = get_term_link( $category );
				?>
				<div class="ground-block-products-category__item">
					<a class="block w-full" href="<?php echo esc_attr( $term_link ); ?>">
						<div class="flex items-center p-9">
							<div class="flex-grow pr-7">
								<p class="mb-3 text-sm"><?php esc_html_e( 'Discover', 'ground-child' ); ?></p>
								<h4 class="font-normal"><?php echo esc_attr( $term_name ); ?></h4>
							</div>
							<div class="ground-block-products-category__media">
								<?php echo wp_get_attachment_image( get_term_meta( $category->term_id, 'thumbnail_id', 1 ), 'thumbnail', '', array( 'class' => 'h-full w-full object-cover' ) ); ?>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
		<?php } else { ?>
			<?php
			foreach ( $custom_category_repeater as $row ) :
				$image = $row['image'];
				$title = $row['title'];
				$url = $row['url'];
				$checkbox = $row['checkbox'];
				$custom_subcategory_repeater = $row['repeater'];
				?>
				<div class="group ground-block-products-category__item">
					<div class="block w-full" href="<?php echo esc_attr( $url ); ?>">
						<div class="flex items-center p-9">
							<a class="flex-grow pr-7 <?php echo $custom_subcategory_repeater ? 'mt-3 mb-6' : ''; ?>"
								href="<?php echo esc_attr( $url ); ?>">
								<p class="mb-3 text-sm"><?php esc_html_e( 'Discover', 'ground-child' ); ?></p>
								<h4 class="text-lg lg:text-xl font-normal"><?php echo esc_attr( $title ); ?></h4>
							</a>
							<?php if ( $image ) { ?>
								<a class="no-underline" href="<?php echo esc_attr( $url ); ?>">
									<figure class="overflow-hidden h-24 w-24 lg:h-32 lg:w-32 rounded-full">
										<img class="object-cover transition duration-500 transform-gpu group-hover:scale-105"
											srcset="<?php echo $image['sizes']['1-1-small']; ?> 480w,
												<?php echo $image['sizes']['1-1-medium']; ?> 900w,
												<?php echo $image['sizes']['1-1-large']; ?> 1200w" sizes="(min-width: 1200px) 1200px,
												(min-width: 768px) 900px,
												100vh" src="<?php echo $image['sizes']['1-1-large']; ?>" alt="" loading="lazy">
									</figure>
								</a>
							<?php } ?>
						</div>
						<?php if ( $custom_subcategory_repeater ) : ?>
							<div class="px-9 pl-9">
								<div class="flex items-center flex-wrap mb-6">
									<?php
									foreach ( $custom_subcategory_repeater as $row ) :
										$title = $row['title'];
										$url = $row['url'];
										?>
										<a class="border border-septenary rounded-theme py-2 px-3 mr-2 mb-2"
											href="<?php echo esc_attr( $url ); ?>"> <?php echo esc_attr( $title ); ?> </a>
									<?php endforeach ?>
								</div>
							</div>
						<?php endif; ?>


					</div>
				</div>
			<?php endforeach ?>

		<?php } ?>

		<div class="ground-block-products-category__item flex-grow">
			<a class="block w-full group" href="<?php echo esc_attr( wc_get_page_permalink( 'shop' ) ); ?>">
				<div class="flex items-center p-9">
					<div class="flex-grow pr-7">
						<p class="mb-3 text-sm"><?php esc_html_e( 'Discover', 'ground-child' ); ?></p>
						<h4 class="text-lg lg:text-xl font-normal">
							<?php esc_html_e( 'All products', 'ground-child' ); ?>
						</h4>
					</div>
					<div class="flex-none h-24 w-24 overflow-hidden rounded-full bg-quinary p-6">
						<div
							class="transition duration-500 transform-gpu group-hover:scale-110 bg-primary h-full w-full rounded-full text-white flex items-center justify-center">
							<?php ground_icon( [ 
								'name' => 'arrow-right',
							] ); ?>
						</div>
					</div>
				</div>
			</a>
		</div>

	</div>
</div>