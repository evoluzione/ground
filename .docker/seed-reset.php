<?php
/**
 * Remove everything created by seed.php, so ENABLE_SEED can run again cleanly.
 *
 * Run via `wp eval-file /docker-scripts/seed-reset.php` (npm: docker:seed-reset).
 * Deletes posts/attachments, taxonomy terms and nav menus tagged `_ground_seed`,
 * restores the front-page options and drops the `ground_seed_done` guard.
 *
 * NOTE: this does NOT remove content imported from the WordPress test-data XML
 * (that content is not tagged). Use `npm run docker:reset` to wipe the whole DB.
 */

// Posts (any type) plus attachments. WP_Query's 'any' EXCLUDES attachments
// (they are exclude_from_search), so query them separately and merge.
$post_ids = get_posts( array(
	'post_type'   => 'any',
	'post_status' => 'any',
	'numberposts' => -1,
	'fields'      => 'ids',
	'meta_key'    => '_ground_seed',
) );

$attachment_ids = get_posts( array(
	'post_type'   => 'attachment',
	'post_status' => 'any',
	'numberposts' => -1,
	'fields'      => 'ids',
	'meta_key'    => '_ground_seed',
) );

$all_ids = array_merge( $post_ids, $attachment_ids );
foreach ( $all_ids as $id ) {
	wp_delete_post( $id, true );
}

echo 'reset: deleted ' . count( $all_ids ) . " posts/attachments\n";

// Terms tagged _ground_seed across the taxonomies the seed touches (catalog
// taxonomy + nav menus). Deleting a nav_menu term also removes its menu items.
$terms = get_terms( array(
	'taxonomy'   => array( 'ground_catalog_taxonomy', 'nav_menu' ),
	'hide_empty' => false,
	'fields'     => 'all',
	'meta_query' => array(
		array(
			'key'     => '_ground_seed',
			'compare' => 'EXISTS',
		),
	),
) );

$term_count = 0;
if ( ! is_wp_error( $terms ) ) {
	foreach ( $terms as $term ) {
		wp_delete_term( $term->term_id, $term->taxonomy );
		$term_count++;
	}
}

echo 'reset: deleted ' . $term_count . " terms/menus\n";

// Restore front-page settings and drop the run-once guard.
update_option( 'show_on_front', 'posts' );
delete_option( 'page_on_front' );
delete_option( 'page_for_posts' );
delete_option( 'ground_seed_done' );

echo "reset: front page restored, guard cleared\n";
