<?php ground_breadcrumbs( [ 
	'nav_class' => 'mb-6',
	'list_class' => 'flex space-x-2',
	'item_active_class' => '',
	'link_class' => 'hover:text-primary',
	'separator_class' => 'pl-2',
	'separator' => ground_icon( [ 
		'name' => 'chevron-right',
		'attr' => [ 
			'class' => 'w-4 h-4 inline'
		],
		'echo' => false,
	] ),
] );