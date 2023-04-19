<?php if ( is_active_sidebar( 'sidebar-archive-post' ) ) : ?>
<div class="sidebar" id="sidebar-archive-post">
	<div class="sidebar__mask js-toggle" data-toggle-target="#sidebar-archive-post html" data-toggle-class-name="is-sidebar-open"></div>
	<div class="sidebar__body">
		<div class="sidebar__content">
			<?php dynamic_sidebar( 'sidebar-archive-post' ); ?>
		</div>
		<div class="sidebar__close js-toggle" data-toggle-target="#sidebar-archive-post html" data-toggle-class-name="is-sidebar-open"><?php ground_icon( 'close' ); ?></div>
	</div>
</div>
<?php endif; ?>