<?php ground_breadcrumbs( [
	'merge_classes' => true,
	'nav_class' => 'mb-6',
	'list_class' => 'flex space-x-2',
	'item_class' => '',
	'item_active_class' => '',
	'link_class' => 'hover:text-primary',
	'separator_class' => 'pl-2',
	'separator' => ground_icon( [
		'name' => 'chevron-right',
		'attr' => [
			'class' => 'w-4 h-4 inline',
			'aria-hidden' => 'true',
		],
		'echo' => false,
	] ),
] );
