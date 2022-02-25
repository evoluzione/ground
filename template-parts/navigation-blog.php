<?php
	$custom_category = 'category';

	$terms = get_the_terms( $post->ID, $custom_category );


if ( $terms ) {
	foreach ( $terms as $term ) {
		$term_id = $term->term_id;
	}
}

	$args = array(
		'orderby'      => $order,
		'show_count'   => 0,
		'pad_counts'   => 0,
		'hide_empty'   => 1,
		'hierarchical' => 1,
		'taxonomy'     => $custom_category,
		'title_li'     => '',
	);

	if ( isset( $child_id ) ) {
		$args['child_of'] = $child_id;
	}

	if ( isset( $term_id ) ) {
		$args['current_category'] = $term_id;
	}

	?>

<div class="lg:flex lg:flex-start lg:items-center mb-12">
	<!-- <h2 class="text-black font-secondary text-lg lg:text-xl mr-4 mb-4 lg:mb-0"><?php _e( 'Category', 'ground' ); ?></h2> -->
	<ul class="navigation navigation--blog">
		<?php wp_list_categories( $args ); ?>
	</ul>
</div>

