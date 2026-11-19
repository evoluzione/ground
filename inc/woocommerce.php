<?php
/**
 * Returns the 'woocommerce_' entries of config/media.php, keyed without the prefix.
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
 * Declaring the product image widths as theme support is what makes WooCommerce
 * drop its own Customizer controls for them.
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
 * Theme support carries only the widths; wc_get_image_size() applies these
 * filters last, so they govern height and crop for the generated files as well
 * as the displayed ones. A `height` of 0 means width-only.
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
 * Theme support already drops the width controls; what is left is thumbnail
 * cropping, which the filters above override anyway.
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
// The theme owns WooCommerce markup styling instead (see src/css/woocommerce/).
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Registers the AJAX fragments WooCommerce's add-to-cart.js swaps in after an
 * AJAX add-to-cart or a mini-cart removal: the header trigger (count badge) and
 * the mini-cart drawer contents, rendered from the same template parts as the
 * header (template-parts/cart/) and keyed by their root selectors.
 * wc-cart-fragments.js is not loaded, so a page load does not refresh them.
 *
 * @param array $fragments Fragments keyed by selector.
 * @return array
 */
function ground_woocommerce_cart_fragments( $fragments ) {

	ob_start();
	get_template_part( 'template-parts/cart/cart-link' );
	$fragments['a.cart-contents'] = ob_get_clean();

	ob_start();
	get_template_part( 'template-parts/cart/cart-drawer-content' );
	$fragments['div.mini-cart-panel-content'] = ob_get_clean();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'ground_woocommerce_cart_fragments' );

/**
 * Returns the header account menu: a link to the My account page and, once
 * logged in, the account's navigation under it. Data only, in the shape of
 * ground_menu() (see template-parts/navigation/navigation-account.php for the
 * markup).
 *
 * Logged out it is a single "Log in" link with no children: the My account page
 * holds both the login form and, when "Allow customers to create an account on
 * the My account page" is on, the registration form, so a dropdown would only
 * offer two links to the same page. Logged in, the link greets the customer by
 * name and its children are WooCommerce's own account navigation
 * (wc_get_account_menu_items(), filtered by 'woocommerce_account_menu_items'),
 * Log out included: the template sets Log out apart by id.
 *
 * No AJAX fragment: logging in or out reloads the page, and full-page caches
 * skip logged-in visitors (wordpress_logged_in_* cookie), so a cached page
 * always carries the logged-out version.
 *
 * @return array The top item, with 'id', 'title' (plain text, unescaped), 'url',
 *               'current', 'ancestor' and 'children' (same shape, no further
 *               level). Empty when the My account page isn't set.
 */
function ground_account_menu() {

	// No fallback: without the page WooCommerce would hand back the home URL.
	$account_url = wc_get_page_permalink( 'myaccount', '' );

	if ( ! $account_url ) {
		return [];
	}

	$item = static fn( $id, $title, $url, $current = false ) => [
		'id' => $id,
		'title' => $title,
		'url' => $url,
		'current' => $current,
		'ancestor' => false,
		'children' => [],
	];

	if ( ! is_user_logged_in() ) {
		return $item( 'account', __( 'Log in', 'ground' ), $account_url, is_account_page() && ! is_wc_endpoint_url() );
	}

	$user = wp_get_current_user();
	/* translators: %s: the customer's first name, or display name without one. */
	$top = $item( 'account', sprintf( __( 'Hi, %s', 'ground' ), $user->first_name ?: $user->display_name ), $account_url );
	$top['ancestor'] = is_account_page();

	foreach ( wc_get_account_menu_items() as $endpoint => $title ) {
		$current = 'dashboard' === $endpoint
			? is_account_page() && ! is_wc_endpoint_url()
			: is_wc_endpoint_url( $endpoint );

		$top['children'][] = $item( $endpoint, $title, wc_get_account_endpoint_url( $endpoint ), $current );
	}

	return $top;
}

/**
 * Returns WooCommerce's Create account block for the order being confirmed,
 * rendered once per request (see template-parts/checkout/checkout-create-account.php).
 *
 * The order is the one in the URL (order-received), the same the block reads
 * for itself: not the id woocommerce_thankyou passes, which the
 * 'woocommerce_thankyou_order_id' filter may have changed. Empty for a failed
 * order: its confirmation page asks the customer to pay again, and an account
 * offer there would read as if the order had gone through.
 *
 * @return string The block's HTML, or '' when it has nothing to show.
 */
function ground_woocommerce_create_account() {
	static $html = null;

	if ( null === $html ) {
		$order = wc_get_order( absint( get_query_var( 'order-received' ) ) );
		$html = '';

		if ( $order && ! $order->has_status( 'failed' ) ) {
			ob_start();
			get_template_part( 'template-parts/checkout/checkout-create-account' );
			$html = ob_get_clean();
		}
	}

	return $html;
}

/**
 * Offers a guest an account on the order confirmation page, between the order
 * overview and its details (woocommerce_order_details_table runs at 10): the
 * checkout asks for no account, it is offered once the order is placed.
 */
function ground_woocommerce_thankyou_create_account() {
	echo ground_woocommerce_create_account(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- block markup.
}

add_action( 'woocommerce_thankyou', 'ground_woocommerce_thankyou_create_account', 5 );

/**
 * Renders the Create account block on the order confirmation page before the
 * page is output; woocommerce_thankyou then prints the stored HTML. Rendered
 * in place, inside the page body, it would come too late twice: the block
 * creates the account and logs the customer in while it renders, after the
 * auth cookie could still be sent, and it enqueues its stylesheet after
 * wp_head, so the stylesheet would be printed in the footer and the form
 * would show unstyled until then.
 */
function ground_woocommerce_create_account_early() {
	if ( is_order_received_page() ) {
		ground_woocommerce_create_account();
	}
}

add_action( 'template_redirect', 'ground_woocommerce_create_account_early' );
