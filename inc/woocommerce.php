<?php
/**
 * Returns the 'woocommerce_'-prefixed entries of config/media.php, keyed by the
 * name WooCommerce uses internally (i.e. without the prefix).
 *
 * @return array
 */
function ground_woocommerce_config_sizes() {

	$sizes = array();

	foreach ( (array) ground_config( 'media.sizes' ) as $name => $size ) {
		if ( str_starts_with( $name, 'woocommerce_' ) ) {
			$sizes[ substr( $name, strlen( 'woocommerce_' ) ) ] = $size;
		}
	}

	return $sizes;
}

/**
 * WooCommerce integration.
 *
 * Declares theme support, including the product image widths. Declaring them
 * is what makes WooCommerce drop its own Customizer controls for those widths
 * (see WC_Shop_Customizer), handing the dimensions to config/media.php.
 *
 * @return void
 */
function ground_woocommerce_support() {

	$sizes = ground_woocommerce_config_sizes();
	$width = static function ( $name ) use ( $sizes ) {
		return isset( $sizes[ $name ]['width'] ) ? (int) $sizes[ $name ]['width'] : null;
	};

	// Declare WooCommerce support (enables template overrides).
	add_theme_support( 'woocommerce', array_filter( array(
		'thumbnail_image_width' => $width( 'thumbnail' ),
		'single_image_width' => $width( 'single' ),
		'gallery_thumbnail_image_width' => $width( 'gallery_thumbnail' ),
	) ) );

	// Single-product gallery features (zoom / lightbox / slider).
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'ground_woocommerce_support' );

/**
 * Enforces WooCommerce image dimensions from config/media.php.
 *
 * Theme support above only carries the widths; height and crop are derived by
 * wc_get_image_size(), which applies these filters last — so they govern both
 * the generated files and the displayed images. A `height` of 0 means the width
 * alone constrains the size.
 *
 * @return void
 */
function ground_woocommerce_image_sizes() {

	foreach ( ground_woocommerce_config_sizes() as $name => $size ) {
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

/**
 * Removes WooCommerce's "Product Images" Customizer section.
 *
 * Declaring the widths as theme support already drops the two width controls,
 * leaving only the thumbnail cropping ones — and those the filters above
 * override, so they would change nothing whatever the store owner picks.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer manager instance.
 * @return void
 */
function ground_woocommerce_remove_image_customizer( $wp_customize ) {
	$wp_customize->remove_section( 'woocommerce_product_images' );
}

add_action( 'customize_register', 'ground_woocommerce_remove_image_customizer', 20 );

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

	$cart = WC()->cart;
	$count = $cart ? $cart->get_cart_contents_count() : 0;
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
 * Renders the mini-cart panel contents.
 *
 * While the cart is empty this skips WooCommerce's mini-cart template and the
 * hook chain around it, printing the empty message directly — reusing WC's own
 * translated string and markup class so the panel looks the same (see app.css).
 *
 * Shared by the header markup and the AJAX fragment, so the two can't drift.
 *
 * @return void
 */
function ground_mini_cart_content() {

	$cart = WC()->cart;

	if ( $cart && ! $cart->is_empty() ) {
		woocommerce_mini_cart();
		return;
	}
	?>
	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>
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
		<?php ground_mini_cart_content(); ?>
	</div>
	<?php
	$fragments['div.mini-cart-panel-content'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'ground_woocommerce_cart_fragments' );
