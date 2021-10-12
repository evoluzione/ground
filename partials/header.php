<!doctype html>
<html <?php language_attributes(); ?> class="has-no-js is-loading">

<head>
	<meta charset="<?php echo GROUND_CHARSET; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="<?php echo GROUND_COLOR_PRIMARY; ?>">
	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
		<link rel="icon" type="image/png" href="<?php echo GROUND_TEMPLATE_URL . '/img/favicon.png'; ?>">
		<link rel="apple-touch-icon" href="<?php echo GROUND_TEMPLATE_URL . '/img/icon.png'; ?>">
	<?php } ?>
	<?php wp_head(); ?>
</head>

<body id="scroll-top" <?php body_class( 'font-primary debug-screens' ); ?> data-template-url="<?php echo GROUND_TEMPLATE_URL; ?>">

	<div class="scroll" id="js-scroll">

		<?php get_template_part( 'partials/woocommerce/minicart' ); ?>

		<?php get_template_part( 'partials/content', 'header' ); ?>

		<div data-router-wrapper>

			<div <?php ground_view_name(); ?>>

					<main role="main">


