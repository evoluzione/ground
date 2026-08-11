<?php
/**
 * WooCommerce
 */

get_template_part( 'template-parts/header/header-primary' );

$with_sidebar = is_shop() || is_product_taxonomy(); ?>

<main class="container grid grid-cols-1 lg:grid-cols-12 gap-6">

	<?php if ( $with_sidebar ) : ?>
		<div class="lg:col-span-2">
			<button
				type="button"
				class="js-toggle shop-filters-toggle lg:hidden"
				data-toggle-target=".shop-filters"
				aria-controls="shop-filters"
			>
				<?php esc_html_e( 'Filters', 'ground' ); ?>
			</button>
			<?php get_template_part( 'template-parts/sidebar/sidebar-shop' ); ?>
		</div>
	<?php endif; ?>

	<div class="<?php echo $with_sidebar ? 'lg:col-span-10' : 'lg:col-span-12'; ?>">

		<?php get_template_part( 'template-parts/navigation/navigation-breadcrumbs' ); ?>

		<?php woocommerce_content(); ?>

	</div>

</main>

<?php get_template_part( 'template-parts/footer/footer-primary' );
