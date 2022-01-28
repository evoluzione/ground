<?php

/**
 * Constants
 *
 * @package Ground
 */

if ( ! defined( 'GROUND_VERSION' ) ) {
	define( 'GROUND_VERSION', is_child_theme() ? wp_get_theme()->parent()->Version : wp_get_theme()->Version ); // Return the styles.css theme version.
}
if ( ! defined( 'GROUND_SITE_URL' ) ) {
	define( 'GROUND_SITE_URL', site_url() ); // Return http://www.site.com.
}
if ( ! defined( 'GROUND_TEMPLATE_URL' ) ) {
	define( 'GROUND_TEMPLATE_URL', get_template_directory_uri() ); // Return http://www.site.com/wp-content/themes/themename.
}
if ( ! defined( 'GROUND_TEMPLATE_PATH' ) ) {
	define( 'GROUND_TEMPLATE_PATH', get_template_directory() ); // Return /home/user/public_html/wp-content/themes/themename.
}
if ( ! defined( 'GROUND_CHARSET' ) ) {
	define( 'GROUND_CHARSET', get_bloginfo( 'charset' ) ); // The "Encoding for pages and feeds" (set in Settings > Reading).
}

function ground_theme_costants() {
	// Colors.
	if ( ! defined( 'GROUND_COLOR_PRIMARY' ) ) {
		define( 'GROUND_COLOR_PRIMARY', get_theme_mod( 'color_primary' ) ?: '#6366F1' );
	}
	if ( ! defined( 'GROUND_COLOR_SECONDARY' ) ) {
		define( 'GROUND_COLOR_SECONDARY', get_theme_mod( 'color_secondary' ) ?: '#14B8A6' );
	}
	if ( ! defined( 'GROUND_COLOR_TERTIARY' ) ) {
		define( 'GROUND_COLOR_TERTIARY', get_theme_mod( 'color_tertiary' ) ?: '#000000' );
	}
	if ( ! defined( 'GROUND_COLOR_QUATERNARY' ) ) {
		define( 'GROUND_COLOR_QUATERNARY', get_theme_mod( 'color_quaternary' ) ?: '#71717A' );
	}
	if ( ! defined( 'GROUND_COLOR_QUINARY' ) ) {
		define( 'GROUND_COLOR_QUINARY', get_theme_mod( 'color_quinary' ) ?: '#ffffff' );
	}
	if ( ! defined( 'GROUND_COLOR_SENARY' ) ) {
		define( 'GROUND_COLOR_SENARY', get_theme_mod( 'color_senary' ) ?: '#F4F4F5' );
	}
	if ( ! defined( 'GROUND_COLOR_SEPTENARY' ) ) {
		define( 'GROUND_COLOR_SEPTENARY', get_theme_mod( 'color_septenary' ) ?: '#D4D4D8' );
	}
	if ( ! defined( 'GROUND_COLOR_OCTONARY' ) ) {
		define( 'GROUND_COLOR_OCTONARY', get_theme_mod( 'color_octonary' ) ?: '#D4D4D8' );
	}

	// Fonts.
	if ( ! defined( 'GROUND_FONT_SOURCE_PRIMARY' ) ) {
		define( 'GROUND_FONT_SOURCE_PRIMARY', get_theme_mod( 'font_source_primary' ) ? get_theme_mod( 'font_source_primary' ) : '' );
	}
	if ( ! defined( 'GROUND_FONT_FAMILY_PRIMARY' ) ) {
		define( 'GROUND_FONT_FAMILY_PRIMARY', get_theme_mod( 'font_family_primary' ) ? get_theme_mod( 'font_family_primary' ) : '' );
	}
	if ( ! defined( 'GROUND_FONT_SOURCE_SECONDARY' ) ) {
		define( 'GROUND_FONT_SOURCE_SECONDARY', get_theme_mod( 'font_source_secondary' ) ? get_theme_mod( 'font_source_secondary' ) : '' );
	}
	if ( ! defined( 'GROUND_FONT_FAMILY_SECONDARY' ) ) {
		define( 'GROUND_FONT_FAMILY_SECONDARY', get_theme_mod( 'font_family_secondary' ) ? get_theme_mod( 'font_family_secondary' ) : '' );
	}

	// Settings.
	if ( ! defined( 'GROUND_CONTAINER' ) ) {
		define( 'GROUND_CONTAINER', get_theme_mod( 'container' ) ? get_theme_mod( 'container' ) : 'container' );
	}
	if ( ! defined( 'GROUND_ROUNDED_THEME' ) ) {
		define( 'GROUND_ROUNDED_THEME', get_theme_mod( 'rounded_theme' ) ? get_theme_mod( 'rounded_theme' ) : '0' );
	}
	if ( ! defined( 'GROUND_ROUNDED_MEDIA' ) ) {
		define( 'GROUND_ROUNDED_MEDIA', get_theme_mod( 'rounded_media' ) ? get_theme_mod( 'rounded_media' ) : '0' );
	}

	// Company.
	if ( ! defined( 'GROUND_COMPANY_NAME' ) ) {
		define( 'GROUND_COMPANY_NAME', get_theme_mod( 'company_name' ) ? get_theme_mod( 'company_name' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_ZIP_CODE' ) ) {
		define( 'GROUND_COMPANY_ZIP_CODE', get_theme_mod( 'company_zip_code' ) ? get_theme_mod( 'company_zip_code' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_VAT' ) ) {
		define( 'GROUND_COMPANY_VAT', get_theme_mod( 'company_vat' ) ? get_theme_mod( 'company_vat' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_FISCAL_CODE' ) ) {
		define( 'GROUND_COMPANY_FISCAL_CODE', get_theme_mod( 'company_fiscal_code' ) ? get_theme_mod( 'company_fiscal_code' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_ADDRESS' ) ) {
		define( 'GROUND_COMPANY_ADDRESS', get_theme_mod( 'company_address' ) ? get_theme_mod( 'company_address' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_CITY' ) ) {
		define( 'GROUND_COMPANY_CITY', get_theme_mod( 'company_city' ) ? get_theme_mod( 'company_city' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_PROVINCE' ) ) {
		define( 'GROUND_COMPANY_PROVINCE', get_theme_mod( 'company_province' ) ? get_theme_mod( 'company_province' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_COUNTRY' ) ) {
		define( 'GROUND_COMPANY_COUNTRY', get_theme_mod( 'company_country' ) ? get_theme_mod( 'company_country' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_ADDRESS_URL' ) ) {
		define( 'GROUND_COMPANY_ADDRESS_URL', get_theme_mod( 'company_address_url' ) ? get_theme_mod( 'company_address_url' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_ADDRESS_LATITUDE' ) ) {
		define( 'GROUND_COMPANY_ADDRESS_LATITUDE', get_theme_mod( 'company_address_latitude' ) ? get_theme_mod( 'company_address_latitude' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_ADDRESS_LONGITUDE' ) ) {
		define( 'GROUND_COMPANY_ADDRESS_LONGITUDE', get_theme_mod( 'company_address_longitude' ) ? get_theme_mod( 'company_address_longitude' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_PHONE' ) ) {
		define( 'GROUND_COMPANY_PHONE', get_theme_mod( 'company_phone' ) ? get_theme_mod( 'company_phone' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_WHATSAPP' ) ) {
		define( 'GROUND_COMPANY_WHATSAPP', get_theme_mod( 'company_whatsapp' ) ? get_theme_mod( 'company_whatsapp' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_FAX' ) ) {
		define( 'GROUND_COMPANY_FAX', get_theme_mod( 'company_fax' ) ? get_theme_mod( 'company_fax' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_EMAIL' ) ) {
		define( 'GROUND_COMPANY_EMAIL', get_theme_mod( 'company_email' ) ? get_theme_mod( 'company_email' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_PEC' ) ) {
		define( 'GROUND_COMPANY_PEC', get_theme_mod( 'company_pec' ) ? get_theme_mod( 'company_pec' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_OPENING_HOURS' ) ) {
		define( 'GROUND_COMPANY_OPENING_HOURS', get_theme_mod( 'company_opening_hours' ) ? get_theme_mod( 'company_opening_hours' ) : '' );
	}
	if ( ! defined( 'GROUND_COMPANY_CLOSING_TIME' ) ) {
		define( 'GROUND_COMPANY_CLOSING_TIME', get_theme_mod( 'company_closing_time' ) ? get_theme_mod( 'company_closing_time' ) : '' );
	}

	// Socials.
	if ( ! defined( 'GROUND_SOCIAL_LINKEDIN_URL' ) ) {
		define( 'GROUND_SOCIAL_LINKEDIN_URL', get_theme_mod( 'social_linkedin_url' ) ? get_theme_mod( 'social_linkedin_url' ) : '' );
	}
	if ( ! defined( 'GROUND_SOCIAL_FACEBOOK_URL' ) ) {
		define( 'GROUND_SOCIAL_FACEBOOK_URL', get_theme_mod( 'social_facebook_url' ) ? get_theme_mod( 'social_facebook_url' ) : '' );
	}
	if ( ! defined( 'GROUND_SOCIAL_TWITTER_URL' ) ) {
		define( 'GROUND_SOCIAL_TWITTER_URL', get_theme_mod( 'social_twitter_url' ) ? get_theme_mod( 'social_twitter_url' ) : '' );
	}
	if ( ! defined( 'GROUND_SOCIAL_INSTAGRAM_URL' ) ) {
		define( 'GROUND_SOCIAL_INSTAGRAM_URL', get_theme_mod( 'social_instagram_url' ) ? get_theme_mod( 'social_instagram_url' ) : '' );
	}
	if ( ! defined( 'GROUND_SOCIAL_YOUTUBE_URL' ) ) {
		define( 'GROUND_SOCIAL_YOUTUBE_URL', get_theme_mod( 'social_youtube_url' ) ? get_theme_mod( 'social_youtube_url' ) : '' );
	}

	// Header.
	if ( ! defined( 'GROUND_HEADER_ADVICE_PRIMARY' ) ) {
		define( 'GROUND_HEADER_ADVICE_PRIMARY', get_theme_mod( 'header_advice_primary' ) ? get_theme_mod( 'header_advice_primary' ) : '' );
	}
	if ( ! defined( 'GROUND_HEADER_ADVICE_SECONDARY' ) ) {
		define( 'GROUND_HEADER_ADVICE_SECONDARY', get_theme_mod( 'header_advice_secondary' ) ? get_theme_mod( 'header_advice_secondary' ) : '' );
	}
	if ( ! defined( 'GROUND_HEADER_ADVICE_TERTIARY' ) ) {
		define( 'GROUND_HEADER_ADVICE_TERTIARY', get_theme_mod( 'header_advice_tertiary' ) ? get_theme_mod( 'header_advice_tertiary' ) : '' );
	}
	if ( ! defined( 'GROUND_HEADER_TYPE' ) ) {
		define( 'GROUND_HEADER_TYPE', get_theme_mod( 'header_type' ) ? get_theme_mod( 'header_type' ) : '' );
	}

	// Shipping.
	if ( ! defined( 'GROUND_SHIPPING_TITLE' ) ) {
		define( 'GROUND_SHIPPING_TITLE', get_theme_mod( 'shipping_title' ) ? get_theme_mod( 'shipping_title' ) : '' );
	}
	if ( ! defined( 'GROUND_SHIPPING_CONTENT' ) ) {
		define( 'GROUND_SHIPPING_CONTENT', get_theme_mod( 'shipping_content' ) ? get_theme_mod( 'shipping_content' ) : '' );
	}

	// Payments.
	if ( ! defined( 'GROUND_PAYMENTS_TITLE' ) ) {
		define( 'GROUND_PAYMENTS_TITLE', get_theme_mod( 'payments_title' ) ? get_theme_mod( 'payments_title' ) : '' );
	}
	if ( ! defined( 'GROUND_PAYMENTS_CONTENT' ) ) {
		define( 'GROUND_PAYMENTS_CONTENT', get_theme_mod( 'payments_content' ) ? get_theme_mod( 'payments_content' ) : '' );
	}

	// Logos.
	if ( ! defined( 'GROUND_LOGO_SOURCE_PRIMARY' ) ) {
		define( 'GROUND_LOGO_SOURCE_PRIMARY', get_theme_mod( 'logo_source_primary' ) ? get_theme_mod( 'logo_source_primary' ) : '' );
	}

	// No image.
	if ( ! defined( 'GROUND_NO_IMAGE_URL' ) ) {
		define( 'GROUND_NO_IMAGE_URL', get_theme_mod( 'no_image_url' ) ? get_theme_mod( 'no_image_url' ) : GROUND_TEMPLATE_URL . '/img/no-image.svg' );
	}

	// Shop.
	if ( ! defined( 'GROUND_SHOP_REMOVE_ADD_TO_CART' ) ) {
		define( 'GROUND_SHOP_REMOVE_ADD_TO_CART', get_theme_mod( 'shop_remove_add_to_cart' ) ? get_theme_mod( 'shop_remove_add_to_cart' ) : '' );
	}
	if ( ! defined( 'GROUND_SHOP_PAYMENT' ) ) {
		define( 'GROUND_SHOP_PAYMENT', class_exists( 'ACF' ) && get_field( 'shop_payment', 'option' ) ? get_field( 'shop_payment', 'option' ) : '' );
	}
	if ( ! defined( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_BUTTON' ) ) {
		define( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_BUTTON', get_theme_mod( 'shop_not_purchasable_product_button' ) ? get_theme_mod( 'shop_not_purchasable_product_button' ) : __( 'Call to order', 'ground' ) );
	}
	if ( ! defined( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_TEXT' ) ) {
		define( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_TEXT', get_theme_mod( 'shop_not_purchasable_product_text' ) ? get_theme_mod( 'shop_not_purchasable_product_text' ) : __( 'Call to order', 'ground' ) );
	}
	if ( ! defined( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA' ) ) {
		define( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA', get_theme_mod( 'shop_not_purchasable_product_cta' ) ? get_theme_mod( 'shop_not_purchasable_product_cta' ) : '' );
	}
	if ( ! defined( 'GROUND_SHOP_PRODUCTS_COLUMNS_MOBILE' ) ) {
		define( 'GROUND_SHOP_PRODUCTS_COLUMNS_MOBILE', get_theme_mod( 'shop_products_columns_mobile' ) ? get_theme_mod( 'shop_products_columns_mobile' ) : 'default' );
	}
	if ( ! defined( 'GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1' ) ) {
		define( 'GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1', get_theme_mod( 'shop_product_summary_page_1' ) ? get_theme_mod( 'shop_product_summary_page_1' ) : '' );
	}
	if ( ! defined( 'GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2' ) ) {
		define( 'GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2', get_theme_mod( 'shop_product_summary_page_2' ) ? get_theme_mod( 'shop_product_summary_page_2' ) : '' );
	}
	if ( ! defined( 'GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3' ) ) {
		define( 'GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3', get_theme_mod( 'shop_product_summary_page_3' ) ? get_theme_mod( 'shop_product_summary_page_3' ) : '' );
	}
	if ( ! defined( 'GROUND_SHOP_ORDER_COMMENTS_DETAILS' ) ) {
		define( 'GROUND_SHOP_ORDER_COMMENTS_DETAILS', get_theme_mod( 'shop_order_comments_details' ) ? get_theme_mod( 'shop_order_comments_details' ) : '' );
	}

	// Payments.
	if ( ! defined( 'GROUND_PAYMENT_AMEX' ) ) {
		define( 'GROUND_PAYMENT_AMEX', get_theme_mod( 'payment_amex' ) ? get_theme_mod( 'payment_amex' ) : '' );
	}
	if ( ! defined( 'GROUND_PAYMENT_APPLEPAY' ) ) {
		define( 'GROUND_PAYMENT_APPLEPAY', get_theme_mod( 'payment_applepay' ) ? get_theme_mod( 'payment_applepay' ) : '' );
	}
	if ( ! defined( 'GROUND_PAYMENT_GPAY' ) ) {
		define( 'GROUND_PAYMENT_GPAY', get_theme_mod( 'payment_gpay' ) ? get_theme_mod( 'payment_gpay' ) : '' );
	}
	if ( ! defined( 'GROUND_PAYMENT_MASTERCARD' ) ) {
		define( 'GROUND_PAYMENT_MASTERCARD', get_theme_mod( 'payment_mastercard' ) ? get_theme_mod( 'payment_mastercard' ) : '' );
	}
	if ( ! defined( 'GROUND_PAYMENT_MAESTRO' ) ) {
		define( 'GROUND_PAYMENT_MAESTRO', get_theme_mod( 'payment_maestro' ) ? get_theme_mod( 'payment_maestro' ) : '' );
	}
	if ( ! defined( 'GROUND_PAYMENT_PAYPAL' ) ) {
		define( 'GROUND_PAYMENT_PAYPAL', get_theme_mod( 'payment_paypal' ) ? get_theme_mod( 'payment_paypal' ) : '' );
	}
	if ( ! defined( 'GROUND_PAYMENT_SATISPAY' ) ) {
		define( 'GROUND_PAYMENT_SATISPAY', get_theme_mod( 'payment_satispay' ) ? get_theme_mod( 'payment_satispay' ) : '' );
	}
	if ( ! defined( 'GROUND_PAYMENT_SEPA' ) ) {
		define( 'GROUND_PAYMENT_SEPA', get_theme_mod( 'payment_sepa' ) ? get_theme_mod( 'payment_sepa' ) : '' );
	}
	if ( ! defined( 'GROUND_PAYMENT_VISA' ) ) {
		define( 'GROUND_PAYMENT_VISA', get_theme_mod( 'payment_visa' ) ? get_theme_mod( 'payment_visa' ) : '' );
	}

	// Newsletter
	if ( ! defined( 'GROUND_NEWSLETTER_TITLE' ) ) {
		define( 'GROUND_NEWSLETTER_TITLE', get_theme_mod( 'newsletter_title' ) ? get_theme_mod( 'newsletter_title' ) : '' );
	}
	if ( ! defined( 'GROUND_NEWSLETTER_CONTENT' ) ) {
		define( 'GROUND_NEWSLETTER_CONTENT', get_theme_mod( 'newsletter_content' ) ? get_theme_mod( 'newsletter_content' ) : '' );
	}
	if ( ! defined( 'GROUND_NEWSLETTER_SHORTCODE' ) ) {
		define( 'GROUND_NEWSLETTER_SHORTCODE', get_theme_mod( 'newsletter_shortcode' ) ? get_theme_mod( 'newsletter_shortcode' ) : '' );
	}
}

add_action( 'init', 'ground_theme_costants' );
