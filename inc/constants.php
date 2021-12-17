<?php

/**
 * Constants
 *
 * @package Ground
 */

define( 'GROUND_VERSION', is_child_theme() ? wp_get_theme()->parent()->Version : wp_get_theme()->Version ); // Return the styles.css theme version.
define( 'GROUND_SITE_URL', site_url() ); // Return http://www.site.com.
define( 'GROUND_TEMPLATE_URL', get_template_directory_uri() ); // Return http://www.site.com/wp-content/themes/themename.
define( 'GROUND_TEMPLATE_PATH', get_template_directory() ); // Return /home/user/public_html/wp-content/themes/themename.
define( 'GROUND_CHARSET', get_bloginfo( 'charset' ) ); // The "Encoding for pages and feeds" (set in Settings > Reading).

