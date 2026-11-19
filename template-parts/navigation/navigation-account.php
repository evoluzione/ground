<?php
/**
 * Header account menu (WooCommerce): a link to the My account page, "Log in" or
 * "Hi, {name}", and once logged in a dropdown with the account's navigation.
 * Data from ground_account_menu() (inc/woocommerce.php).
 *
 * The label is visible from lg up and read by screen readers below it, where
 * the icon stays in the header rather than moving into a menu. Log out sits
 * apart from the other links, under a line.
 *
 * Like the main menu's submenus, the dropdown opens on hover in CSS and, from
 * the keyboard, through the button next to the link (src/js/components/submenu.js).
 */
$account = ground_account_menu();

if ( ! $account ) {
	return;
}

$list_id = wp_unique_id( 'account-menu-' );
?>
<nav class="relative group flex items-center gap-1" aria-label="<?php esc_attr_e( 'Account', 'ground' ); ?>">
	<a class="inline-flex items-center gap-2 hover:text-primary current:text-primary<?php echo $account['ancestor'] ? ' text-primary' : ''; ?>"
		<?php echo ground_link_attributes( $account ); ?>>
		<?php ground_icon( [
			'name' => 'user',
			'attr' => [
				'class' => 'w-5 h-5',
			],
		] ); ?>
		<span class="sr-only lg:not-sr-only"><?php echo esc_html( $account['title'] ); ?></span>
	</a>

	<?php if ( $account['children'] ) : ?>
		<button class="peer js-submenu-toggle cursor-pointer" type="button" aria-expanded="false"
			aria-controls="<?php echo esc_attr( $list_id ); ?>" aria-label="<?php esc_attr_e( 'Account menu', 'ground' ); ?>">
			<?php ground_icon( [
				'name' => 'chevron-down',
				'attr' => [
					'class' => 'w-4 h-4',
				],
			] ); ?>
		</button>

		<ul id="<?php echo esc_attr( $list_id ); ?>"
			class="hidden group-hover:block peer-aria-expanded:block absolute top-full right-0 z-10 min-w-48 list-none bg-white border border-slate-200 p-2 rounded-lg shadow-xl">
			<?php foreach ( $account['children'] as $child ) : ?>
				<li<?php echo 'customer-logout' === $child['id'] ? ' class="mt-2 pt-2 border-t border-slate-200"' : ''; ?>>
					<a class="block px-2 py-1 whitespace-nowrap hover:text-primary current:text-secondary" <?php echo ground_link_attributes( $child ); ?>><?php echo esc_html( $child['title'] ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</nav>
