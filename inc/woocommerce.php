<?php
/**
 * WooCommerce integration.
 *
 * Declares theme support and owns the product image sizes. Image dimensions
 * (width/height/crop) live in a single place — config/media.php
 * (`media.woocommerce`) — and are enforced via the woocommerce_get_image_size_*
 * filters, so they stay coherent with the theme and are not store-owner editable.
 *
 * @return void
 */
function ground_woocommerce_support() {

	// Declare WooCommerce support (enables template overrides).
	add_theme_support( 'woocommerce' );

	// Single-product gallery features (zoom / lightbox / slider).
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'ground_woocommerce_support' );

/**
 * Enforces WooCommerce image dimensions (width/height/crop) from config
 * (`media.woocommerce`) via the woocommerce_get_image_size_{size} filters.
 *
 * WooCommerce registers its sizes on `init` (via wc_get_image_size()), which
 * runs after `after_setup_theme`, so these filters govern both the generated
 * files and the displayed images. A `height` of 0 means uncropped (constrained
 * by width only).
 *
 * @return void
 */
function ground_woocommerce_image_sizes() {

	$sizes = ground_config( 'media.woocommerce' );

	if ( ! is_array( $sizes ) ) {
		return;
	}

	foreach ( $sizes as $name => $size ) {
		add_filter( "woocommerce_get_image_size_{$name}", function () use ($size) {
			return array(
				'width' => (int) ( $size['width'] ?? 0 ),
				'height' => ( (int) ( $size['height'] ?? 0 ) ) ?: 9999,
				'crop' => empty( $size['crop'] ) ? 0 : 1,
			);
		} );
	}
}

add_action( 'after_setup_theme', 'ground_woocommerce_image_sizes' );

// Disables WooCommerce's bundled frontend stylesheets (woocommerce.css,
// woocommerce-layout.css, woocommerce-smallscreen.css). They ship as plain,
// un-layered CSS, while Tailwind's output lives inside `@layer utilities` —
// per the CSS cascade-layers spec, un-layered rules always win over layered
// ones regardless of specificity or load order, so WooCommerce's defaults
// would otherwise silently override theme utilities on shared selectors.
// The theme owns WooCommerce markup styling instead (see app.css).
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Renders the header cart trigger: icon + item count badge, and the link
 * that opens the mini-cart panel (see content-header-primary.php).
 *
 * Re-rendered on every add-to-cart refresh by ground_woocommerce_cart_fragments(),
 * so it must stay self-contained (no surrounding markup relies on it).
 *
 * @return void
 */
function ground_cart_link() {

	$count = WC()->cart->get_cart_contents_count();
	?>
	<a
		href="<?php echo esc_url( wc_get_cart_url() ); ?>"
		class="cart-contents js-toggle relative inline-flex items-center"
		data-toggle-target=".mini-cart-panel"
		aria-label="<?php esc_attr_e( 'Cart', 'ground' ); ?>"
	>
		<?php ground_icon( [
			'name' => 'shopping-cart',
			'attr' => [
				'class' => 'w-5 h-5',
			],
		] ); ?>
		<?php if ( $count > 0 ) : ?>
			<span class="cart-count"><?php echo esc_html( $count ); ?></span>
		<?php endif; ?>
	</a>
	<?php
}

/**
 * Registers the AJAX fragments refreshed by WooCommerce's wc-cart-fragments.js
 * after every add-to-cart: the header trigger (count badge) and the mini-cart
 * panel content, keyed by the selectors already present in the header markup.
 *
 * @param array $fragments Fragments keyed by selector.
 * @return array
 */
function ground_woocommerce_cart_fragments( $fragments ) {

	ob_start();
	ground_cart_link();
	$fragments['a.cart-contents'] = ob_get_clean();

	ob_start();
	?>
	<div class="mini-cart-panel-content">
		<?php woocommerce_mini_cart(); ?>
	</div>
	<?php
	$fragments['div.mini-cart-panel-content'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'ground_woocommerce_cart_fragments' );
