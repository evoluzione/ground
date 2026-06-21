<?php
/**
 * Development seed for the "ground" theme.
 *
 * Run headless via `wp eval-file /docker-scripts/seed.php` from provision.sh,
 * gated by ENABLE_SEED and the `ground_seed_done` option (runs once).
 *
 * Covers the theme-specific structures that the generic WordPress test-data XML
 * cannot: the `ground_catalog` CPT, its `ground_catalog_taxonomy` (with the ACF
 * `taxonomy_image`), the five theme nav-menu locations, a static front page, and
 * a demo page exercising the `acf/starter` ACF block.
 *
 * Every created object is tagged with the `_ground_seed` meta so it can be wiped:
 *   wp post delete $(wp post list --meta_key=_ground_seed --format=ids) --force
 */

// Admin includes are not auto-loaded under WP-CLI; needed for media sideloading.
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

/**
 * Download a real placeholder image into the media library.
 *
 * Produces a genuine attachment (so thumbnails, srcset and lazyload are exercised).
 * Requires network access on first run; returns 0 on failure so seeding continues.
 *
 * The `.jpg` suffix is required: picsum URLs are extension-less and WordPress
 * rejects those. download_url + media_handle_sideload lets us also set a clean
 * filename (e.g. prod-1.jpg) instead of the picsum path basename.
 */
function ground_seed_image( $post_id, $seed ) {
	$tmp = download_url( "https://picsum.photos/seed/{$seed}/1200/800.jpg" );
	if ( is_wp_error( $tmp ) ) {
		return 0;
	}

	$id = media_handle_sideload(
		array(
			'name'     => $seed . '.jpg',
			'tmp_name' => $tmp,
		),
		$post_id
	);

	if ( is_wp_error( $id ) ) {
		@unlink( $tmp );
		return 0;
	}

	// Tag the attachment so seed-reset can clean it up (no orphaned media).
	update_post_meta( (int) $id, '_ground_seed', 1 );

	return (int) $id;
}

/**
 * Find a published page by slug (stable across title renames); 0 if none.
 */
function ground_find_page_by_slug( $slug ) {
	$found = get_posts( array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'name'        => $slug,
		'numberposts' => 1,
		'fields'      => 'ids',
	) );
	return $found ? (int) $found[0] : 0;
}

/**
 * Adopt an imported page (looked up by its stable slug) into the scaffold,
 * renaming its title for a consistent nav / page heading / breadcrumb. Returns
 * the id, or 0 if absent (e.g. the test-data XML was not imported).
 *
 * Detection is by slug, NOT title, so re-runs stay idempotent after the rename.
 * Requires the XML import to run BEFORE this seed.
 */
function ground_adopt_page( $slug, $new_title ) {
	$id = ground_find_page_by_slug( $slug );
	if ( $id && get_the_title( $id ) !== $new_title ) {
		wp_update_post( array( 'ID' => $id, 'post_title' => $new_title ) );
	}
	return (int) $id;
}

echo "  seed: catalog taxonomy terms\n";

$term_names = array( 'Outdoor', 'Indoor', 'Accessori' );
$term_ids   = array();

foreach ( $term_names as $i => $name ) {
	$existing = term_exists( $name, 'ground_catalog_taxonomy' );
	if ( $existing ) {
		$term_ids[] = (int) $existing['term_id'];
		continue;
	}

	$term = wp_insert_term( $name, 'ground_catalog_taxonomy' );
	if ( is_wp_error( $term ) ) {
		continue;
	}

	$term_id    = (int) $term['term_id'];
	$term_ids[] = $term_id;
	update_term_meta( $term_id, '_ground_seed', 1 );

	// The ACF "Taxonomies" group attaches an image field to this taxonomy.
	$image_id = ground_seed_image( 0, 'term-' . $i );
	if ( $image_id && function_exists( 'update_field' ) ) {
		update_field( 'taxonomy_image', $image_id, 'ground_catalog_taxonomy_' . $term_id );
	}
}

echo "  seed: catalog products (CPT ground_catalog)\n";

$product_ids = array();

for ( $i = 1; $i <= 12; $i++ ) {
	$product_id = wp_insert_post( array(
		'post_type'    => 'ground_catalog',
		'post_status'  => 'publish',
		'post_title'   => sprintf( 'Prodotto demo %02d', $i ),
		'post_excerpt' => 'Excerpt di esempio per testare le card del catalogo.',
		'post_content' => "<!-- wp:paragraph --><p>Descrizione demo del prodotto {$i}. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p><!-- /wp:paragraph -->",
		'meta_input'   => array( '_ground_seed' => 1 ),
	) );

	if ( is_wp_error( $product_id ) || ! $product_id ) {
		continue;
	}

	$product_ids[] = $product_id;

	$image_id = ground_seed_image( $product_id, 'prod-' . $i );
	if ( $image_id ) {
		set_post_thumbnail( $product_id, $image_id );
	}

	if ( $term_ids ) {
		wp_set_object_terms( $product_id, array( $term_ids[ $i % count( $term_ids ) ] ), 'ground_catalog_taxonomy' );
	}
}

echo "  seed: ACF block demo page\n";

// Inline ACF block markup. The `_title` => field key pair is how ACF binds the
// value to the field defined in config/acf/group_5ddd341334ac3.json.
$acf_block = '<!-- wp:acf/starter {"name":"acf/starter","data":{"title":"Titolo demo dello Starter block","_title":"field_618cd45b00009"},"mode":"preview"} /-->';

$acf_page_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Demo blocco ACF',
	'post_content' => $acf_block,
	'meta_input'   => array( '_ground_seed' => 1 ),
) );

echo "  seed: front & blog pages\n";

// Adopt the test-data's purpose-built pages when present (the XML import runs
// first), renaming them; otherwise create our own. No duplicate Home/Blog pages.
$front_id = ground_adopt_page( 'front-page', 'Home' );
if ( ! $front_id ) {
	$front_id = wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => 'Home',
		'post_content' => "<!-- wp:paragraph --><p>Front page demo del tema Ground.</p><!-- /wp:paragraph -->",
		'meta_input'   => array( '_ground_seed' => 1 ),
	) );
}
if ( $front_id && ! is_wp_error( $front_id ) ) {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', (int) $front_id );
}

$blog_id = ground_adopt_page( 'blog', 'Blog' );
if ( ! $blog_id ) {
	$blog_id = wp_insert_post( array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'post_title'  => 'Blog',
		'meta_input'  => array( '_ground_seed' => 1 ),
	) );
}
if ( $blog_id && ! is_wp_error( $blog_id ) ) {
	update_option( 'page_for_posts', (int) $blog_id );
}

// --- Scaffold pages referenced by the navigation ---
echo "  seed: scaffold pages (Catalogo, Contatti, Esempi)\n";

// Catalogo → uses the theme's "Catalog" page template.
$catalog_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Catalogo',
	'post_content' => "<!-- wp:paragraph --><p>Pagina catalogo (template Catalog).</p><!-- /wp:paragraph -->",
	'meta_input'   => array(
		'_ground_seed'      => 1,
		'_wp_page_template' => 'templates/template-ground_catalog.php',
	),
) );

// Contatti → embeds the default Contact Form 7 dummy form.
$cf7_ids      = get_posts( array( 'post_type' => 'wpcf7_contact_form', 'numberposts' => 1, 'fields' => 'ids' ) );
$cf7_id       = $cf7_ids ? (int) $cf7_ids[0] : 0;
$contact_body = $cf7_id
	? '<!-- wp:shortcode -->[contact-form-7 id="' . $cf7_id . '"]<!-- /wp:shortcode -->'
	: '<!-- wp:paragraph --><p>Contact Form 7 non disponibile.</p><!-- /wp:paragraph -->';
$contact_id   = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Contatti',
	'post_content' => $contact_body,
	'meta_input'   => array( '_ground_seed' => 1 ),
) );

// Esempi → landing page that parents the imported test-content submenu.
$examples_id = wp_insert_post( array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => 'Esempi',
	'post_content' => "<!-- wp:paragraph --><p>Raccolta di contenuti importati per testare blocchi e markup.</p><!-- /wp:paragraph -->",
	'meta_input'   => array( '_ground_seed' => 1 ),
) );

echo "  seed: nav menus (5 theme locations)\n";

// WooCommerce auto-creates a Shop page; reference it only when WooCommerce is on.
$shop_id = function_exists( 'wc_get_page_id' ) ? (int) wc_get_page_id( 'shop' ) : 0;
if ( $shop_id < 1 ) {
	$shop_id = 0;
}

// Imported posts (from the test-data XML) used as the "Esempi" submenu — picked
// by stable slug so they survive re-imports of the vendored XML (0 if absent).
$example_slugs = array( 'image', 'gallery', 'cover', 'columns', 'media-text', 'table', 'preformatted', 'template-sticky' );

/** Look up a published post/page id by slug; 0 if absent (e.g. dataset removed). */
$post_by_slug = function ( $slug, $type = 'post' ) {
	$found = get_posts( array(
		'name'        => $slug,
		'post_type'   => $type,
		'post_status' => 'publish',
		'numberposts' => 1,
		'fields'      => 'ids',
	) );
	return $found ? (int) $found[0] : 0;
};

/** Add an object (page/CPT) menu item; returns the new menu-item id (for parenting). */
$add_object_item = function ( $menu_id, $object_id, $object_type, $parent = 0, $title = '' ) {
	if ( ! $object_id ) {
		return 0;
	}
	return (int) wp_update_nav_menu_item( $menu_id, 0, array(
		'menu-item-title'     => $title !== '' ? $title : get_the_title( $object_id ),
		'menu-item-object-id' => (int) $object_id,
		'menu-item-object'    => $object_type,
		'menu-item-type'      => 'post_type',
		'menu-item-parent-id' => (int) $parent,
		'menu-item-status'    => 'publish',
	) );
};

/** Create (or reuse) a nav menu by label, tagged for cleanup. Emptied on reuse
 *  so re-running rebuilds the items cleanly (idempotent). */
$ensure_menu = function ( $label ) {
	$id = wp_create_nav_menu( $label );
	if ( is_wp_error( $id ) ) {
		$existing = wp_get_nav_menu_object( $label );
		$id       = $existing ? (int) $existing->term_id : 0;
	}
	if ( $id ) {
		update_term_meta( $id, '_ground_seed', 1 );
		foreach ( wp_get_nav_menu_items( $id ) as $item ) {
			wp_delete_post( $item->ID, true );
		}
	}
	return (int) $id;
};

$assignments = array();

// Header primary — main navigation: Blog, Shop, Catalogo, Esempi▾, Contatti.
// (No "Home": the logo already links home.)
$header_primary = $ensure_menu( 'Header primary (demo)' );
if ( $header_primary ) {
	$add_object_item( $header_primary, $blog_id, 'page' );
	$add_object_item( $header_primary, $shop_id, 'page' ); // skipped if 0 (Woo off)
	$add_object_item( $header_primary, $catalog_id, 'page' );

	// "Esempi" parent + a submenu of imported test posts.
	$examples_item = $add_object_item( $header_primary, $examples_id, 'page' );
	foreach ( $example_slugs as $slug ) {
		$add_object_item( $header_primary, $post_by_slug( $slug, 'post' ), 'post', $examples_item );
	}

	// "Livelli" — imported page hierarchy (Level 1 > Level 2 > Level 3), to test
	// multi-level dropdowns and subpages in the navigation.
	$level1 = $add_object_item( $header_primary, ground_adopt_page( 'level-1', 'Livelli' ), 'page' );
	if ( $level1 ) {
		$level2 = $add_object_item( $header_primary, $post_by_slug( 'level-2', 'page' ), 'page', $level1 );
		if ( $level2 ) {
			$add_object_item( $header_primary, $post_by_slug( 'level-3', 'page' ), 'page', $level2 );
		}
		$add_object_item( $header_primary, $post_by_slug( 'level-2a', 'page' ), 'page', $level1 );
		$add_object_item( $header_primary, $post_by_slug( 'level-2b', 'page' ), 'page', $level1 );
	}

	// "Pagine" — imported "About The Tests" page + all its subpages (image
	// alignment, markup/formatting, comments…). Children fetched dynamically.
	$about_tests = ground_adopt_page( 'about', 'Pagine' );
	if ( $about_tests ) {
		$about_item = $add_object_item( $header_primary, $about_tests, 'page' );
		$about_kids = get_posts( array(
			'post_type'   => 'page',
			'post_parent' => $about_tests,
			'post_status' => 'publish',
			'numberposts' => -1,
			'orderby'     => 'menu_order title',
			'order'       => 'ASC',
			'fields'      => 'ids',
		) );
		foreach ( $about_kids as $kid ) {
			$add_object_item( $header_primary, $kid, 'page', $about_item );
		}
	}

	$add_object_item( $header_primary, $contact_id, 'page' );

	$assignments['navigation-header-primary'] = $header_primary;
}

// Header secondary — small utility bar.
$header_secondary = $ensure_menu( 'Header secondary (demo)' );
if ( $header_secondary ) {
	$add_object_item( $header_secondary, $acf_page_id, 'page' );
	$assignments['navigation-header-secondary'] = $header_secondary;
}

// Footer primary — quick links.
$footer_primary = $ensure_menu( 'Footer primary (demo)' );
if ( $footer_primary ) {
	$add_object_item( $footer_primary, $catalog_id, 'page' );
	$add_object_item( $footer_primary, $contact_id, 'page' );
	$assignments['navigation-footer-primary'] = $footer_primary;
}

// Footer secondary — "Catalogo" column with real products.
$footer_secondary = $ensure_menu( 'Footer secondary (demo)' );
if ( $footer_secondary ) {
	for ( $i = 0; $i < 3; $i++ ) {
		if ( isset( $product_ids[ $i ] ) ) {
			$add_object_item( $footer_secondary, $product_ids[ $i ], 'ground_catalog' );
		}
	}
	$assignments['navigation-footer-secondary'] = $footer_secondary;
}

// Footer tertiary — misc links.
$footer_tertiary = $ensure_menu( 'Footer tertiary (demo)' );
if ( $footer_tertiary ) {
	$add_object_item( $footer_tertiary, $front_id, 'page' );
	$add_object_item( $footer_tertiary, $blog_id, 'page' );
	$assignments['navigation-footer-tertiary'] = $footer_tertiary;
}

set_theme_mod( 'nav_menu_locations', $assignments );

echo "  seed: done\n";
