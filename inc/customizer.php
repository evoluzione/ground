<?php

/**
 * Section: Customizer
 *
 * Basic Customizer section with basic controls.
 *
 * @package Ground
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}


// Customize function.
if (!function_exists('wpc_panel_wpcustomize')) {

	require_once 'customizer/customizer-colors.php';
	require_once 'customizer/customizer-company.php';
	require_once 'customizer/customizer-fonts.php';
	require_once 'customizer/customizer-footer.php';
	require_once 'customizer/customizer-header.php';
	require_once 'customizer/customizer-newsletter.php';
	require_once 'customizer/customizer-payments.php';
	require_once 'customizer/customizer-settings.php';
	require_once 'customizer/customizer-shop.php';
	require_once 'customizer/customizer-site.php';
	require_once 'customizer/customizer-socials.php';
}
