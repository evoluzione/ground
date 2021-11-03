<footer class="relative pt-16 bg-body-secondary">
	<div class="container">
		<div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
			<?php $locations = get_nav_menu_locations(); ?>

			<?php if ( isset( $locations['footer-primary'] ) ) : ?>
			<div class="mb-12">
				<?php $title_footer_primary = wp_get_nav_menu_object( $locations['footer-primary'] ); ?>
				<h3 class="text-xl font-bold mb-4"> <?php echo $title_footer_primary->name; ?> </h3>
				<?php get_template_part( 'partials/navigation-footer', 'primary' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( isset( $locations['footer-secondary'] ) ) : ?>
			<div class="mb-12">
				<?php $title_footer_secondary = wp_get_nav_menu_object( $locations['footer-secondary'] ); ?>
				<h3 class="text-xl font-bold mb-4"> <?php echo esc_html( $title_footer_secondary->name ); ?> </h3>
				<?php get_template_part( 'partials/navigation-footer', 'secondary' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( isset( $locations['footer-tertiary'] ) ) : ?>
			<div class="mb-12">
				<?php $title_footer_tertiary = wp_get_nav_menu_object( $locations['footer-tertiary'] ); ?>
				<h3 class="text-xl font-bold mb-4"> <?php echo esc_html( $title_footer_tertiary->name ); ?> </h3>
				<?php get_template_part( 'partials/navigation-footer', 'tertiary' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( GROUND_COMPANY_OPENING_HOURS || GROUND_COMPANY_CLOSING_TIME ) : ?>
			<div class="mb-12">
				<?php if ( GROUND_COMPANY_OPENING_HOURS ) : ?>
				<div class="mb-4">
					<h3 class="text-xl font-bold mb-4"><?php _e( 'Opening Hours', 'ground' ); ?></h3>
					<span class="text-typo-secondary"><?php echo esc_html( GROUND_COMPANY_OPENING_HOURS ); ?></span>					
				</div>
				<?php endif; ?>
				<?php if ( GROUND_COMPANY_CLOSING_TIME ) : ?>
				<div>
					<h3 class="text-xl font-bold mt-6 lg:mt-8 mb-4"><?php _e( 'Closing Time', 'ground' ); ?></h3>
					<span class="text-typo-secondary"><?php echo esc_html( GROUND_COMPANY_CLOSING_TIME ); ?></span>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="container">
		<div class="mt-6 py-9 border-t border-line-primary lg:flex lg:items-center lg:justify-between lg:space-x-9 lg:pt-9">			
			<div class="mb-6 lg:mb-0">
				<p class="text-center lg:text-left text-typo-secondary text-sm lg:text-xs">
				<?php
				_e( 'All rights reserved - © copyright', 'ground' );
				echo date( 'Y' );
				echo ( '  ' );
				?>
				<?php echo GROUND_COMPANY_NAME ? GROUND_COMPANY_NAME . ' - ' : null; ?>
				<?php echo GROUND_COMPANY_ADDRESS ? GROUND_COMPANY_ADDRESS . ' - ' : null; ?>
				<?php echo GROUND_COMPANY_ZIP_CODE ? GROUND_COMPANY_ZIP_CODE : null; ?> <?php echo GROUND_COMPANY_CITY ? GROUND_COMPANY_CITY : null; ?>
				<?php echo GROUND_COMPANY_PROVINCE ? ( '( ' . GROUND_COMPANY_PROVINCE . ' )' ) : null; ?>
				<?php echo GROUND_COMPANY_COUNTRY ? GROUND_COMPANY_COUNTRY : null; ?>
				<?php echo GROUND_COMPANY_VAT ? ' - P.IVA:' . GROUND_COMPANY_VAT : null; ?>
				<?php echo GROUND_COMPANY_FISCAL_CODE ? ' - C.F.:' . GROUND_COMPANY_FISCAL_CODE : null; ?> </p>

				<div class="bg-red-500 p-12">
					<p>Debug new options from customizer</p>
					<h3>General info:</h3>
					<p>GROUND_COMPANY_NAME: <strong><?php echo esc_html( GROUND_COMPANY_NAME ); ?></strong></p>
					<p>GROUND_COMPANY_ZIP_CODE: <strong> <?php echo esc_html( GROUND_COMPANY_ZIP_CODE ); ?></strong></p>
					<p>GROUND_COMPANY_VAT: <strong> <?php echo esc_html( GROUND_COMPANY_VAT ); ?></strong></p>
					<p>GROUND_COMPANY_FISCAL_CODE: <strong> <?php echo esc_html( GROUND_COMPANY_FISCAL_CODE ); ?></strong></p>

					<h3>Address:</h3>
					<p>GROUND_COMPANY_ADDRESS: <strong> <?php echo esc_html( GROUND_COMPANY_ADDRESS ); ?></strong></p>
					<p>GROUND_COMPANY_CITY: <strong> <?php echo esc_html( GROUND_COMPANY_CITY ); ?></strong></p>
					<p>GROUND_COMPANY_PROVINCE: <strong> <?php echo esc_html( GROUND_COMPANY_PROVINCE ); ?></strong></p>
					<p>GROUND_COMPANY_COUNTRY: <strong> <?php echo esc_html( GROUND_COMPANY_COUNTRY ); ?></strong></p>
					<p>GROUND_COMPANY_ADDRESS_URL: <strong> <?php echo esc_html( GROUND_COMPANY_ADDRESS_URL ); ?></strong></p>
					<p>GROUND_COMPANY_ADDRESS_LATITUDE: <strong> <?php echo esc_html( GROUND_COMPANY_ADDRESS_LATITUDE ); ?></strong></p>
					<p>GROUND_COMPANY_ADDRESS_LONGITUDE: <strong> <?php echo esc_html( GROUND_COMPANY_ADDRESS_LONGITUDE ); ?></strong></p>

					<h3>Phones:</h3>
					<p>GROUND_COMPANY_PHONE: <strong> <?php echo esc_html( GROUND_COMPANY_PHONE ); ?></strong></p>
					<p>GROUND_COMPANY_WHATSAPP: <strong> <?php echo esc_html( GROUND_COMPANY_WHATSAPP ); ?></strong></p>
					<p>GROUND_COMPANY_FAX: <strong> <?php echo esc_html( GROUND_COMPANY_FAX ); ?></strong></p>

					<h3>Emails:</h3>
					<p>GROUND_COMPANY_EMAIL: <strong> <?php echo esc_html( GROUND_COMPANY_EMAIL ); ?></strong></p>
					<p>GROUND_COMPANY_PEC: <strong> <?php echo esc_html( GROUND_COMPANY_PEC ); ?></strong></p>

					<h3>Hours:</h3>
					<p>GROUND_COMPANY_OPENING_HOURS: <strong> <?php echo esc_html( GROUND_COMPANY_OPENING_HOURS ); ?></strong></p>
					<p>GROUND_COMPANY_CLOSING_TIME: <strong> <?php echo esc_html( GROUND_COMPANY_CLOSING_TIME ); ?></strong></p>

				</div>


			</div>
			
			<div class="lg:border-l border-line-primary">
				<?php get_template_part( 'partials/socials' ); ?>
			</div>

		</div>

	</div>

</footer>
