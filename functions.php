<?php
/**
 * Functions and definitions
 *
 * @package Ground
 */

/**
 * Composer autoloader
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Require files
 */
require_once 'inc/constants.php';
require_once 'inc/extend.php';
require_once 'inc/customizer.php';
require_once 'inc/head-output.php';
require_once 'inc/navigations.php';
require_once 'inc/navigations-structure.php';
require_once 'inc/shortcode.php';
require_once 'inc/gutenberg-blocks.php';
require_once 'inc/updater.php';
require_once 'inc/template-hooks.php';
require_once 'inc/translate.php';
// require_once 'inc/editor-scripts.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once 'inc/woocommerce/brand.php';
	require_once 'inc/woocommerce/breadcrumbs.php';
	require_once 'inc/woocommerce/cart.php';
	require_once 'inc/woocommerce/cart-item-quantity.php';
	require_once 'inc/woocommerce/category.php';
	require_once 'inc/woocommerce/checkout.php';
	require_once 'inc/woocommerce/ean-gtin.php';
	require_once 'inc/woocommerce/gutemberg.php';
	require_once 'inc/woocommerce/pagination.php';
	require_once 'inc/woocommerce/payments.php';
	require_once 'inc/woocommerce/price.php';
	require_once 'inc/woocommerce/not-purchasable.php';
	require_once 'inc/woocommerce/product-loop.php';
	require_once 'inc/woocommerce/product-single.php';
	require_once 'inc/woocommerce/order.php';
	require_once 'inc/woocommerce/order-email.php';
	require_once 'inc/woocommerce/rest-order.php';
	require_once 'inc/woocommerce/rest-user.php';
	require_once 'inc/woocommerce/sidebar.php';
	require_once 'inc/woocommerce/store-notice.php';
	require_once 'inc/woocommerce/shipping.php';
	require_once 'inc/woocommerce/global.php';
}
