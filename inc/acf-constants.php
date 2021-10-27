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
	define( 'GROUND_COMPANY_NAME', get_field( 'company_name', 'option' ) ? get_field( 'company_name', 'option' ) : '' );
	define( 'GROUND_COMPANY_PIVA', get_field( 'company_piva', 'option' ) ? get_field( 'company_piva', 'option' ) : '' );
	define( 'GROUND_COMPANY_CF', get_field( 'company_cf', 'option' ) ? get_field( 'company_cf', 'option' ) : '' );
	define( 'GROUND_COMPANY_CITY', get_field( 'company_city', 'option' ) ? get_field( 'company_city', 'option' ) : '' );
	define( 'GROUND_COMPANY_PROVINCE', get_field( 'company_province', 'option' ) ? get_field( 'company_province', 'option' ) : '' );
	define( 'GROUND_COMPANY_COUNTRY', get_field( 'company_country', 'option' ) ? get_field( 'company_country', 'option' ) : '' );
	define( 'GROUND_COMPANY_CAP', get_field( 'company_cap', 'option' ) ? get_field( 'company_cap', 'option' ) : '' );
	define( 'GROUND_COMPANY_ADDRESS', get_field( 'company_address', 'option' ) ? get_field( 'company_address', 'option' ) : '' );
	define( 'GROUND_COMPANY_ADDRESS_URL', get_field( 'company_address_url', 'option' ) ? get_field( 'company_address_url', 'option' ) : '' );
	define( 'GROUND_COMPANY_ADDRESS_LATITUDE', get_field( 'company_address_latitude', 'option' ) ? get_field( 'company_address_latitude', 'option' ) : '' );
	define( 'GROUND_COMPANY_ADDRESS_LONGITUDE', get_field( 'company_address_longitude', 'option' ) ? get_field( 'company_address_longitude', 'option' ) : '' );
	define( 'GROUND_COMPANY_PHONE', get_field( 'company_phone', 'option' ) ? get_field( 'company_phone', 'option' ) : '' );
	define( 'GROUND_COMPANY_WHATSAPP', get_field( 'company_whatsapp', 'option' ) ? get_field( 'company_whatsapp', 'option' ) : '' );
	define( 'GROUND_COMPANY_FAX', get_field( 'company_fax', 'option' ) ? get_field( 'company_fax', 'option' ) : '' );
	define( 'GROUND_COMPANY_EMAIL', get_field( 'company_email', 'option' ) ? get_field( 'company_email', 'option' ) : '' );
	define( 'GROUND_COMPANY_PEC', get_field( 'company_pec', 'option' ) ? get_field( 'company_pec', 'option' ) : '' );
	define( 'GROUND_COMPANY_OPENING_HOURS', get_field( 'company_opening_hours', 'option' ) ? get_field( 'company_opening_hours', 'option' ) : '' );
	define( 'GROUND_COMPANY_CLOSING_TIME', get_field( 'company_closing time', 'option' ) ? get_field( 'company_closing time', 'option' ) : '' );

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

}

add_action( 'wp_head', 'ground_costants' );

