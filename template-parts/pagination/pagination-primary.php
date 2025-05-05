<?php

$query = isset( $args['query'] ) ? $args['query'] : $wp_query;

ground_pagination( [ 
	'mid_size' => 1,
	'merge_classes' => false,

	'container_class' => 'flex justify-center',
	'list_class' => 'flex gap-4',

	'item_class' => '',
	'item_active_class' => '',

	'item_prev_class' => '',
	'item_next_class' => '',
	'item_dots_class' => '',
	'item_page_class' => '',

	'link_class' => '',
	'link_prev_class' => '',
	'link_next_class' => '',
	'link_page_class' => '',

	'text_class' => '',
	'text_page_class' => '',
	'text_dots_class' => '',

	'text_active_class' => '',

	'item_page_active_class' => 'font-bold text-primary',
	'total' => $query->max_num_pages
] );