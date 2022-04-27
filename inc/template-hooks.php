<?php

/**
 * Header, Add header switch type
 */
function ground_header_type() {
	if ( class_exists( 'WooCommerce' ) && is_checkout() ) {
		return;
	}

	$header_type = GROUND_HEADER_TYPE;
	switch ( $header_type ) {
		case 'menu':
			get_template_part( 'template-parts/header/header-simple' );
			break;
		case 'menuCentered':
			get_template_part( 'template-parts/header/header-logo-centered' );
			break;
		case 'megaMenu':
			get_template_part( 'template-parts/header/header-mega-menu' );
			break;
		case 'custom':
			get_template_part( 'template-parts/header/header-custom' );
			break;
		default:
			get_template_part( 'template-parts/header/header-simple' );
	}
}

add_action( 'wp_body_open', 'ground_header_type', 15 );

/**
 * Footer, Add pre footer partials
 */
function ground_pre_footer() {
	get_template_part( 'template-parts/footer/pre-footer' );
}

add_action( 'wp_footer', 'ground_pre_footer', 5 );

/**
 * Footer, Add newsletter partials
 */
function ground_newsletter() {
	get_template_part( 'template-parts/shared/newsletter' );
}

add_action( 'wp_footer', 'ground_newsletter', 8 );

/**
 * Footer, Add footer switch type
 */
function ground_footer_type() {
	get_template_part( 'template-parts/footer/footer-simple' );
}

add_action( 'wp_footer', 'ground_footer_type', 10 );

/**
 * Search form
 */
function ground_search_form() {
	 get_template_part( 'template-parts/search/search-form' );
}

add_action( 'wp_footer', 'ground_search_form', 15 );

/**
 * Modal
 */
function ground_modal() {
	get_template_part( 'template-parts/shared/modal' );
}

// add_action( 'wp_footer', 'ground_modal', 20 );

/**
 * Main open
 */
function ground_main_content_open() { ?>
	<main role="main" id="main">
	<?php
}

add_action( 'wp_body_open', 'ground_main_content_open', 50 );

/**
 * Main close
 */
function ground_main_content_close() {
	echo '</main>';
}

add_action( 'wp_footer', 'ground_main_content_close', 3 );


/**
 * Breadcrumbs
 */
function ground_breadcrumbs() {
	get_template_part( 'template-parts/shared/breadcrumbs' );
}

add_action( 'ground_single_post_before', 'ground_breadcrumbs', 20 );
add_action( 'ground_page_before', 'ground_breadcrumbs', 20 );
add_action( 'ground_search_before', 'ground_breadcrumbs', 20 );
add_action( 'ground_index_before', 'ground_breadcrumbs', 20 );
add_action( 'ground_archive_before', 'ground_breadcrumbs', 20 );
