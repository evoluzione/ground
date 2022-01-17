<?php

/**
 * Hide shipping rates when free shipping is available.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function ground_woocommerce__shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'ground_woocommerce__shipping_when_free_is_available', 100 );
