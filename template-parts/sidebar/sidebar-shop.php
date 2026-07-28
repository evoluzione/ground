<?php
if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}
?>
<aside class="shop-filters space-y-6">
	<?php dynamic_sidebar( 'sidebar-shop' ); ?>
</aside>