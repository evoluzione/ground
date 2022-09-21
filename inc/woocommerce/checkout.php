<?php

/**
 * Checkout
 *
 * @package Ground
 */

/**
 * Billing fields
 *
 * @param array $fields Billing fields.
 */
function ground_woocommerce_billing_fields( $fields ) {

	// Remove fields.
	// unset( $fields['billing_address_1'] );
	// unset( $fields['billing_address_2'] );
	// unset( $fields['billing_city'] );
	// unset( $fields['billing_postcode'] );
	// unset( $fields['billing_country'] );
	// unset( $fields['billing_state'] );

	// // Force required.
	// $fields['billing_phone']['required'] = true;

	// New fields.
	$fields['billing_invoice'] = array(
		'type'     => 'checkbox',
		'label'    => __( 'Do you need an invoice?', 'ground' ), // Hai bisogno della fattura?
		'required' => false,
		'clear'    => true,
	);

	$fields['billing_customer_type'] = array( // Se viene modificato cambiare anche gli acf users.
		'type'        => 'select',
		'required'    => true,
		'class'       => array( 'form__field--billing' ),
		'label'       => __( 'Client type', 'ground' ),
		'label_class' => 'form__checkout',
		'options'     => array(
			'azienda'     => __( 'Company', 'ground' ), // Società
			'individuale' => __( 'Professional', 'ground' ), // Ditta individuale/Professionista
			'pubblico'    => __( 'Public administration', 'ground' ), // Pubblica amministrazione
			'privato'     => __( 'Private client', 'ground' ), // Cliente privato
		),
	);

	$fields['billing_vat'] = array(
		'type'        => 'text',
		'class'       => array( 'form__field form__field-vat form__field--billing' ),
		'label'       => __( 'VAT Number', 'ground' ), // Partita IVA
		'placeholder' => '',
		'required'    => false,
		'clear'       => true,
	);

	$fields['billing_fiscal_code'] = array(
		'type'        => 'text',
		'class'       => array( 'form__field form__field-vat form__field--billing' ),
		'label'       => __( 'Fiscal code', 'ground' ), // Codice fiscale
		'placeholder' => '',
		'required'    => false,
		'clear'       => true,
	);

	$fields['billing_pec'] = array(
		'type'        => 'text',
		'class'       => array( 'form__field form__field-pec form__field--billing' ),
		'label'       => __( 'PEC', 'ground' ),
		'placeholder' => '',
		'required'    => false,
		'clear'       => true,
	);

	$fields['billing_sdi'] = array(
		'type'        => 'text',
		'class'       => array( 'form__field form__field-receiver form__field--billing' ),
		'label'       => __( 'Recipient Code (SDI)', 'ground' ), // Codice destinatario (SDI)
		'placeholder' => '',
		'required'    => false,
		'clear'       => true,
	);

	// Move fields.
	$fields['billing_email']['priority']         = 1;
	$fields['billing_invoice']['priority']       = 120;
	$fields['billing_customer_type']['priority'] = 130;
	$fields['billing_company']['priority']       = 140;
	$fields['billing_vat']['priority']           = 150;
	$fields['billing_fiscal_code']['priority']   = 155;
	$fields['billing_pec']['priority']           = 160;
	$fields['billing_sdi']['priority']           = 170;

	return $fields;
}

add_filter( 'woocommerce_billing_fields', 'ground_woocommerce_billing_fields' );


/**
 * Shipping fields
 *
 * @param array $fields Shipping fields.
 */
function ground_woocommerce_shipping_fields( $fields ) {

	// Remove fields.
	unset( $fields['shipping_company'] );
	unset( $fields['shipping_address_2'] );
	// unset($fields['shipping_country']);

	// Move fields.
	$fields['shipping_city']['priority']     = 25;
	$fields['shipping_postcode']['priority'] = 28;
	$fields['shipping_state']['priority']    = 30;

	return $fields;
}

add_filter( 'woocommerce_shipping_fields', 'ground_woocommerce_shipping_fields' );

/**
 * Admin order billing fields
 *
 * @param array $fields Billing fields.
 * @return array
 */
function ground_woocommerce_admin_order_billing_fields( $fields ) {

	global $post;
	$order      = wc_get_order( $post->ID );
	$order_data = $order->get_meta( '_billing_invoice' );

	if ( '1' === $order_data ) {

		// Remove fields.
		unset( $fields['billing_first_name'] );
		unset( $fields['billing_last_name'] );
		unset( $fields['billing_address_1'] );
		unset( $fields['billing_address_2'] );
		unset( $fields['billing_city'] );
		unset( $fields['billing_postcode'] );
		unset( $fields['billing_country'] );
		unset( $fields['billing_state'] );

		$fields['customer_type'] = array(
			'label'   => __( 'Client type', 'ground' ),
			'show'    => true,
			'type'    => 'select',
			'options' => array(
				'azienda'     => __( 'Company', 'ground' ), // Società
				'individuale' => __( 'Professional', 'ground' ), // Ditta individuale/Professionista
				'pubblico'    => __( 'Public administration', 'ground' ), // Pubblica amministrazione
				'privato'     => __( 'Private client', 'ground' ), // Cliente privato
			),
		);

		$fields['vat'] = array(
			'label' => __( 'VAT Number', 'ground' ), // Partita IVA
			'show'  => true,
		);

		$fields['fiscal_code'] = array(
			'label' => __( 'Fiscal code', 'ground' ), // Codice fiscale
			'show'  => true,
		);

		$fields['sdi'] = array(
			'label' => __( 'Recipient Code (SDI)', 'ground' ), // Codice destinatario (SDI)
			'show'  => true,
		);

		$fields['pec'] = array(
			'label' => __( 'PEC', 'ground' ),
			'show'  => true,
		);
	} else {
		$fields = array();
	}

	return $fields;
}

add_filter( 'woocommerce_admin_billing_fields', 'ground_woocommerce_admin_order_billing_fields' );

/**
 * Admin order billing invoice request
 *
 * @param object $order Order.
 * @return void
 */
function ground_woocommerce_admin_order_after_billing_fields( $order ) {

	$invoice = get_post_meta( $order->get_id(), '_billing_invoice', true );

	echo '<h3>' . __( 'Invoice requested?', 'ground' ) . '</h3>'; // Fattura richiesta?

	if ( empty( $invoice ) ) {
		echo '<p>' . __( 'Invoice NOT requested', 'ground' ) . '</p>'; // Non è richiesta fattura
	} else {
		echo '<p>' . __( 'Invoice requested', 'ground' ) . '</p>'; // Il cliente ha richiesto la fattura
	}
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'ground_woocommerce_admin_order_after_billing_fields', 10, 1 );

/**
 * Order received invoice fields (thankyou page)
 *
 * @param string $order_id Order id.
 */
function ground_woocommerce_custom_checkout_field_order_received_order_meta( $order_id ) {

	$order_obj  = wc_get_order( $order_id );
	$is_invoice = get_post_meta( $order_obj->get_order_number(), '_billing_invoice', true );

	echo '<div class="woocommerce-column woocommerce-column--2 woocommerce-column--billing col-2">
		<h2 class="woocommerce-column__title" style="margin-top:18px;"> ' . __( 'Billing data', 'ground' ) . '</h2>'; // Dati Fatturazione

	if ( empty( $is_invoice ) ) {
		echo '<p class="woocommerce-customer-details--no-invoice margin-bottom-0">' . __( 'Invoice NOT requested', 'ground' ) . '</p>'; // Fattura non richiesta
	} else {
		$invoice_customer_type = get_post_meta( $order_obj->get_order_number(), '_billing_customer_type', true );
		$invoice_company       = get_post_meta( $order_obj->get_order_number(), '_billing_company', true );
		$invoice_vat           = get_post_meta( $order_obj->get_order_number(), '_billing_vat', true );
		$invoice_fiscal_code   = get_post_meta( $order_obj->get_order_number(), '_billing_fiscal_code', true );
		$invoice_pec           = get_post_meta( $order_obj->get_order_number(), '_billing_pec', true );
		$invoice_sdi           = get_post_meta( $order_obj->get_order_number(), '_billing_sdi', true );

		if ( $invoice_customer_type ) {
			echo '<p class="woocommerce-customer-details--customer-type margin-bottom-0">' . __( 'Client type', 'ground' ) . ': <strong>' . $invoice_customer_type . '</strong></p>';
		};
		if ( $invoice_company ) {
			echo '<p class="woocommerce-customer-details--company margin-bottom-0">' . __( 'Name of the company', 'ground' ) . ': <strong>' . $invoice_company . '</strong></p>';
		};
		if ( $invoice_vat ) {
			echo '<p class="woocommerce-customer-details--vat margin-bottom-0">' . __( 'VAT Number', 'ground' ) . ': <strong>' . $invoice_vat . '</strong></p>';
		};
		if ( $invoice_fiscal_code ) {
			echo '<p class="woocommerce-customer-details--fiscal-code margin-bottom-0">' . __( 'Fiscal code', 'ground' ) . ': <strong>' . $invoice_fiscal_code . '</strong></p>';
		};
		if ( $invoice_pec ) {
			echo '<p class="woocommerce-customer-details--pec margin-bottom-0">' . __( 'PEC', 'ground' ) . ': <strong>' . $invoice_pec . '</strong></p>';
		};
		if ( $invoice_sdi ) {
			echo '<p class="woocommerce-customer-details--sdi margin-bottom-0">' . __( 'Recipient Code (SDI)', 'ground' ) . ': <strong>' . $invoice_sdi . '</strong></p>';
		};
	}
	echo '</div>';
}

add_action( 'woocommerce_thankyou', 'ground_woocommerce_custom_checkout_field_order_received_order_meta', 10, 2 );



/**
 * Billing title
 */
function ground_woocommerce_checkout_billing_title() { ?>
	<div class="ground-checkout-step"><span class="ground-checkout-step__icon"><?php ground_icon( 'shopping-bag', '' ); ?></span><span class="ground-checkout-step__title"><?php _e( 'Billing details', 'ground' ); ?></span></div>
	<?php
}

add_action( 'woocommerce_before_checkout_billing_form', 'ground_woocommerce_checkout_billing_title' );

/**
 * Shipping title
 */
function ground_woocommerce_checkout_shipping_title() {
	?>
	<div class="ground-checkout-step"><span class="ground-checkout-step__icon"><?php ground_icon( 'pin', '' ); ?></span><span class="ground-checkout-step__title"><?php _e( 'Where do you want to send the purchase?', 'ground' ); ?></span></div>
	<?php
}

add_action( 'woocommerce_before_checkout_shipping_form', 'ground_woocommerce_checkout_shipping_title' );

/**
 * Payments title
 */
function ground_woocommerce_checkout_payments_title() {
	?>
	<div class="ground-checkout-step"><span class="ground-checkout-step__icon"><?php ground_icon( 'credit-card', '' ); ?></span><span class="ground-checkout-step__title"><?php _e( 'Payment method', 'ground' ); ?></span></div>
	<?php
}

add_action( 'woocommerce_review_order_before_payment', 'ground_woocommerce_checkout_payments_title' );


/**
 * Invoice title
 */
function ground_woocommerce_checkout_invoice_title() {
	?>
	<div class="ground-checkout-step" id="invoice_checkout_step"><span class="ground-checkout-step__icon"><?php ground_icon( 'copy', '' ); ?></span><span class="ground-checkout-step__title"><?php _e( 'Do you need an invoice?', 'ground' ); ?></span></div>
	<?php
}

add_action( 'woocommerce_review_order_after_payment', 'ground_woocommerce_checkout_invoice_title' );


/**
 * Order notes
 */
function ground_woocommerce_checkout_order_notes_title() {
	?>
	<div class="ground-checkout-step"><span class="ground-checkout-step__icon"><?php ground_icon( 'pen', '' ); ?></span><span class="ground-checkout-step__title"><?php _e( 'Note', 'ground' ); ?></span></div>
	<?php
}

add_action( 'woocommerce_before_order_notes', 'ground_woocommerce_checkout_order_notes_title' );



/**
 * Replace checkout strings
 *
 * @param string $translation Translated text.
 * @param string $text Text to translate.
 * @param string $domain Text domain. Unique identifier for retrieving translated strings.
 */
function ground_woocommerce_billing_field_strings( $translation, $text, $domain ) {
	switch ( $translation ) {
		case 'Dettagli di fatturazione':
			$translation = __( 'Personal data', 'ground' ); // Dati personali
			break;
		case 'Informazioni aggiuntive':
			$translation = __( 'Do you have anything else to communicate?', 'ground' ); // Hai altro da comunicare?
			break;
	}
	return $translation;
}

add_filter( 'gettext', 'ground_woocommerce_billing_field_strings', 20, 3 );

/**
 * Hide coupon field in checkout
 *
 * @param string $yes_get_option_woocommerce_enable_coupons The yes get option woocommerce enable coupons.
 * @return string
 */
function ground_woocommerce_disable_coupon_field_on_checkout( $yes_get_option_woocommerce_enable_coupons ) {
	if ( is_checkout() ) {
		$yes_get_option_woocommerce_enable_coupons = false;
	}
	return $yes_get_option_woocommerce_enable_coupons;
}

add_filter( 'woocommerce_coupons_enabled', 'ground_woocommerce_disable_coupon_field_on_checkout' );

/**
 * Show product image on checkout
 *
 * @param callback $product_name
 * @param int      $cart_item
 * @param int      $cart_item_key
 */
function ground_product_image_on_checkout( $product_name, $cart_item, $cart_item_key ) {

	if ( ! is_checkout() ) {
		return $product_name;
	}

	$_product  = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	$thumbnail = $_product->get_image();
	$image     = '<div class="product-thumbnail">' . $thumbnail . '</div>';

	return $image . $product_name;
}

add_filter( 'woocommerce_cart_item_name', 'ground_product_image_on_checkout', 10, 3 );





/**
 * Checkout, Add header checkout
 */
function ground_header_checkout() {
	if ( class_exists( 'WooCommerce' ) && is_checkout() ) {
		?>

		<div class="container">
			<div class="flex items-center justify-between py-6 border-b border-septenary">
				<div>
					<?php get_template_part( 'template-parts/shared/logo-primary' ); ?>
				</div>
				<div>
					<div class="lg:text-right">
						<?php ground_icon( 'lock' ); ?> <?php _e( 'Secure order', 'ground' ); ?>
					</div>
				</div>
			</div>
		</div>

		<?php

	}
}

add_action( 'wp_body_open', 'ground_header_checkout', 10 );



/**
 * Checkout, Customize wc errors
 */
function ground_woocommerce_customize_wc_errors( $error ) {

	if ( strpos( $error, 'di fatturazione' ) !== false ) {
		$error = str_replace( 'di fatturazione', '(Dati personali) ', $error );
	}
	if ( strpos( $error, 'di spedizione' ) !== false ) {
		$error = str_replace( 'di spedizione', '(Spedizione) ', $error );
	}
	return $error;
}
add_filter( 'woocommerce_add_error', 'ground_woocommerce_customize_wc_errors' );



/**
 * WooCommerce, checkout order comments add info
 */
function ground_woocommerce_checkout_order_comments_add_details() {

	if ( GROUND_SHOP_ORDER_COMMENTS_DETAILS ) {
		?>

		<div class="relative">
			<span class="text-primary text-sm underline hover:no-underline cursor-pointer js-toggle" data-toggle-target=".ground-order-comments-details" data-toggle-class-name="hidden"><?php ground_icon( 'info' ); ?><?php _e( 'Order notes', 'woocommerce' ); ?></span>
			<div class="ground-order-comments-details rounded-theme bg-senary my-3 p-6 hidden text-xs text-quaternary">
				<?php echo GROUND_SHOP_ORDER_COMMENTS_DETAILS; ?>
			</div>
		</div>

		<?php
	}

}

add_action( 'woocommerce_before_order_notes', 'ground_woocommerce_checkout_order_comments_add_details', 10 );
