<?php
require_once 'inc/constants.php';
require_once 'inc/utilities.php';
require_once 'inc/theme-support.php';
require_once 'inc/head-output.php';
require_once 'inc/extend.php';
require_once 'inc/gutenberg.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once 'inc/extend-woocommerce.php';
}

/*

function custom_post_type_settings_init() {

	foreach ( ground_config( 'post-types.post_types' ) as $post_type ) {

		$post_type_name = $post_type['name'];

		add_settings_field(
			"page_for_{$post_type_name}",
			sprintf( __( 'Pagina per %s', 'ground' ), $post_type_name ),
			'page_for_custom_post_type_callback',
			'reading',
			'default',
			[ 'post_type' => $post_type_name ]
		);

		register_setting( 'reading', "page_for_{$post_type_name}" );
	}
}

add_action( 'admin_init', 'custom_post_type_settings_init' );

function page_for_custom_post_type_callback( $args ) {
	$post_type = $args['post_type'];
	$selected = get_option( "page_for_{$post_type}", 0 );
	wp_dropdown_pages( array(
		'name' => "page_for_{$post_type}",
		'selected' => $selected,
		'show_option_none' => __( '&mdash; Select &mdash;' ),
	) );
}






function custom_post_type_page_template( $template ) {
	foreach ( ground_config( 'post-types.post_types' ) as $post_type ) {
		$post_type_name = $post_type['name'];
		$page_id = get_option( "page_for_{$post_type_name}" );

		if ( is_page( $page_id ) ) {
			$archive_template = locate_template( "{$post_type_name}.php" );
			if ( ! empty( $archive_template ) ) {
				return $archive_template;
			}
		}
	}

	return $template;
}

add_filter( 'template_include', 'custom_post_type_page_template' );










// TODO: Gestire le priorità (Specifiche sopra)
function ground_change_templates_location( $template ) {
	// $object = get_queried_object();
	// echo "OBJECT TYPE: " . $object->post_type . "\n";
	// echo "<br>";
	// echo "GET POST TYPE: " . get_post_type() . "\n";

	$template_dir = 'layouts';
	$new_template = '';
	//$template_fallback = locate_template( "$template_dir/page.php" );

	switch ( true ) {

		// Temporanei
		// case function_exists( 'is_checkout' ) && is_checkout():
		// 	$custom_template = locate_template( 'layouts/checkout.php' );
		// 	break;

		// case function_exists( 'is_woocommerce' ) && is_woocommerce():
		// case function_exists( 'is_shop' ) && is_shop():
		// case function_exists( 'is_product' ) && is_product():
		// case function_exists( 'is_cart' ) && is_cart():
		// case function_exists( 'is_account_page' ) && is_account_page():
		// 	// Let WooCommerce handle its own templates
		// 	// return $template;
		// 	$custom_template = locate_template( 'layouts/page.php' );
		// 	break;
		// Temporanei fine




		// TODO: Verificare se rimanere coerenti e chiamare il file front-page.php
		case is_front_page(): // Site front page.
			$new_template = locate_template( "$template_dir/home.php" );
			break;

		// TODO: Verificare se rimanere coerenti e chiamare il file home.php oppure fare archive-post.php come gli altri archivi
		case is_home(): // Posts homepage.
			// $new_template = locate_template( "$template_dir/post.php");
			$new_template = locate_template( "$template_dir/archive-post.php" );
			break;

		case is_page(): // Pages.
			// Se è una pagina con associato un custom post type.
			$post_types = ground_config( 'post-types.post_types' );
			foreach ( $post_types as $post_type ) {
				$post_type_name = $post_type['name'];
				$custom_page_id = get_option( "page_for_{$post_type_name}", 0 );
				if ( is_page( $custom_page_id ) ) {
					$new_template = locate_template( "$template_dir/{$post_type_name}.php" );
					if ( $template ) {
						break;
					}
				}
			}
			// Se è un pagina con associato un template oppure page.php
			if ( ! $new_template ) {
				$page_template = get_page_template_slug();
				$new_template = $page_template ? locate_template( $page_template ) : locate_template( "$template_dir/page.php" );
			}
			break;

		// Single ground catalog
		// Single post
		case is_singular(): // Single post of any post type
			$post_type = get_post_type();
			$new_template = locate_template( "$template_dir/single-$post_type.php" );
			if ( ! $new_template ) {
				$new_template = locate_template( "$template_dir/single.php" );
			}
			break;

		case is_post_type_archive(): // Archive
			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) ) {
				$post_type = reset( $post_type );
			}
			$new_template = locate_template( "$template_dir/archive-$post_type.php", );
			if ( ! $new_template ) {
				$new_template = locate_template( "$template_dir/archive.php" );
			}
			break;

		// Archivio per le categorie
		// TODO: Verificare se si possono unire tutti gli archivi post e custom
		case is_archive(): // Archive
			echo "QUIIIII";
			$new_template = locate_template( "$template_dir/archive.php" );
			//var_dump( $template_fallback );
			var_dump( $template );
			break;


		// Tassonomie
		case is_tax():
			$term = get_queried_object();
			$new_template = locate_template( "$template_dir/taxonomy-{$term->taxonomy}.php" );
			if ( ! $new_template ) {
				$new_template = locate_template( "$template_dir/taxonomy.php" );
			}
			break;
		case is_category():
			$new_template = locate_template( "$template_dir/category.php" );
			break;
		case is_tag():
			$new_template = locate_template( "$template_dir/tag.php" );
			break;


		// Altri template
		case is_search():
			$new_template = locate_template( "$template_dir/search.php" );
			break;
		case is_404():
			$new_template = locate_template( "$template_dir/404.php" );
			break;
		case is_author():
			$new_template = locate_template( "$template_dir/author.php" );
			break;
		case is_date():
			$new_template = locate_template( "$template_dir/date.php" );
			break;
		case is_attachment():
			$new_template = locate_template( "$template_dir/attachment.php" );
			break;





		// case is_tax(): // Custom taxonomy archive page.
		// 	$new_template = locate_template( 'layouts/taxonomy-' . get_post_type() . '.php' );
		// 	break;
		// case is_category():
		// 	// TODO: Gestire il default se non trova quello specifico.
		// 	// TODO: Fare la condizione generica per gli archivi.
		// 	$new_template = locate_template( 'layouts/archive-' . get_post_type() . '.php' );
		// 	break;
		// case is_post_type_archive():
		// 	$new_template = locate_template( 'layouts/' . get_post_type() . '.php' );
		// 	break;




		// case is_search(): // Search result page.
		// 	$new_template = locate_template( 'layouts/search.php' );
		// 	break;
		// case is_404(): // Error 404 page.
		// 	$new_template = locate_template( 'layouts/404.php' );
		// 	break;


		// WooCommerce specific pages
		// case function_exists( 'is_woocommerce' ) && is_woocommerce():
		// 	$new_template = locate_template( 'layouts/woocommerce.php' );
		// 	break;
		// case function_exists( 'is_shop' ) && is_shop():
		// 	$new_template = locate_template( 'layouts/shop.php' );
		// 	break;
		// case function_exists( 'is_product' ) && is_product():
		// 	$new_template = locate_template( 'layouts/single-product.php' );
		// 	break;
		// case function_exists( 'is_cart' ) && is_cart():
		// 	$new_template = locate_template( 'layouts/cart.php' );
		// 	break;

		// case function_exists( 'is_account_page' ) && is_account_page():
		// 	$new_template = locate_template( 'layouts/account.php' );
		// 	break;

		// WooCommerce specific pages
		// case function_exists( 'is_woocommerce' ) && is_woocommerce():
		// case function_exists( 'is_shop' ) && is_shop():
		// case function_exists( 'is_product' ) && is_product():
		// case function_exists( 'is_cart' ) && is_cart():
		// //case function_exists( 'is_checkout' ) && is_checkout():
		// case function_exists( 'is_account_page' ) && is_account_page():
		// 	// Let WooCommerce handle its own templates
		// 	return $template;


		default:
			echo "DEFAULT";
			$new_template = locate_template( "$template_dir/page.php" );
	}

	// var_dump( $template );

	return ( ! empty( $new_template ) ) ? $new_template : $template;
	//return $template;
}

add_filter( 'template_include', 'ground_change_templates_location' );




// TODO: Gestire le priorità (Specifiche sopra)
function ground_change_templates_location( $template ) {
	// $object = get_queried_object();
	// echo "OBJECT TYPE: " . $object->post_type . "\n";
	// echo "<br>";
	// echo "GET POST TYPE: " . get_post_type() . "\n";

	$template_dir = 'layouts';
	$new_template = '';
	//$template_fallback = locate_template( "$template_dir/page.php" );

	switch ( true ) {

		// Temporanei
		// case function_exists( 'is_checkout' ) && is_checkout():
		// 	$custom_template = locate_template( 'layouts/checkout.php' );
		// 	break;

		// case function_exists( 'is_woocommerce' ) && is_woocommerce():
		// case function_exists( 'is_shop' ) && is_shop():
		// case function_exists( 'is_product' ) && is_product():
		// case function_exists( 'is_cart' ) && is_cart():
		// case function_exists( 'is_account_page' ) && is_account_page():
		// 	// Let WooCommerce handle its own templates
		// 	// return $template;
		// 	$custom_template = locate_template( 'layouts/page.php' );
		// 	break;
		// Temporanei fine




		// TODO: Verificare se rimanere coerenti e chiamare il file front-page.php
		case is_front_page(): // Site front page.
			$new_template = locate_template( "$template_dir/home.php" );
			break;

		// TODO: Verificare se rimanere coerenti e chiamare il file home.php oppure fare archive-post.php come gli altri archivi
		case is_home(): // Posts homepage.
			// $new_template = locate_template( "$template_dir/post.php");
			$new_template = locate_template( "$template_dir/archive-post.php" );
			break;

		case is_page(): // Pages.
			// Se è una pagina con associato un custom post type.
			$post_types = ground_config( 'post-types.post_types' );
			foreach ( $post_types as $post_type ) {
				$post_type_name = $post_type['name'];
				$custom_page_id = get_option( "page_for_{$post_type_name}", 0 );
				if ( is_page( $custom_page_id ) ) {
					$new_template = locate_template( "$template_dir/{$post_type_name}.php" );
					if ( $template ) {
						break;
					}
				}
			}
			// Se è un pagina con associato un template oppure page.php
			if ( ! $new_template ) {
				$page_template = get_page_template_slug();
				$new_template = $page_template ? locate_template( $page_template ) : locate_template( "$template_dir/page.php" );
			}
			break;

		// Single ground catalog
		// Single post
		case is_singular(): // Single post of any post type
			$post_type = get_post_type();
			$new_template = locate_template( "$template_dir/single-$post_type.php" );
			if ( ! $new_template ) {
				$new_template = locate_template( "$template_dir/single.php" );
			}
			break;

		case is_post_type_archive(): // Archive
			$post_type = get_query_var( 'post_type' );
			if ( is_array( $post_type ) ) {
				$post_type = reset( $post_type );
			}
			$new_template = locate_template( "$template_dir/archive-$post_type.php", );
			if ( ! $new_template ) {
				$new_template = locate_template( "$template_dir/archive.php" );
			}
			break;

		// Archivio per le categorie
		// TODO: Verificare se si possono unire tutti gli archivi post e custom
		case is_archive(): // Archive
			echo "QUIIIII";
			$new_template = locate_template( "$template_dir/archive.php" );
			//var_dump( $template_fallback );
			var_dump( $template );
			break;


		// Tassonomie
		case is_tax():
			$term = get_queried_object();
			$new_template = locate_template( "$template_dir/taxonomy-{$term->taxonomy}.php" );
			if ( ! $new_template ) {
				$new_template = locate_template( "$template_dir/taxonomy.php" );
			}
			break;
		case is_category():
			$new_template = locate_template( "$template_dir/category.php" );
			break;
		case is_tag():
			$new_template = locate_template( "$template_dir/tag.php" );
			break;


		// Altri template
		case is_search():
			$new_template = locate_template( "$template_dir/search.php" );
			break;
		case is_404():
			$new_template = locate_template( "$template_dir/404.php" );
			break;
		case is_author():
			$new_template = locate_template( "$template_dir/author.php" );
			break;
		case is_date():
			$new_template = locate_template( "$template_dir/date.php" );
			break;
		case is_attachment():
			$new_template = locate_template( "$template_dir/attachment.php" );
			break;





		// case is_tax(): // Custom taxonomy archive page.
		// 	$new_template = locate_template( 'layouts/taxonomy-' . get_post_type() . '.php' );
		// 	break;
		// case is_category():
		// 	// TODO: Gestire il default se non trova quello specifico.
		// 	// TODO: Fare la condizione generica per gli archivi.
		// 	$new_template = locate_template( 'layouts/archive-' . get_post_type() . '.php' );
		// 	break;
		// case is_post_type_archive():
		// 	$new_template = locate_template( 'layouts/' . get_post_type() . '.php' );
		// 	break;




		// case is_search(): // Search result page.
		// 	$new_template = locate_template( 'layouts/search.php' );
		// 	break;
		// case is_404(): // Error 404 page.
		// 	$new_template = locate_template( 'layouts/404.php' );
		// 	break;


		// WooCommerce specific pages
		// case function_exists( 'is_woocommerce' ) && is_woocommerce():
		// 	$new_template = locate_template( 'layouts/woocommerce.php' );
		// 	break;
		// case function_exists( 'is_shop' ) && is_shop():
		// 	$new_template = locate_template( 'layouts/shop.php' );
		// 	break;
		// case function_exists( 'is_product' ) && is_product():
		// 	$new_template = locate_template( 'layouts/single-product.php' );
		// 	break;
		// case function_exists( 'is_cart' ) && is_cart():
		// 	$new_template = locate_template( 'layouts/cart.php' );
		// 	break;

		// case function_exists( 'is_account_page' ) && is_account_page():
		// 	$new_template = locate_template( 'layouts/account.php' );
		// 	break;

		// WooCommerce specific pages
		// case function_exists( 'is_woocommerce' ) && is_woocommerce():
		// case function_exists( 'is_shop' ) && is_shop():
		// case function_exists( 'is_product' ) && is_product():
		// case function_exists( 'is_cart' ) && is_cart():
		// //case function_exists( 'is_checkout' ) && is_checkout():
		// case function_exists( 'is_account_page' ) && is_account_page():
		// 	// Let WooCommerce handle its own templates
		// 	return $template;


		default:
			echo "DEFAULT";
			$new_template = locate_template( "$template_dir/page.php" );
	}

	// var_dump( $template );

	return ( ! empty( $new_template ) ) ? $new_template : $template;
	//return $template;
}

add_filter( 'template_include', 'ground_change_templates_location' );
*/


