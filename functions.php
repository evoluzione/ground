<?php
/**
 * Functions and definitions
 *
 * @package Ground
 */

/**
 * Require files
 */
require_once 'inc/constants.php';
require_once 'inc/extend.php';
require_once 'inc/gutenberg.php';
require_once 'inc/acf-constants.php';
require_once 'inc/cpt-catalog.php';
require_once 'inc/head-output.php';
require_once 'inc/navigations.php';
require_once 'inc/shortcode.php';
require_once 'inc/walker.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once 'inc/woocommerce/breadcrumbs.php';
	require_once 'inc/woocommerce/cart.php';
	require_once 'inc/woocommerce/category.php';
	require_once 'inc/woocommerce/checkout.php';
	require_once 'inc/woocommerce/gutemberg.php';
	require_once 'inc/woocommerce/pagination.php';
	require_once 'inc/woocommerce/payments.php';
	require_once 'inc/woocommerce/price.php';
	require_once 'inc/woocommerce/product-loop.php';
	require_once 'inc/woocommerce/product-single.php';
	require_once 'inc/woocommerce/rest-order.php';
	require_once 'inc/woocommerce/rest-user.php';
	require_once 'inc/woocommerce/sidebar.php';
	require_once 'inc/woocommerce/global.php';
}
