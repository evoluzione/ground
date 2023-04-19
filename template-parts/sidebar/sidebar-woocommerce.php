
<?php if ( is_active_sidebar( 'sidebar-woocommerce' ) ) : ?>
<div class="sidebar" id="sidebar-woocommerce">
	<div class="sidebar__mask js-toggle" data-toggle-target="#sidebar-woocommerce html" data-toggle-class-name="is-sidebar-open"></div>
	<div class="sidebar__body">
		<div class="sidebar__content">
			<?php dynamic_sidebar( 'sidebar-woocommerce' ); ?>
			<?php if ( is_active_sidebar( 'sidebar-woocommerce-advanced' ) ) : ?>
				<div class="button button--bordered w-full js-toggle" data-toggle-target="#ground-sidebar-woocommerce-advanced" data-toggle-class-name="hidden"><?php ground_icon( 'options', 'button__icon' ); ?> <?php _e( 'Advanced Filters', 'ground' ); ?></div>
				<div class="hidden" id="ground-sidebar-woocommerce-advanced">
					<?php dynamic_sidebar( 'sidebar-woocommerce-advanced' ); ?>
				</div>
				<?php endif; ?>
		</div>
		<div class="sidebar__close js-toggle" data-toggle-target="#sidebar-woocommerce html" data-toggle-class-name="is-sidebar-open"><?php ground_icon( 'close' ); ?></div>
	</div>
</div>
<?php endif; ?>