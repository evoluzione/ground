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
require_once 'inc/facetwp.php';
require_once 'inc/gutenberg-blocks.php';
require_once 'inc/updater.php';
require_once 'inc/template-hooks.php';
require_once 'inc/translate.php';
require_once 'inc/oembed.php';
// require_once 'inc/editor-scripts.php';

if ( class_exists('WooCommerce') ) {
    include_once 'inc/woocommerce/brand.php';
    include_once 'inc/woocommerce/breadcrumbs.php';
    include_once 'inc/woocommerce/cart.php';
    include_once 'inc/woocommerce/cart-item-quantity.php';
    include_once 'inc/woocommerce/category.php';
    include_once 'inc/woocommerce/checkout.php';
    include_once 'inc/woocommerce/ean-gtin.php';
    include_once 'inc/woocommerce/gutemberg.php';
    include_once 'inc/woocommerce/pagination.php';
    include_once 'inc/woocommerce/payments.php';
    include_once 'inc/woocommerce/price.php';
    include_once 'inc/woocommerce/not-purchasable.php';
    include_once 'inc/woocommerce/product-loop.php';
    include_once 'inc/woocommerce/product-single.php';
    include_once 'inc/woocommerce/order.php';
    include_once 'inc/woocommerce/order-email.php';
    include_once 'inc/woocommerce/rest-order.php';
    include_once 'inc/woocommerce/rest-user.php';
    include_once 'inc/woocommerce/sidebar.php';
    include_once 'inc/woocommerce/store-notice.php';
    include_once 'inc/woocommerce/shipping.php';
    include_once 'inc/woocommerce/global.php';
}
