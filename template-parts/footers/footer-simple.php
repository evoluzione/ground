<footer class="footer footer--simple relative pt-16 bg-senary">
	<div class="container">
		<div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

			<?php if ( is_active_sidebar( 'sidebar-footer-primary' ) ) : ?>
				<div class="mb-12">
					<?php get_template_part( 'template-parts/sidebar', 'footer-primary' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-footer-secondary' ) ) : ?>
				<div class="mb-12">
					<?php get_template_part( 'template-parts/sidebar', 'footer-secondary' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-footer-tertiary' ) ) : ?>
				<div class="mb-12">
					<?php get_template_part( 'template-parts/sidebar', 'footer-tertiary' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'sidebar-footer-quaternary' ) ) : ?>
				<div class="mb-12">
					<?php get_template_part( 'template-parts/sidebar', 'footer-quanternary' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="container">
		<div class="mt-6 py-9 border-t border-septenary lg:flex lg:items-center lg:justify-between lg:space-x-9 lg:pt-9">
			<div class="mb-6 lg:mb-0">
				<p class="text-center lg:text-left text-quaternary text-sm lg:text-xs">
					<?php echo __( 'All rights reserved - © copyright', 'ground' ) . ' ' . date( 'Y' ) . ' '; ?>
					<?php echo GROUND_COMPANY_NAME ? GROUND_COMPANY_NAME . ' - ' : null; ?>
					<?php echo GROUND_COMPANY_ADDRESS ? GROUND_COMPANY_ADDRESS . ' - ' : null; ?>
					<?php echo GROUND_COMPANY_ZIP_CODE ? GROUND_COMPANY_ZIP_CODE : null; ?> <?php echo GROUND_COMPANY_CITY ? GROUND_COMPANY_CITY : null; ?>
					<?php echo GROUND_COMPANY_PROVINCE ? ( '( ' . GROUND_COMPANY_PROVINCE . ' )' ) : null; ?>
					<?php echo GROUND_COMPANY_COUNTRY ? GROUND_COMPANY_COUNTRY : null; ?>
					<?php echo GROUND_COMPANY_VAT ? ' - P.IVA:' . GROUND_COMPANY_VAT : null; ?>
					<?php echo GROUND_COMPANY_FISCAL_CODE ? ' - C.F.:' . GROUND_COMPANY_FISCAL_CODE : null; ?>
				</p>
			</div>

			<div class="lg:border-l border-septenary">
				<?php get_template_part( 'template-parts/socials' ); ?>
			</div>
		</div>

	</div>

</footer>
