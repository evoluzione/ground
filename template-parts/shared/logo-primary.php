<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo           = wp_get_attachment_image_src( $custom_logo_id, 'medium' );

if ( has_custom_logo() || GROUND_LOGO_SOURCE_PRIMARY ) { ?>
	<a class="logo logo--primary js-cursor-hide" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>">
		<?php
		if ( GROUND_LOGO_SOURCE_PRIMARY ) {
			echo GROUND_LOGO_SOURCE_PRIMARY;
		} elseif ( has_custom_logo() ) {
			?>
			<img src="<?php echo $logo[0]; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" >
		<?php } ?>
	</a>
<?php } else { ?>
	<a class="border border-dashed border-primary p-2" target="_blank" href="<?php echo admin_url( '/customize.php?return=%2Fwp-admin%2F', 'http' ); ?>">Upload your logo</a>
<?php } ?>
