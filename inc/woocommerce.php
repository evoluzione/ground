<?php

// Forza la checkbox "Ship to a different address" a essere obbligatoria
add_filter( 'woocommerce_cart_needs_shipping_address', '__return_true', 50 );

// Per rinominare il campo "ship_to_different_address" in WooCommerce
function custom_ship_to_different_address_text( $translated_text, $text, $domain ) {
	if ( ! is_admin() && 'woocommerce' === $domain && 'Ship to a different address?' === $text ) {
		$translated_text = __( 'Indirizzo di spedizione', 'ground' );
	}
	return $translated_text;
}
add_filter( 'gettext', 'custom_ship_to_different_address_text', 10, 3 );

// Disabilitare i css di woocommerce
// TODO: Spostare
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

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


// Rimuove l'accordion di login nella pagina di checkout (utilizziamo il nostro)
function remove_login_accordion_from_checkout() {
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
}
add_action( 'wp_loaded', 'remove_login_accordion_from_checkout' );


/**
 * Billing fields
 *
 * @param array $fields Billing fields.
 */
function ground_woocommerce_shipping_fields( $fields ) {

	// Remove fields.
	unset( $fields['shipping_company'] );

	// // Force required.
	//$fields['shipping_phone']['required'] = false;
	//$fields['shipping_email']['required'] = false;

	$fields['shipping_phone'] = array(
		'type' => 'tel',
		'class' => array( 'form__field form__field-vat form__field--shipping' ),
		'label' => __( 'Phone', 'woocommerce' ),
		'placeholder' => '',
		'required' => false,
		'validate' => array( 'phone' ),
		'autocomplete' => 'tel',
		'clear' => true,
		'description' => '<span class="italic text-gray-500 text-sm block">' . __( 'In case the carrier needs to contact you', 'woocommerce' ) . '</span>',
		// 'priority' => 25,
	);


	// Move fields.
	// $fields['shipping_email']['priority'] = 1;
	// $fields['shipping_invoice']['priority'] = 120;
	//$fields['shipping_invoice']['priority'] = 1; // 120
	//$fields['shipping_customer_type']['priority'] = 1;
	// $fields['shipping_company']['priority'] = 140;
	// $fields['shipping_vat']['priority'] = 150;
	// $fields['shipping_fiscal_code']['priority'] = 155;
	// $fields['shipping_pec']['priority'] = 160;
	// $fields['shipping_sdi']['priority'] = 170;

	return $fields;
}

add_filter( 'woocommerce_shipping_fields', 'ground_woocommerce_shipping_fields' );




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

	//unset( $fields['billing_email'] );

	// // Force required.
	$fields['billing_phone']['required'] = false;
	// $fields['billing_email']['required'] = false;

	// New fields.
	// TODO Verificare il nome definitivo
	$fields['billing_invoice'] = array(
		'type' => 'checkbox',
		'label' => __( 'Do you need an invoice?', 'ground' ), // Hai bisogno della fattura?
		'required' => false,
		'priority' => 1,
		'class' => array( 'js-request-invoice' ),
	);

	$fields['billing_customer_type'] = array( // Se viene modificato cambiare anche gli acf users.
		'type' => 'select',
		'required' => true,
		'priority' => 5,
		'class' => array( 'form__field--billing' ),
		'label' => __( 'Client type', 'ground' ),
		'label_class' => 'form__checkout',
		'options' => array(
			'company' => __( 'Company', 'ground' ), // Società
			'public_administation' => __( 'Public administration', 'ground' ), // Pubblica amministrazione
			'private' => __( 'Private', 'ground' ), // Cliente privato
		),
	);

	$fields['billing_vat'] = array(
		'type' => 'text',
		'class' => array( 'form__field form__field-vat form__field--billing' ),
		'label' => __( 'VAT Number', 'ground' ), // Partita IVA
		'placeholder' => '',
		'required' => false,
		'clear' => true,
	);

	$fields['billing_fiscal_code'] = array(
		'type' => 'text',
		'class' => array( 'form__field form__field-vat form__field--billing' ),
		'label' => __( 'Fiscal code', 'ground' ), // Codice fiscale
		'placeholder' => '',
		'required' => false,
		'clear' => true,
	);

	$fields['billing_pec'] = array(
		'type' => 'text',
		'class' => array( 'form__field form__field-pec form__field--billing' ),
		'label' => __( 'PEC', 'ground' ),
		'placeholder' => '',
		'required' => false,
		'clear' => true,
	);

	$fields['billing_sdi'] = array(
		'type' => 'text',
		'class' => array( 'form__field form__field-receiver form__field--billing' ),
		'label' => __( 'Recipient Code (SDI)', 'ground' ), // Codice destinatario (SDI)
		'placeholder' => '',
		'required' => false,
		'clear' => true,
	);

	// Move fields.
	// $fields['billing_email']['priority'] = 1;
	// $fields['billing_invoice']['priority'] = 120;
	//$fields['billing_invoice']['priority'] = 1; // 120
	//$fields['billing_customer_type']['priority'] = 1;
	// $fields['billing_company']['priority'] = 140;
	// $fields['billing_vat']['priority'] = 150;
	// $fields['billing_fiscal_code']['priority'] = 155;
	// $fields['billing_pec']['priority'] = 160;
	// $fields['billing_sdi']['priority'] = 170;

	return $fields;
}

add_filter( 'woocommerce_billing_fields', 'ground_woocommerce_billing_fields', 100, 1 );


function ground_checkout_js() {
	if ( is_checkout() ) {
		?>
		<script type="text/javascript">
			jQuery(function ($) {

				var sync = null;
				var debug = false;

				// Sposta check
				var $requestInvoice = $('.js-request-invoice');
				$requestInvoice.insertAfter('.woocommerce-billing-fields h3');

				// Sposta email
				var $billingMail = $('#billing_email_field');
				$billingMail.insertAfter('.js-account-fields h3');

				if ($requestInvoice.find('input').is(':checked')) {
					sync = false;
					$('body').addClass('is-billing-request');
				} else {
					sync = true;
					$('body').removeClass('is-billing-request');
					if (!debug) {
						$('.woocommerce-billing-fields__field-wrapper').slideUp();
					}
					overrideBillingFields();
				}

				console.log('primo sync: ' + sync);

				function handleRequestInvoice() {
					if ($requestInvoice.find('input').is(':checked')) {
						sync = false;
						$('body').addClass('is-billing-request');
						cleanBillingFields();
						if (!debug) {
							$('.woocommerce-billing-fields__field-wrapper').slideDown();
						}
					} else {
						// Risincronizza i campi
						sync = true;
						$('body').removeClass('is-billing-request');
						overrideBillingFields();
						if (!debug) {
							$('.woocommerce-billing-fields__field-wrapper').slideUp();
						}
					}
				}

				// Svuota tutti i campi
				function cleanBillingFields() {
					$('[name^="billing_"]').each(function () {
						var $element = $(this);
						var elementName = $element.attr('name');
						console.log(elementName);
						if (elementName !== 'billing_invoice' && elementName !== 'billing_email' && elementName !== 'billing_country') {
							var elementType = $element.attr('type');
							if (elementType === 'checkbox' || elementType === 'radio') {
								$element.prop('checked', false);
							} else {
								$element.val('');
							}

							if (elementName == 'billing_customer_type') {
								$element.val('company');
							}

							$element.trigger('change');
						}
					});
				}

				// Sincronizza il campo shippping con il campo billing
				function syncShippingToBillingField(element) {

					if (!sync) return;

					var elementName = element.attr('name');
					var elementType = element.attr('type');
					var elementValue = element.val();

					if (elementType === 'checkbox') {
						elementValue = element.is(':checked');
					}

					if (elementName && elementName.includes('shipping_')) {
						var billingElementName = elementName.replace('shipping_', 'billing_');
						var $billingElement = $('[name="' + billingElementName + '"]');

						if ($billingElement.length) {
							if ($billingElement.attr('type') === 'checkbox') {
								$billingElement.prop('checked', elementValue);
							} else {
								$billingElement.val(elementValue).trigger('change');
							}
						}
					}
				}

				// Sincronizza tutti i campi dello shipping nel billing
				function overrideBillingFields() {
					$('.woocommerce-checkout :input').each(function () {
						syncShippingToBillingField($(this));
					});
				}




				function validateBillingFieldsOld($this) {

					console.log("validate", $this);

					var billingFields = $('.woocommerce-billing-fields');
					var billingFieldsLabels = $('.woocommerce-billing-fields label');

					billingFieldsLabels.each(function () {
						$(this).find('abbr.required').remove();
						$(this).find('span.optional').remove();
						$(this).closest('.form-row').removeClass('woocommerce-invalid woocommerce-invalid-required-field');
					})

					$('#billing_address_1').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
					$('#billing_customer_type').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
					$('#billing_city').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
					$('#billing_postcode').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
					$('#billing_country').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
					$('#billing_state').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');

					if ($this.attr('id') == 'billing_customer_type') {

						if ($this.val() == 'company') {
							$('#billing_company').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
							$('#billing_pec').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
							$('#billing_sdi').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
							$('#billing_vat').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
						}

						if ($this.val() == 'public_administation') {
							$('#billing_pec').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
							$('#billing_sdi').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
							$('#billing_vat').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
						}

						if ($this.val() == 'private') {
							$('#billing_first_name').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
							$('#billing_last_name').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
							$('#billing_fiscal_code').closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
						}

					}

					// <span class="optional">(opzionale)</span>
					// <abbr class="required" title="obbligatorio">*</abbr>

					// Obbligatorio non compilato
					// validate-required form-row-wide woocommerce-invalid woocommerce-invalid-required-field

					// Obbligatori compilato
					// validate-required form-row-wide woocommerce-validated

					// Non obbligatorio non compilato
					// woocommerce-validated

					// Non obbligatorio compilato
					// woocommerce-validated



				}

				function validateBillingFields($this) {
					console.log("validate", $this);

					var billingFields = $('.woocommerce-billing-fields');
					var billingFieldsLabels = $('.woocommerce-billing-fields label');

					// Rimuovi i marcatori di obbligatorietà e opzionalità esistenti
					billingFieldsLabels.each(function () {
						$(this).find('abbr.required').remove();
						$(this).find('span.optional').remove();
						$(this).closest('.form-row').removeClass('woocommerce-invalid woocommerce-invalid-required-field');
					});

					// Campi obbligatori standard
					var requiredFields = [
						'#billing_address_1',
						'#billing_customer_type',
						'#billing_city',
						'#billing_postcode',
						'#billing_country',
						'#billing_state'
					];

					requiredFields.forEach(function (selector) {
						$(selector).closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
					});

					if ($this.attr('id') == 'billing_customer_type') {
						var customerType = $this.val();

						// Campi obbligatori per tipi specifici di clienti
						var customerTypeRequiredFields = {
							'company': ['#billing_company', '#billing_pec', '#billing_sdi', '#billing_vat'],
							'public_administation': ['#billing_pec', '#billing_sdi', '#billing_vat'],
							'private': ['#billing_first_name', '#billing_last_name', '#billing_fiscal_code']
						};

						if (customerTypeRequiredFields[customerType]) {
							customerTypeRequiredFields[customerType].forEach(function (selector) {
								$(selector).closest('.form-row').find('label').append('<abbr class="required" title="obbligatorio">*</abbr>');
							});
						}
					}

					// Aggiungi l'indicazione di opzionalità ai campi che non sono obbligatori
					billingFields.find('.form-row').each(function () {
						if (!$(this).find('label abbr.required').length) {
							$(this).find('label').append('<span class="optional">(opzionale)</span>');
						}
					});
				}


				$('.woocommerce-checkout').on('change', ':input', function () {

					var $this = $(this);


					validateBillingFields($this);

					if ($this.attr('id') == 'billing_invoice') {
						handleRequestInvoice();
					} else {
						syncShippingToBillingField($this);
					}
				});

			});
		</script>
		<?php
	}
}

add_action( 'wp_footer', 'ground_checkout_js' );


// Toglie tutti i required dei billing di default tranne la mail
function customize_billing_fields( $fields ) {
	foreach ( $fields as $key => $field ) {
		if ( $key !== 'billing_email' ) {
			$fields[ $key ]['required'] = false;
		}
	}
	return $fields;
}
add_filter( 'woocommerce_billing_fields', 'customize_billing_fields', 9999, 1 );



function ground_validate_checkout_fields() {

	// Valida Mail
	if ( empty( $_POST['billing_email'] ) ) {
		wc_add_notice( sprintf( __( '%s is a required field.', 'woocommerce' ), __( 'email', 'woocommerce' ) ), 'error' );
	}

	// Valida i campi di fatturazione
	if ( ! empty( $_POST['billing_invoice'] ) ) {

		$required_fields_common = array(
			'billing_address_1' => __( 'Address', 'woocommerce' ),
			'billing_customer_type' => __( 'Customer type', 'woocommerce' ),
			'billing_city' => __( 'City', 'woocommerce' ),
			'billing_postcode' => __( 'Postcode', 'woocommerce' ),
			'billing_country' => __( 'Country', 'woocommerce' ),
			'billing_state' => __( 'State', 'woocommerce' ),
		);

		if ( ! empty( $_POST['billing_customer_type'] ) ) {

			switch ( $_POST['billing_customer_type'] ) {
				case 'company':
					$required_fields = array(
						'billing_company' => __( 'Company', 'woocommerce' ),
						'billing_pec' => __( 'PEC', 'woocommerce' ),
						'billing_sdi' => __( 'Recipient Code (SDI)', 'woocommerce' ),
						'billing_vat' => __( 'VAT', 'woocommerce' ),
					);
					break;

				case 'public_administation':
					$required_fields = array(
						'billing_pec' => __( 'PEC', 'woocommerce' ),
						'billing_sdi' => __( 'Recipient Code (SDI)', 'woocommerce' ),
						'billing_vat' => __( 'VAT', 'woocommerce' ),
					);
					break;

				case 'private':
					$required_fields = array(
						'billing_first_name' => __( 'First name', 'woocommerce' ),
						'billing_last_name' => __( 'Last name', 'woocommerce' ),
						'billing_fiscal_code' => __( 'Fiscal code', 'woocommerce' ),
					);
					break;

				default:
					$required_fields = array();
					break;
			}


			$required_fields = array_merge( $required_fields_common, $required_fields );

			foreach ( $required_fields as $field_key => $field_name ) {
				if ( empty( $_POST[ $field_key ] ) ) {
					wc_add_notice( sprintf( __( 'Billing %s is a required field.', 'woocommerce' ), $field_name ), 'error' );
				}
			}

		}

	}

}

add_action( 'woocommerce_checkout_process', 'ground_validate_checkout_fields' );



function theme_wc_setup() {
	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
	add_action( 'woocommerce_checkout_payments', 'woocommerce_checkout_payment', 20 );

}
add_action( 'after_setup_theme', 'theme_wc_setup' );







function ground_woocommerce_payment_title() {
	echo "<h3>Pagamento</h3>";
}

add_action( 'woocommerce_checkout_payments', 'ground_woocommerce_payment_title', 20 );


























// add_action( 'woocommerce_after_checkout_validation', 'woocommerce_after_checkout_validation_alter', 10, 2 );

// function woocommerce_after_checkout_validation_alter( $data, $errors ) {
// 	// Controlla se il campo 'billing_first_name' è vuoto
// 	if ( empty( $data['billing_first_name'] ) ) {
// 		// Rimuove l'errore predefinito per il campo 'billing_first_name'
// 		$errors->remove( 'billing_first_name' );
// 		// Aggiunge un messaggio di errore personalizzato
// 		wc_add_notice( __( 'Custom error message for billing first name validation.', 'woocommerce' ), 'error' );
// 	} else {
// 		// Aggiunge un altro messaggio di errore personalizzato se non ci sono errori nel campo 'billing_first_name'
// 		wc_add_notice( __( 'Another custom error message for VAT validation.', 'woocommerce' ), 'error' );
// 	}
// }


//add_action( 'woocommerce_after_checkout_validation', 'woocommerce_after_checkout_validation_alter', 10, 2 );

function woocommerce_after_checkout_validation_alter( $data, $errors ) {
	// Verifica se ci sono errori specifici per il campo 'billing_first_name'
	if ( $errors->get_error_codes( 'billing_first_name' ) ) {
		// Rimuove tutti gli errori associati a 'billing_first_name'
		foreach ( $errors->get_error_codes() as $code ) {
			if ( $errors->get_error_data( $code ) === 'billing_first_name' ) {
				$errors->remove( $code );
			}
		}
		// Aggiunge un messaggio di errore personalizzato
		wc_add_notice( __( 'Custom error message for billing first name validation.', 'woocommerce' ), 'error' );
	} else {
		// Aggiunge un altro messaggio di errore personalizzato
		wc_add_notice( __( 'Another custom error message for VAT validation.', 'woocommerce' ), 'error' );
	}
}


// add_action( 'woocommerce_after_checkout_validation', 'woocommerce_after_checkout_validation_alter', 10, 2 );

// function woocommerce_after_checkout_validation_alter( $data, $errors ) {

// 	//if ( 'cod' !== $data['payment_method'] ) {
// 	if ( $errors->get_error_data( 'billing_first_name' ) ) { // This will contain the error
// 		$errors->remove( 'billing_first_name' );
// 		wc_add_notice( __( 'b Custom error message for VAT validation.', 'woocommerce' ), 'error' );
// 	} else {
// 		wc_add_notice( __( 'a Custom error message for VAT validation.', 'woocommerce' ), 'error' );
// 	}
// 	//}
// 	return $data;

// }


// add_filter( 'woocommerce_checkout_fields', 'misha_no_phone_validation' );

// function misha_no_phone_validation( $fields ) {
// 	// Verifica condizione (es. totale carrello maggiore di 100)
// 	if ( WC()->cart->total > 100 ) {
// 		// billing phone
// 		unset( $fields['billing']['billing_phone']['validate'] );
// 		// shipping phone
// 		unset( $fields['shipping']['shipping_phone']['validate'] );

// 		// uncomment the following lines if you would like to make a phone field optional
// 		//unset( $fields[ 'billing' ][ 'billing_phone' ][ 'required' ] );
// 		//unset( $fields[ 'shipping' ][ 'shipping_phone' ][ 'required' ] );
// 	}

// 	return $fields;
// }



/*
add_action( 'woocommerce_after_checkout_validation', 'misha_conditional_phone_validation', 10, 2 );

function misha_conditional_phone_validation( $data, $errors ) {

	// Controlla se altri campi sono compilati (modifica i nomi dei campi in base alle tue necessità)
	if ( isset( $data['billing_invoice'] ) && ! empty( $data['billing_invoice'] ) ) {
		// Se le condizioni sono soddisfatte, rimuovi la validazione del numero di telefono
		wc_add_notice( 'AAAA', 'error' );
	} else {
		add_filter( 'woocommerce_checkout_fields', 'misha_no_validation' );
		wc_add_notice( 'BBBB' . $data['billing_invoice'], 'error' );
	}
}

function misha_no_validation( $fields ) {
	// Rimuovi la validazione del numero di telefono
	unset( $fields['billing']['billing_first_name']['validate'] );
	unset( $fields['billing']['billing_last_name']['validate'] );
	// unset( $fields['shipping']['shipping_phone']['validate'] );

	// Se vuoi rendere il campo opzionale, rimuovi anche 'required'
	// unset( $fields['billing']['billing_phone']['required'] );
	// unset( $fields['shipping']['shipping_phone']['required'] );

	return $fields;
}*/














function prefix_edit_error_message( $fields, $errors ) {
	//$errors->remove( 'shipping' ); // remove default error message
	//$errors->add( 'shipping', 'My custom text' ); // add our custom error message
}
//add_action( 'woocommerce_after_checkout_validation', 'prefix_edit_error_message', 10, 2 );





//add_action( 'woocommerce_checkout_process', 'custom_checkout_process' );

function custom_checkout_process() {
	// Esegui qui la tua logica personalizzata durante il processo di checkout

	// Esempio: Verifica se un campo specifico è stato compilato
	if ( empty( $_POST['billing_phone'] ) ) {
		wc_add_notice( 'Il numero di telefono è obbligatorio.', 'error' );
	}

	// Esempio: Verifica di altri criteri personalizzati durante il checkout

	// Se ci sono errori, wc_add_notice() aggiunge un messaggio di errore che verrà visualizzato all'utente

	// Se non ci sono errori, il processo di checkout continuerà normalmente




	$validation_errors = WC()->checkout()->get_checkout_fields();

	// Recupera gli errori attuali dagli avvisi di WooCommerce
	$notices = wc_get_notices( 'error' );




	// Verifica se ci sono errori già registrati durante il checkout
	// $errors = WC()->session->get( 'woocommerce_checkout_error_messages' );
	/*$notices = WC()->session->get( 'wc_notices', array() );

																																																																																																							   if ( $notices ) {
																																																																																																								   wc_add_notice( 'AAAAA1.' . $notices, 'error' );
																																																																																																							   } else {
																																																																																																								   wc_add_notice( 'BBBBB1.' . $notices, 'error' );
																																																																																																							   }*/


	// Controlla se esiste un errore specifico che vuoi rimuovere
	// if ( isset( $errors['billing_first_name'] ) ) {
	// 	// Rimuovi l'errore specifico
	// 	unset( $errors['billing_first_name'] );

	// 	// Salva nuovamente l'array aggiornato nella sessione di WooCommerce
	// 	WC()->session->set( 'woocommerce_checkout_error_messages', $errors );


	// } else {

	// }


}



// Riordina i messaggi di errore prima shipping poi billing
function custom_checkout_error_order() {
	// Ottenere l'elenco degli errori
	global $woocommerce;

	$error_notice = $woocommerce->session->get( 'woocommerce_errors', array() );

	// Verificare se ci sono errori relativi alla sezione di shipping
	if ( isset( $error_notice['shipping'] ) && ! empty( $error_notice['shipping'] ) ) {
		foreach ( $error_notice['shipping'] as $error ) {
			wc_add_notice( $error, 'error' );
		}
	}

	// Verificare se ci sono errori relativi alla sezione di billing
	if ( isset( $error_notice['billing'] ) && ! empty( $error_notice['billing'] ) ) {
		foreach ( $error_notice['billing'] as $error ) {
			wc_add_notice( $error, 'error' );
		}
	}

	// Rimuovere gli errori originali per evitare duplicati
	$woocommerce->session->set( 'woocommerce_errors', array() );
}

//add_action( 'woocommerce_checkout_process', 'custom_checkout_error_order' );


//add_action( 'woocommerce_checkout_process', 'custom_checkout_error_order2' );

function custom_checkout_error_order2() {
	global $woocommerce;

	// Debug per verificare se la funzione viene chiamata
	error_log( 'Custom checkout error order function called.' );

	// Ottenere gli errori
	$error_notice = $woocommerce->session->get( 'woocommerce_errors', array() );

	// Debug per visualizzare gli errori ottenuti
	error_log( 'Errors retrieved from session:' );
	error_log( print_r( $error_notice, true ) );

	// Riorganizzare gli errori e mostrarli
	if ( isset( $error_notice['shipping'] ) && ! empty( $error_notice['shipping'] ) ) {
		foreach ( $error_notice['shipping'] as $error ) {
			wc_add_notice( $error, 'error' );
		}
	}

	if ( isset( $error_notice['billing'] ) && ! empty( $error_notice['billing'] ) ) {
		foreach ( $error_notice['billing'] as $error ) {
			wc_add_notice( $error, 'error' );
		}
	}

	// Svuotare gli errori dopo averli mostrati
	$woocommerce->session->set( 'woocommerce_errors', array() );

	// Debug per confermare che gli errori siano stati svuotati
	error_log( 'Errors emptied from session.' );
}


/*


add_filter( 'woocommerce_billing_fields', 'custom_override_billing_fields', 100, 1 );

function custom_override_billing_fields( $billing_fields ) {
	$billing_fields['billing_first_name']['required'] = false;
	$billing_fields['billing_last_name']['required'] = false;
	$billing_fields['billing_company']['required'] = false;
	$billing_fields['billing_address_1']['required'] = false;
	$billing_fields['billing_address_2']['required'] = false;
	$billing_fields['billing_city']['required'] = false;
	$billing_fields['billing_postcode']['required'] = false;
	$billing_fields['billing_country']['required'] = false;
	$billing_fields['billing_state']['required'] = false;
	$billing_fields['billing_email']['required'] = false;
	$billing_fields['billing_phone']['required'] = false;
	return $billing_fields;
}



add_filter( 'woocommerce_billing_fields', 'custom_override_billing_state_field', 9999 );

function custom_override_billing_state_field( $fields ) {
	if ( isset( $fields['billing_state'] ) ) {
		$fields['billing_state']['required'] = false;
	}
	return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'custom_override_checkout_billing_state_field', 9999 );

function custom_override_checkout_billing_state_field( $fields ) {
	if ( isset( $fields['billing']['billing_state'] ) ) {
		$fields['billing']['billing_state']['required'] = false;
	}
	return $fields;
}*/






//add_action( 'woocommerce_checkout_process', 'custom_checkout_error_handling' );

function custom_checkout_error_handling() {
	if ( isset( $_POST['billing_invoice'] ) && empty( $_POST['billing_invoice'] ) ) {
		return; // Non fare nulla se billing_invoice non è selezionato
	}

	global $woocommerce;

	// Ottenere l'elenco degli errori
	$error_notice = $woocommerce->session->get( 'woocommerce_errors', array() );

	// Verificare se ci sono errori relativi alla sezione di shipping
	if ( isset( $error_notice['shipping'] ) && ! empty( $error_notice['shipping'] ) ) {
		foreach ( $error_notice['shipping'] as $error ) {
			wc_add_notice( $error, 'error' );
		}
	}

	// Verificare se ci sono errori relativi alla sezione di billing
	if ( isset( $error_notice['billing'] ) && ! empty( $error_notice['billing'] ) ) {
		foreach ( $error_notice['billing'] as $error ) {
			wc_add_notice( $error, 'error' );
		}
	}

	// Rimuovere gli errori originali per evitare duplicati
	$woocommerce->session->set( 'woocommerce_errors', array() );
}




//add_action( 'woocommerce_after_checkout_validation', 'quadlayers', 9999, 2 );
function quadlayers( $fields, $errors ) {
	// in case any validation errors
	if ( ! empty( $errors->get_error_codes() ) ) {

		// omit all existing error messages
		foreach ( $errors->get_error_codes() as $code ) {

			var_dump( $errors->get_error_codes() );

			$errors->remove( $code );
		}
		// display custom single error message
		$errors->add( 'validation', 'Your Custom Message Goes Here!!!' );
	}
}