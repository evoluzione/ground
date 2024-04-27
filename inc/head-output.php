<?php
/**
 * Register and enqueue CSS
 */
function ground_enqueue_styles() {
	$defaults = array(
		'handle' => '',
		'src' => '',
		'deps' => [],
		'ver' => GROUND_VERSION,
		'media' => 'all',
	);

	foreach ( ground_config( 'assets.styles' ) as $sidebar ) {
		$params = wp_parse_args( $sidebar, $defaults );
		wp_enqueue_style( $params['handle'], $params['src'], $params['deps'], $params['ver'], $params['media'] );
	}
}

add_action( 'wp_enqueue_scripts', 'ground_enqueue_styles', 9 );

/**
 * Register and enqueue JS
 */
function ground_enqueue_scripts() {
	$defaults = array(
		'handle' => '',
		'src' => '',
		'deps' => [],
		'ver' => GROUND_VERSION,
		'args' => [ 
			'strategy' => '', // May be either 'defer' or 'async'.
			'in_footer' => true,
		],
	);

	foreach ( ground_config( 'assets.scripts' ) as $sidebar ) {
		$params = wp_parse_args( $sidebar, $defaults );
		wp_enqueue_script( $params['handle'], $params['src'], $params['deps'], $params['ver'], $params['args'] );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'ground_enqueue_scripts', 1 );

/**
 * Clean up head output
 */
function ground_clean_head_output() {
	// Remove WordPress version.
	remove_action( 'wp_head', 'wp_generator' );

	// Remove post, page, attachment shortlink.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
}

add_action( 'init', 'ground_clean_head_output' );

/**
 * Remove login logo
 */
function ground_login_css() { ?>
	<style type="text/css">
		#login h1 {
			display: none;
		}
	</style>
	<?php
}

add_action( 'login_enqueue_scripts', 'ground_login_css' );
