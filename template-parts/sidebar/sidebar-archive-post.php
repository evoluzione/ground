<div class="sidebar sidebar--archive-post">
	<div class="sidebar__body">
		<?php dynamic_sidebar('sidebar-archive-post'); ?>
		<div class="mt-6 border-t block border-septenary">
			<a class="text-base mb-3 lg:mb-6 mt-6 inline-block" href="<?php echo get_post_type_archive_link('post'); ?>"> <span class="text-sm"><</span> <?php _e('Back to ', 'ground'); ?> <?php echo get_the_title(get_option('page_for_posts', true)) ?></a>
		</div>
	</div>
	<div class="sidebar__close js-toggle" data-toggle-target=".sidebar--archive-post html" data-toggle-class-name="is-sidebar-open"><?php ground_icon('close'); ?></div>
</div>