<?php
// Define the theme version based on the version specified in the styles.css file.
define( 'GROUND_VERSION', wp_get_theme()->Version );

// Define the full URL of the site (e.g., https://www.example.com).
define( 'GROUND_SITE_URL', site_url() );

// Define the URL to the current theme's directory (e.g., https://www.example.com/wp-content/themes/themename).
define( 'GROUND_TEMPLATE_DIRECTORY_URI', get_template_directory_uri() );

// Define the absolute server path to the current theme's directory (e.g., /home/user/public_html/wp-content/themes/themename).
define( 'GROUND_TEMPLATE_DIRECTORY', get_template_directory() );