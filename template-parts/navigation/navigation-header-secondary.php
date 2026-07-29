<?php
if ( ! has_nav_menu( 'navigation-header-secondary' ) ) {
	return;
}
?>
<nav class="flex">
	<?php wp_nav_menu( [
		'theme_location' => 'navigation-header-secondary',
		'fallback_cb' => false, // No menu assigned -> render nothing instead of the page list
		'depth' => 1,
		'remove_default_class' => true,
		'merge_classes' => true,
		'container' => '', // Leave blank

		'menu_class' => 'flex flex-wrap gap-4 list-none text-sm',
		'link_class' => 'hover:text-primary',
		'link_active_class' => 'text-primary',
	] ); ?>
</nav>
