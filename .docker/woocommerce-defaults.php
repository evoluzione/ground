<?php
/**
 * Baseline WooCommerce store settings for local development.
 *
 * Run via `wp eval-file /docker-scripts/woocommerce-defaults.php` from provision.sh,
 * every pass. Fresh WooCommerce installs are US-flavoured and, since the "Launch
 * your store" feature (8.6+), start in "Coming soon" mode with no tax, shipping
 * or payment method configured — none of which is usable out of the box for a
 * dev/demo store. This realigns everything to a working Italian default.
 *
 * Two kinds of change here, re-run differently:
 * - Simple option flips (locale, coming-soon, guest checkout, gateway enable) are
 *   plain `update_option()` calls with no WooCommerce class dependency, so they
 *   re-apply unconditionally on every pass, exactly like the old inline
 *   `wp option update` block this file replaced.
 * - Structural creation (the IT tax class + rates, the "Italia" shipping zone)
 *   only runs once, tracked by the `ground_woo_defaults_seeded` option (same
 *   pattern as `ground_seed_done` in seed.php) — so deleting/editing the zone or
 *   tax rates by hand in wp-admin sticks instead of being silently recreated on
 *   the next `docker:up`. Delete the `ground_woo_defaults_seeded` option to force
 *   it to run again.
 *
 * To change these defaults for a specific project, edit this file directly (same
 * approach as provision.sh itself — see AGENTS.md).
 */

// Single source of truth for the country these defaults target — referenced by
// the default-country option, the tax rates, and the shipping zone location.
$store_country = 'IT';

echo "  woo: locale (EUR / IT / kg / cm)\n";

update_option( 'woocommerce_currency', 'EUR' );
update_option( 'woocommerce_currency_pos', 'right_space' );
update_option( 'woocommerce_price_thousand_sep', '.' );
update_option( 'woocommerce_price_decimal_sep', ',' );
update_option( 'woocommerce_price_num_decimals', 2 );
update_option( 'woocommerce_weight_unit', 'kg' );
update_option( 'woocommerce_dimension_unit', 'cm' );
update_option( 'woocommerce_default_country', $store_country );

echo "  woo: store address (shipping/tax origin)\n";

update_option( 'woocommerce_store_address', 'Via Roma 1' );
update_option( 'woocommerce_store_city', 'Roma' );
update_option( 'woocommerce_store_postcode', '00100' );

echo "  woo: disabling Coming soon mode + usage tracking\n";

// Without this the storefront is hidden behind a placeholder page — see the
// file docblock.
update_option( 'woocommerce_coming_soon', 'no' );
// Don't send dev-environment usage data to Automattic.
update_option( 'woocommerce_allow_tracking', 'no' );

echo "  woo: guest checkout enabled, account creation optional\n";

update_option( 'woocommerce_enable_guest_checkout', 'yes' );
update_option( 'woocommerce_enable_signup_and_login_from_checkout', 'yes' );
update_option( 'woocommerce_enable_myaccount_registration', 'no' );

echo "  woo: enabling BACS + COD payment gateways\n";

// Zero-config gateways (no external credentials needed) so a demo order can be
// placed end-to-end; other gateways (Stripe, PayPal…) need real credentials
// per project and are left untouched.
foreach ( array( 'bacs', 'cod' ) as $gateway_id ) {
	$settings            = get_option( "woocommerce_{$gateway_id}_settings", array() );
	$settings['enabled'] = 'yes';
	update_option( "woocommerce_{$gateway_id}_settings", $settings );
}

update_option( 'woocommerce_calc_taxes', 'yes' );
update_option( 'woocommerce_prices_include_tax', 'no' );

// --- Structural creation below: tax class/rates + shipping zone. Runs once,
// tracked via 'ground_woo_defaults_seeded' — see the file docblock. ---
if ( 'yes' === get_option( 'ground_woo_defaults_seeded' ) ) {
	echo "  woo: tax rates + shipping zone already seeded: skipping (delete option 'ground_woo_defaults_seeded' to re-run)\n";
	echo "  woo: defaults applied\n";
	return;
}

echo "  woo: seeding Italian VAT rates\n";

if ( class_exists( 'WC_Tax' ) ) {
	global $wpdb;

	// "Reduced rate" and "Zero rate" ship as WooCommerce's default additional tax
	// classes (stored in the wc_tax_rate_classes table, not an option); add a
	// third one for Italy's 4% super-reduced rate ("aliquote IVA").
	if ( ! in_array( 'aliquota-4', WC_Tax::get_tax_class_slugs(), true ) ) {
		WC_Tax::create_tax_class( 'Aliquota 4%', 'aliquota-4' );
	}

	$it_rates = array(
		array( 'class' => '', 'name' => 'IVA', 'rate' => '22.0000' ),               // Standard rate.
		array( 'class' => 'reduced-rate', 'name' => 'IVA ridotta', 'rate' => '10.0000' ),
		array( 'class' => 'zero-rate', 'name' => 'IVA esente', 'rate' => '0.0000' ),
		array( 'class' => 'aliquota-4', 'name' => 'IVA super ridotta', 'rate' => '4.0000' ),
	);

	foreach ( $it_rates as $it_rate ) {
		// Scoped to this class AND this country: a class-only check (as
		// WC_Tax::get_rates_for_tax_class() would give) would also match a
		// leftover foreign rate from an imported dump and skip seeding the
		// Italian one. A direct, targeted query also avoids that method's
		// unconditional full-table scan of the tax rate locations table.
		$already_seeded = (int) $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*) FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_class = %s AND tax_rate_country = %s",
				$it_rate['class'],
				$store_country
			)
		);

		if ( $already_seeded ) {
			continue;
		}

		WC_Tax::_insert_tax_rate( array(
			'tax_rate_country'  => $store_country,
			'tax_rate_state'    => '',
			'tax_rate'          => $it_rate['rate'],
			'tax_rate_name'     => $it_rate['name'],
			'tax_rate_priority' => 1,
			'tax_rate_order'    => 0,
			'tax_rate_class'    => $it_rate['class'],
		) );
	}
}

echo "  woo: \"Italia\" shipping zone (flat rate + free over €50)\n";

if ( class_exists( 'WC_Shipping_Zones' ) ) {
	// Matched by covered location, not by the zone's (freely editable, e.g. in
	// wp-admin or under WPML) display name — a renamed zone would otherwise no
	// longer match and get recreated as a duplicate.
	$zone_exists = false;
	foreach ( WC_Shipping_Zones::get_zones() as $zone_data ) {
		foreach ( $zone_data['zone_locations'] as $location ) {
			if ( 'country' === $location->type && $store_country === $location->code ) {
				$zone_exists = true;
				break 2;
			}
		}
	}

	if ( ! $zone_exists ) {
		$zone = new WC_Shipping_Zone();
		$zone->set_zone_name( 'Italia' );
		$zone->set_zone_order( 0 );
		$zone->add_location( $store_country, 'country' );
		$zone->save();

		$flat_rate_id = $zone->add_shipping_method( 'flat_rate' );
		update_option( "woocommerce_flat_rate_{$flat_rate_id}_settings", array(
			'title'      => 'Spedizione standard',
			'tax_status' => 'taxable',
			'cost'       => '5',
		) );

		$free_shipping_id = $zone->add_shipping_method( 'free_shipping' );
		update_option( "woocommerce_free_shipping_{$free_shipping_id}_settings", array(
			'title'      => 'Spedizione gratuita',
			'requires'   => 'min_amount',
			'min_amount' => '50',
		) );
	}
}

update_option( 'ground_woo_defaults_seeded', 'yes' );

echo "  woo: defaults applied\n";
