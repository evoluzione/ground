<?php
/**
 * Main menu.
 *
 * One foreach per level shown: three here, drop or nest one to change that.
 */
$items = ground_menu( 'navigation-header-primary' );

if ( ! $items ) {
	return;
}
?>
<nav class="flex justify-center" aria-label="<?php esc_attr_e( 'Main menu', 'ground' ); ?>">
	<ul class="flex flex-wrap gap-6 items-start list-none">
		<?php foreach ( $items as $item ) : ?>
			<li class="relative group">
				<a class="hover:text-primary current:text-secondary<?php echo $item['ancestor'] ? ' text-primary' : ''; ?>" <?php echo ground_link_attributes( $item ); ?>><?php echo wp_kses_post( $item['title'] ); ?></a>

				<?php if ( $item['children'] ) : ?>
					<?php
					// The mouse opens the submenu on hover; the keyboard and screen
					// readers through this button (src/js/components/submenu.js).
					$submenu_id = 'submenu-' . $item['id'];
					/* translators: %s: label of the parent menu item. */
					$submenu_label = sprintf( __( '%s submenu', 'ground' ), wp_strip_all_tags( $item['title'] ) );
					?>
					<button class="peer js-submenu-toggle cursor-pointer" type="button" aria-expanded="false"
						aria-controls="<?php echo esc_attr( $submenu_id ); ?>" aria-label="<?php echo esc_attr( $submenu_label ); ?>">
						<?php ground_icon( [
							'name' => 'chevron-down',
							'attr' => [
								'class' => 'w-4 h-4 inline-block',
							],
						] ); ?>
					</button>

					<ul id="<?php echo esc_attr( $submenu_id ); ?>" class="hidden group-hover:block peer-aria-expanded:block origin-top-right absolute top-full left-1/2 -translate-x-1/2 min-w-[240px] bg-white border border-slate-200 p-2 rounded-lg shadow-xl">
						<?php foreach ( $item['children'] as $child ) : ?>
							<li>
								<a class="hover:text-primary current:text-secondary" <?php echo ground_link_attributes( $child ); ?>><?php echo wp_kses_post( $child['title'] ); ?></a>

								<?php if ( $child['children'] ) : ?>
									<ul class="list-none">
										<?php foreach ( $child['children'] as $grandchild ) : ?>
											<li>
												<a class="hover:text-primary current:text-secondary" <?php echo ground_link_attributes( $grandchild ); ?>><?php echo wp_kses_post( $grandchild['title'] ); ?></a>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
