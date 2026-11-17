<?php
if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}
?>
<aside id="shop-filters" class="shop-filters hidden space-y-6 lg:block">
	<?php dynamic_sidebar( 'sidebar-shop' ); ?>
</aside>