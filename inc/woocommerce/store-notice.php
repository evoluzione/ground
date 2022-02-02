<?php


function woocommerce_demo_store() {

	if ( ! is_store_notice_showing() ) {
		return;
	}

	$notice = get_option( 'woocommerce_demo_store_notice' );

	echo apply_filters( 'woocommerce_demo_store', '<div class="woocommerce-store-notice demo_store"><div class="woocommerce-store-notice__body">' . wp_kses_post( $notice ) . ' <a href="#" class="woocommerce-store-notice__dismiss-link">' . esc_html__( 'Close', 'woocommerce' ) . '</a></div></div>', $notice );
}
