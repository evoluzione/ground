<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_template_part( 'partials/header' ); ?>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<section class="page page--woocommerce-archive">

<div class="grid grid-cols-12 gap-x-6 lg:mt-12">

	<div class="
	<?php
	if ( ! is_active_sidebar( 'sidebar-woocommerce' ) ) {
		echo 'hidden';
	} else {
		echo 'lg:col-span-3 col-span-full';
	}
	?>
	">
		<?php
		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );

		?>
	</div>

	<div class="
	<?php
	if ( ! is_active_sidebar( 'sidebar-woocommerce' ) ) {
		echo 'col-span-full';
	} else {
		echo 'lg:col-span-9 col-span-full';
	}
	?>
	">
		

			<div class="page__body">

				<?php
				if ( woocommerce_product_loop() ) {
					?>

					<?php
					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked wc_print_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );

					woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 *
							 * @hooked WC_Structured_Data::generate_product_data() - 10
							 */
							do_action( 'woocommerce_shop_loop' );
							?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php
						}
					}

					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				}
				?>

			</div>
			
		</div>
		
	</div> <!-- End flex -->
	
</section>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>

<?php get_template_part( 'partials/footer' ); ?>
