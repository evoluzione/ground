<?php
// TODO: Refactoring needed
$custom_category = 'category';

$terms = get_the_terms( $post->ID, $custom_category );


if ( $terms ) {
	foreach ( $terms as $term ) {
		$term_id = $term->term_id;
	}
}

$args = array(
	'orderby' => $order,
	'show_count' => 0,
	'pad_counts' => 0,
	'hide_empty' => 1,
	'hierarchical' => 1,
	'taxonomy' => $custom_category,
	'title_li' => '',
);

if ( isset( $child_id ) ) {
	$args['child_of'] = $child_id;
}

if ( isset( $term_id ) ) {
	$args['current_category'] = $term_id;
}

?>
<nav>
	<ul class="list-disc">
		<?php wp_list_categories( $args ); ?>
	</ul>
</nav>