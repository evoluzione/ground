<?php
//  TODO: Portarli nel config?
define( 'GROUND_VERSION', wp_get_theme()->Version ); // Return the styles.css theme version.
define( 'GROUND_SITE_URL', site_url() ); // Return http://www.site.com.
// TODO: Rinominare template con theme?
define( 'GROUND_TEMPLATE_URL', get_template_directory_uri() ); // Return http://www.site.com/wp-content/themes/themename.
define( 'GROUND_TEMPLATE_PATH', get_template_directory() ); // Return /home/user/public_html/wp-content/themes/themename.