<!doctype html>
<html <?php language_attributes(); ?> class="is-loading scroll-smooth">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="<?php echo GROUND_TEMPLATE_DIRECTORY_URI . '/assets/img/favicon.ico'; ?>" sizes="any">
	<link rel="icon" href="<?php echo GROUND_TEMPLATE_DIRECTORY_URI . '/assets/img/icon.svg'; ?>" type="image/svg+xml">
	<link rel="apple-touch-icon" href="<?php echo GROUND_TEMPLATE_DIRECTORY_URI . '/assets/img/icon.png'; ?>">

	<meta name="theme-color" content="<?php echo esc_attr( ground_config( 'theme.theme-color' ) ); ?>">
	<meta name="theme-url" content="<?php echo GROUND_TEMPLATE_DIRECTORY_URI; ?>">
	<?php wp_head(); ?>
</head>

<body id="body" <?php body_class( 'font-primary overflow-x-hidden' ); ?>>

	<?php wp_body_open(); ?>

	<?php if ( class_exists( 'WooCommerce' ) && is_checkout() ) {
		get_template_part( 'template-parts/content/content-header-secondary' );
	} else {
		get_template_part( 'template-parts/content/content-header-primary' );
	} ?>
