<?php if ( function_exists( 'the_custom_logo' ) || GROUND_LOGO_SOURCE_PRIMARY ) { ?>
	<a class="logo logo--primary js-cursor-hide" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
		<?php
		if ( GROUND_LOGO_SOURCE_PRIMARY ) {
			echo GROUND_LOGO_SOURCE_PRIMARY;
		} elseif ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
		?>
	</a>
<?php } else { ?>
	<a class="border border-dashed border-primary p-2" target="_blank" href="<?php echo admin_url( '/customize.php?return=%2Fwp-admin%2F', 'http' ); ?>">Upload your logo</a>
<?php } ?>
