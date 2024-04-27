<?php
// TODO: Come mettere override le classi normali con quelle degli stati.
?>

<nav class="flex justify-center">
	<?php wp_nav_menu( [ 
		'theme_location' => 'navigation-header-primary',
		'menu_class' => 'flex flex-wrap items-start font-medium text-sm list-none',
		'depth' => 0,
		'container' => '',

		'remove_default_class' => true, // Accetta una array per rimuovere solo quelle specificate
	
		'item_class' => 'p-4 lg:px-8 relative group',

		'item_class_0' => '',
		'item_class_1' => '',

		'item_active_class' => 'text-primary',
		'item_parent_class' => '',
		'item_ancestor_class' => '',

		'submenu_class' => 'list-none',
		'submenu_class_0' => 'hidden group-hover:block origin-top-right absolute top-full left-1/2 -translate-x-1/2 min-w-[240px] bg-white border border-slate-200 p-2 rounded-lg shadow-xl',

		'link_class' => 'text-slate-800 hover:text-primary',
		'link_class_0' => '',

		'link_active_class' => 'text-primary',
		'link_parent_class' => '',
		'link_ancestor_class' => '',
	] ); ?>
</nav> <!-- End .navigation -->