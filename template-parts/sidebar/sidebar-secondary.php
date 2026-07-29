<aside class="space-y-6">
	<div>
		<h4 class="text-2xl mb-6"><?php _e( 'Categories' ); ?></h4>
		<?php get_template_part( 'template-parts/navigation/navigation-sidebar-secondary' ); ?>
	</div>

	<?php if ( is_active_sidebar( 'sidebar-archive-post' ) ) : ?>
		<div class="space-y-4">
			<?php dynamic_sidebar( 'sidebar-archive-post' ); ?>
		</div>
	<?php endif; ?>
</aside>
