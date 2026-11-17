<?php
/**
 * Mini-cart drawer: a native <dialog> opened as modal by
 * src/js/components/miniCart.js. The shell (title, close button) stays put
 * while the AJAX fragments refresh cart-drawer-content.php inside it.
 */
?>
<dialog
	class="mini-cart-panel fixed inset-y-0 right-0 left-auto h-dvh max-h-none w-full max-w-md flex-col overflow-hidden bg-white text-gray-900 shadow-2xl
		translate-x-full open:flex open:translate-x-0 starting:open:translate-x-full
		transition-[translate,display,overlay] transition-discrete duration-300 motion-reduce:transition-none
		backdrop:bg-black/0 open:backdrop:bg-black/50 starting:open:backdrop:bg-black/0
		backdrop:transition-[background-color,display,overlay] backdrop:transition-discrete backdrop:duration-300 motion-reduce:backdrop:transition-none"
	aria-labelledby="mini-cart-title">
	<div class="flex shrink-0 items-center justify-between border-b border-gray-200 px-5 py-4">
		<h2 id="mini-cart-title" class="text-base font-medium"><?php esc_html_e( 'Cart', 'ground' ); ?></h2>
		<button type="button"
			class="mini-cart-close flex h-6 w-6 cursor-pointer items-center justify-center transition-colors hover:text-primary"
			aria-label="<?php esc_attr_e( 'Close', 'ground' ); ?>">
			<?php ground_icon( [
				'name' => 'x',
				'attr' => [
					'class' => 'w-5 h-5',
				],
			] ); ?>
		</button>
	</div>
	<?php get_template_part( 'template-parts/cart/cart-drawer-content' ); ?>
</dialog>
