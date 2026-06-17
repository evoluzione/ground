<nav class="flex justify-center">
	<?php wp_nav_menu( [
		'theme_location' => 'navigation-header-primary',
		'fallback_cb' => false, // No menu assigned -> render nothing instead of the page list
		'depth' => 0,
		'remove_default_class' => true, // Accepts an array to remove only the specified ones
		'merge_classes' => true,
		'container' => '', // Leave blank
		
		'menu_class' => 'flex flex-wrap gap-6 items-start list-none',

		'item_class' => 'relative group',
		'item_class_1' => '',
		
		'item_active_class' => 'text-primary',
		'item_active_class_1' => '',
		
		'item_parent_class' => '',
		'item_parent_class_1' => '',

		'item_ancestor_class' => '',
		'item_ancestor_class_1' => '',

		'submenu_class' => 'list-none',
		'submenu_class_1' => 'hidden group-hover:block origin-top-right absolute top-full left-1/2 -translate-x-1/2 min-w-[240px] bg-white border border-slate-200 p-2 rounded-lg shadow-xl',

		'link_class' => 'hover:text-primary',
		'link_class_1' => '',

		'link_active_class' => 'text-secondary',
		'link_active_class_1' => '',

		'link_parent_class' => '',
		'link_parent_class_1' => '',

		'link_ancestor_class' => '',
		'link_ancestor_class_1' => '',
	] ); ?>
</nav>