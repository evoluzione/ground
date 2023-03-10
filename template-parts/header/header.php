<!doctype html>
<html <?php language_attributes(); ?> class="has-no-js is-loading">

<head>
	<meta charset="<?php echo GROUND_CHARSET; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
		<link rel="icon" type="image/png" href="<?php echo GROUND_TEMPLATE_URL . '/assets/img/favicon.png'; ?>">
		<link rel="apple-touch-icon" href="<?php echo GROUND_TEMPLATE_URL . '/assets/img/icon.png'; ?>">
	<?php } ?>
	<?php wp_head(); ?>
</head>

<body id="scroll-top" <?php body_class( 'font-primary bg-quinary text-tertiary overflow-x-hidden' ); ?> data-template-url="<?php echo GROUND_TEMPLATE_URL; ?>">
	<?php
	/**
	 * Hook: wp_body_open.
	 *
	 * @hooked ground_woocommerce_minicart - 5
	 * @hooked ground_header_checkout - 10
	 * @hooked ground_header_type - 15
	 * @hooked ground_main_content_open - 50
	 */
	wp_body_open();
	?>