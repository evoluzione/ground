<!doctype html>
<html <?php language_attributes(); ?> class="has-no-js is-loading">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( ! has_site_icon() ) { ?>
		<link rel="icon" type="image/png" href="<?php echo GROUND_TEMPLATE_URL . '/assets/img/favicon.png'; ?>">
		<link rel="apple-touch-icon" href="<?php echo GROUND_TEMPLATE_URL . '/assets/img/icon.png'; ?>">
	<?php } ?>
	<meta name="theme-color" content="<?php ground_config( 'theme.theme-color' ) ?>">
	<!-- TODO: Prendere il valore dal config? -->
	<meta name="theme-url" content="<?php echo GROUND_TEMPLATE_URL; ?>">
	<?php wp_head(); ?>
</head>

<body id="body" <?php body_class( 'font-primary overflow-x-hidden' ); ?>>

	<?php wp_body_open(); ?>

	<?php if ( class_exists( 'WooCommerce' ) && is_checkout() ) {
		get_template_part( 'template-parts/content/content-header-secondary' );
	} else {
		get_template_part( 'template-parts/content/content-header' );
	} ?>

	<?php //echo '<pre>' . var_export( ground_config( "", false ), true ) . '</pre>'; ?>