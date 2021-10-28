<?php

/**
 * ACF Constants
 *
 * @package Ground
 */

function ground_costants() {

	// Colors.
	define( 'GROUND_COLOR_PRIMARY', get_theme_mod( 'color_primary' ) ? get_theme_mod( 'color_primary' ) : '#6366F1' );
	define( 'GROUND_COLOR_SECONDARY', get_theme_mod( 'color_secondary' ) ? get_theme_mod( 'color_secondary' ) : '#14B8A6' );
	define( 'GROUND_COLOR_TYPO_PRIMARY', get_theme_mod( 'color_typo_primary' ) ? get_theme_mod( 'color_typo_primary' ) : '#000000' );
	define( 'GROUND_COLOR_TYPO_SECONDARY', get_theme_mod( 'color_typo_secondary' ) ? get_theme_mod( 'color_typo_secondary' ) : '#71717A' );
	define( 'GROUND_COLOR_BODY_PRIMARY', get_theme_mod( 'color_body_primary' ) ? get_theme_mod( 'color_body_primary' ) : '#ffffff' );
	define( 'GROUND_COLOR_BODY_SECONDARY', get_theme_mod( 'color_body_secondary' ) ? get_theme_mod( 'color_body_secondary' ) : '#F4F4F5' );
	define( 'GROUND_COLOR_LINE_PRIMARY', get_theme_mod( 'color_line_primary' ) ? get_theme_mod( 'color_line_primary' ) : '#D4D4D8' );
	define( 'GROUND_COLOR_LINE_SECONDARY', get_theme_mod( 'color_line_secondary' ) ? get_theme_mod( 'color_line_secondary' ) : '#D4D4D8' );

	// Fonts.
	define( 'GROUND_FONT_SOURCE_PRIMARY', get_theme_mod( 'font_source_primary' ) ? get_theme_mod( 'font_source_primary' ) : '' );
	define( 'GROUND_FONT_FAMILY_PRIMARY', get_theme_mod( 'font_family_primary' ) ? get_theme_mod( 'font_family_primary' ) : '' );
	define( 'GROUND_FONT_SOURCE_SECONDARY', get_theme_mod( 'font_source_secondary' ) ? get_theme_mod( 'font_source_secondary' ) : '' );
	define( 'GROUND_FONT_FAMILY_SECONDARY', get_theme_mod( 'font_family_secondary' ) ? get_theme_mod( 'font_family_secondary' ) : '' );

	// Styles.
	define( 'GROUND_ROUNDED_THEME', get_theme_mod( 'rounded_theme' ) ? get_theme_mod( 'rounded_theme' ) : '0' );

	// Company.
	define( 'GROUND_COMPANY_NAME', get_theme_mod( 'company_name' ) ? get_theme_mod( 'company_name' ) : '' );
	define( 'GROUND_COMPANY_ZIP_CODE', get_theme_mod( 'company_zip_code' ) ? get_theme_mod( 'company_zip_code' ) : '' );
	define( 'GROUND_COMPANY_VAT', get_theme_mod( 'company_vat' ) ? get_theme_mod( 'company_vat' ) : '' );
	define( 'GROUND_COMPANY_FISCAL_CODE', get_theme_mod( 'company_fiscal_code' ) ? get_theme_mod( 'company_fiscal_code' ) : '' );

	define( 'GROUND_COMPANY_ADDRESS', get_theme_mod( 'company_address' ) ? get_theme_mod( 'company_address' ) : '' );
	define( 'GROUND_COMPANY_CITY', get_theme_mod( 'company_city' ) ? get_theme_mod( 'company_city' ) : '' );
	define( 'GROUND_COMPANY_PROVINCE', get_theme_mod( 'company_province' ) ? get_theme_mod( 'company_province' ) : '' );
	define( 'GROUND_COMPANY_COUNTRY', get_theme_mod( 'company_country' ) ? get_theme_mod( 'company_country' ) : '' );
	define( 'GROUND_COMPANY_ADDRESS_URL', get_theme_mod( 'company_address_url' ) ? get_theme_mod( 'company_address_url' ) : '' );
	define( 'GROUND_COMPANY_ADDRESS_LATITUDE', get_theme_mod( 'company_address_latitude' ) ? get_theme_mod( 'company_address_latitude' ) : '' );
	define( 'GROUND_COMPANY_ADDRESS_LONGITUDE', get_theme_mod( 'company_address_longitude' ) ? get_theme_mod( 'company_address_longitude' ) : '' );

	define( 'GROUND_COMPANY_PHONE', get_theme_mod( 'company_phone' ) ? get_theme_mod( 'company_phone' ) : '' );
	define( 'GROUND_COMPANY_WHATSAPP', get_theme_mod( 'company_whatsapp' ) ? get_theme_mod( 'company_whatsapp' ) : '' );
	define( 'GROUND_COMPANY_FAX', get_theme_mod( 'company_fax' ) ? get_theme_mod( 'company_fax' ) : '' );

	define( 'GROUND_COMPANY_EMAIL', get_theme_mod( 'company_email' ) ? get_theme_mod( 'company_email' ) : '' );
	define( 'GROUND_COMPANY_PEC', get_theme_mod( 'company_pec' ) ? get_theme_mod( 'company_pec' ) : '' );

	define( 'GROUND_COMPANY_OPENING_HOURS', get_theme_mod( 'company_opening_hours' ) ? get_theme_mod( 'company_opening_hours' ) : '' );
	define( 'GROUND_COMPANY_CLOSING_TIME', get_theme_mod( 'company_closing_time' ) ? get_theme_mod( 'company_closing_time' ) : '' );

	// Socials.
	define( 'GROUND_SOCIAL_LINKEDIN_URL', get_theme_mod( 'social_linkedin_url' ) ? get_theme_mod( 'social_linkedin_url' ) : '' );
	define( 'GROUND_SOCIAL_FACEBOOK_URL', get_theme_mod( 'social_facebook_url' ) ? get_theme_mod( 'social_facebook_url' ) : '' );
	define( 'GROUND_SOCIAL_TWITTER_URL', get_theme_mod( 'social_twitter_url' ) ? get_theme_mod( 'social_twitter_url' ) : '' );
	define( 'GROUND_SOCIAL_INSTAGRAM_URL', get_theme_mod( 'social_instagram_url' ) ? get_theme_mod( 'social_instagram_url' ) : '' );
	define( 'GROUND_SOCIAL_YOUTUBE_URL', get_theme_mod( 'social_youtube_url' ) ? get_theme_mod( 'social_youtube_url' ) : '' );

	// Header.
	define( 'GROUND_HEADER_ADVICE', get_theme_mod( 'header_advice' ) ? get_theme_mod( 'header_advice' ) : '' );
	define( 'GROUND_HEADER_TYPE', get_theme_mod( 'header_type' ) ? get_theme_mod( 'header_type' ) : '' );

	// Logos.
	define( 'GROUND_LOGO_URL_PRIMARY', get_theme_mod( 'logo_url_primary' ) ? get_theme_mod( 'logo_url_primary' ) : '' );
	define( 'GROUND_LOGO_SOURCE_PRIMARY', get_theme_mod( 'logo_source_primary' ) ? get_theme_mod( 'logo_source_primary' ) : '' );

	// No image.
	define( 'GROUND_NO_IMAGE_URL', get_theme_mod( 'no_image_url' ) ? get_theme_mod( 'no_image_url' ) : GROUND_TEMPLATE_URL . '/img/no-image.svg' );

	// Shop.
	define( 'GROUND_SHOP_REMOVE_ADD_TO_CART', get_theme_mod( 'shop_remove_add_to_cart' ) ? get_theme_mod( 'shop_remove_add_to_cart' ) : '' );
	define( 'GROUND_SHOP_PAYMENT', get_field( 'shop_payment', 'option' ) ? get_field( 'shop_payment', 'option' ) : '' );
	define( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_BUTTON', get_theme_mod( 'shop_not_purchasable_product_button' ) ? get_theme_mod( 'shop_not_purchasable_product_button' ) : __( 'Call to order', 'ground' ) );
	define( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_TEXT', get_theme_mod( 'shop_not_purchasable_product_text' ) ? get_theme_mod( 'shop_not_purchasable_product_text' ) : __( 'Call to order', 'ground' ) );
	define( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA_LINK', get_theme_mod( 'shop_not_purchasable_product_cta_link' ) ? get_theme_mod( 'shop_not_purchasable_product_cta_link' ) : '' );
	define( 'GROUND_SHOP_NOT_PURCHASABLE_PRODUCT_CTA_LABEL', get_theme_mod( 'shop_not_purchasable_product_cta_label' ) ? get_theme_mod( 'shop_not_purchasable_product_cta_label' ) : '' );
	define( 'GROUND_SHOP_PRODUCTS_COLUMNS_MOBILE', get_theme_mod( 'shop_products_columns_mobile' ) ? get_theme_mod( 'shop_products_columns_mobile' ) : 'default' );
	define( 'GROUND_SHOP_PRODUCT_SUMMARY_PAGE_1', get_theme_mod( 'shop_product_summary_page_1' ) ? get_theme_mod( 'shop_product_summary_page_1' ) : '' );
	define( 'GROUND_SHOP_PRODUCT_SUMMARY_PAGE_2', get_theme_mod( 'shop_product_summary_page_2' ) ? get_theme_mod( 'shop_product_summary_page_2' ) : '' );
	define( 'GROUND_SHOP_PRODUCT_SUMMARY_PAGE_3', get_theme_mod( 'shop_product_summary_page_3' ) ? get_theme_mod( 'shop_product_summary_page_3' ) : '' );

}

add_action( 'wp_head', 'ground_costants' );

