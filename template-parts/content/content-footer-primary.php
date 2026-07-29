<?php
$footer_sidebars = [ 'sidebar-footer-primary', 'sidebar-footer-secondary', 'sidebar-footer-tertiary', 'sidebar-footer-quaternary' ];
$active_footer_sidebars = array_filter( $footer_sidebars, 'is_active_sidebar' );
?>
<footer class="footer border-t mt-6">

	<?php if ( ! empty( $active_footer_sidebars ) ) : ?>
		<div class="container max-w-6xl py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
			<?php foreach ( $active_footer_sidebars as $sidebar_id ) : ?>
				<div class="space-y-4">
					<?php dynamic_sidebar( $sidebar_id ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div class="border-t">
		<div
			class="container max-w-6xl py-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4 text-sm text-center md:text-left">

			<p class="text-slate-500">
				<?php ground_icon( [
					'name' => 'copyright',
					'attr' => [
						'class' => 'w-4 h-4 inline'
					]
				] ); ?>
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
			</p>

			<div class="flex flex-col md:flex-row gap-4">
				<?php get_template_part( 'template-parts/navigation/navigation-footer-primary' ); ?>
				<?php get_template_part( 'template-parts/navigation/navigation-footer-secondary' ); ?>
				<?php get_template_part( 'template-parts/navigation/navigation-footer-tertiary' ); ?>
			</div>

		</div>
	</div>
</footer> <!-- End .footer -->