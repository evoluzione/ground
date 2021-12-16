<!doctype html>
<html <?php language_attributes(); ?> class="has-no-js is-loading scroll-smooth">

<head>
	<meta charset="<?php echo GROUND_CHARSET; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="">
	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
		<link rel="icon" type="image/png" href="<?php echo GROUND_TEMPLATE_URL . '/img/favicon.png'; ?>">
		<link rel="apple-touch-icon" href="<?php echo GROUND_TEMPLATE_URL . '/img/icon.png'; ?>">
	<?php } ?>
	<?php wp_head(); ?>
</head>

<body id="scroll-top" <?php body_class( 'font-primary bg-body-primary text-typo-primary debug-screens' ); ?> data-template-url="<?php echo GROUND_TEMPLATE_URL; ?>">

	<?php do_action( 'ground_before_site' ); ?>

	<?php
	/**
	 * Hook: ground_before_header.
	 *
	 * @hooked ground_woocommerce_minicart - 10
	 */
	do_action( 'ground_before_header' );
	?>

	<?php
	/**
	 * Hook: ground_header.
	 *
	 * @hooked ground_header_type - 10
	 */
	do_action( 'ground_header' );
	?>

	<div data-router-wrapper>

		<div <?php ground_view_name(); ?>>

			<main role="main">
