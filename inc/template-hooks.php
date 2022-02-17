<?php

/**
 * Header, Add header switch type
 */
function ground_header_type()
{

	if (class_exists('WooCommerce') && is_checkout()) {
		return;
	}

	$header_type = GROUND_HEADER_TYPE;
	switch ($header_type) {
		case 'menu':
			get_template_part('partials/headers/header', 'simple');
			break;
		case 'menuCentered':
			get_template_part('partials/headers/header', 'logo-centered');
			break;
		case 'megaMenu':
			get_template_part('partials/headers/header', 'mega-menu');
			break;
		default:
			get_template_part('partials/headers/header', 'simple');
	}
}

add_action('ground_header', 'ground_header_type', 10);

/**
 * Footer, Add pre footer partials
 */
function ground_pre_footer()
{
	get_template_part('partials/pre-footer');
}

add_action('ground_footer', 'ground_pre_footer', 5);

/**
 * Footer, Add newsletter partials
 */
function ground_newsletter()
{
	get_template_part('partials/newsletter');
}

add_action('ground_footer', 'ground_newsletter', 8);

/**
 * Footer, Add footer switch type
 */
function ground_footer_type()
{
	get_template_part('partials/footers/footer', 'simple');
}

add_action('ground_footer', 'ground_footer_type', 10);









/**
 * Search form
 */
function ground_search_form()
{
	get_template_part('partials/search', 'form');
}

add_action('ground_footer', 'ground_search_form', 15);



/**
 * Modal
 */
function ground_modal()
{
	get_template_part('partials/modal');
}

// add_action( 'ground_footer', 'ground_modal', 20 );

/**
 * Debug grid
 */
function ground_debug_grid()
{
	get_template_part('partials/debug-grid');
}

// add_action( 'ground_footer', 'ground_debug_grid', 25 );
