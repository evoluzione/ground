<?php

/**
 * Head output
 *
 * @package Ground
 */

/**
 * Register and enqueue CSS
 */
function ground_enqueue_styles()
{
	if (class_exists('WooCommerce')) {
		wp_enqueue_style('ground-styles', GROUND_TEMPLATE_URL . '/dist/css/styles-wc.min.css', array(), GROUND_VERSION, 'all');
	} else {
		wp_enqueue_style('ground-styles', GROUND_TEMPLATE_URL . '/dist/css/styles.min.css', array(), GROUND_VERSION, 'all');
	}

	wp_enqueue_style('swiper-style', 'https://unpkg.com/swiper@6.5.4/swiper-bundle.min.css', array(), null, 'all');
}

add_action('wp_enqueue_scripts', 'ground_enqueue_styles', 9);


/**
 * Add CSS Fonts Source
 */
function ground_add_fonts_source()
{
	echo GROUND_FONT_SOURCE_PRIMARY;
	echo GROUND_FONT_SOURCE_SECONDARY;
}

add_action('wp_head', 'ground_add_fonts_source');


/**
 * Add CSS theme variables
 */
function ground_add_css_theme_variables()
{
	echo '<style type="text/css">
		:root {
			--ground-color-primary:' . GROUND_COLOR_PRIMARY . ';
			--ground-color-secondary:' . GROUND_COLOR_SECONDARY . ';
			--ground-color-tertiary:' . GROUND_COLOR_TERTIARY . ';
			--ground-color-quaternary:' . GROUND_COLOR_QUATERNARY . ';
			--ground-color-quinary:' . GROUND_COLOR_QUINARY . ';
			--ground-color-senary:' . GROUND_COLOR_SENARY . ';
			--ground-color-septenary:' . GROUND_COLOR_SEPTENARY . ';
			--ground-color-octonary:' . GROUND_COLOR_OCTONARY . ';
			--ground-font-primary:' . GROUND_FONT_FAMILY_PRIMARY . ';
			--ground-font-secondary:' . GROUND_FONT_FAMILY_SECONDARY . ';
			--ground-rounded-theme:' . GROUND_ROUNDED_THEME . 'px;
			--ground-rounded-media:' . GROUND_ROUNDED_MEDIA . 'px;
	} </style>';
}

add_action('wp_head', 'ground_add_css_theme_variables');

/**
 * Register and enqueue JS
 */
function ground_enqueue_scripts()
{
	// wp_deregister_script( 'jquery' );
	// wp_enqueue_script( 'jquery', "https://code.jquery.com/jquery-3.5.0.min.js", array(), null, true );
	wp_enqueue_script('ground-scripts', GROUND_TEMPLATE_URL . '/dist/js/scripts.min.js', array('jquery'), GROUND_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}

add_action('wp_enqueue_scripts', 'ground_enqueue_scripts', 1);

/**
 * Clean up head output
 */
function ground_head_output()
{
	// Enables RSS posts and comments.
	add_theme_support('automatic-feed-links');
	// Allows themes to add document title tag to HTML <head>.
	add_theme_support('title-tag');
	// Remove adjacent posts links to the current post.
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// Remove the Really Simple Discovery service endpoint, EditURI link.
	remove_action('wp_head', 'rsd_link');
	// Remove the link to Windows Live Writer.
	remove_action('wp_head', 'wlwmanifest_link');
	// Remove WordPress version.
	remove_action('wp_head', 'wp_generator');
	// Remove post, page, attachment shortlink.
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	// Remove recent comments inline styles.
	add_filter('show_recent_comments_widget_style', '__return_false');
	// Remove rel canonical.
	// remove_action( 'wp_head', 'rel_canonical' );
}

add_action('init', 'ground_head_output');

/**
 * Remove login logo
 */
function ground_login_css()
{  ?>
	<style type="text/css">
		#login h1 {
			display: none;
		}
	</style>
<?php
}

add_action('login_enqueue_scripts', 'ground_login_css');
