<?php
/**
 * Products block template.
 * Register block here: "inc/gutenberg.php".
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$columns    = get_field( 'columns' );
$number     = get_field( 'number' );
$handpicked = get_field( 'relationship', false, false );
$category   = get_field( 'category' );
$no_margin  = get_field( 'no_margin' );

if ( $handpicked || $category ) {
	if ( $handpicked ) {

		$args = array(
			'post_type' => 'product',
			'orderby'   => 'post__in',
			'post__in'  => $handpicked,
		);

	} elseif ( $category ) {

		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => $number,
			'tax_query'      => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $category,
				),
			),
		);
	}

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) : ?>
		<div class="relative ground-block <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> products product-columns columns-mobile-<?php echo esc_html( GROUND_SHOP_PRODUCTS_COLUMNS_MOBILE ); ?> columns-<?php echo esc_html( $columns ); ?> carousel-css not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php endwhile; ?>
		</div> <!-- End .row -->
		<?php
		wp_reset_postdata();
	endif;
}
