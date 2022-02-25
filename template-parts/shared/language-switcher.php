<?php if ( function_exists( 'icl_object_id' ) ) {
	$languages = apply_filters( 'wpml_active_languages', null, 'orderby=id&order=desc' );
	do_action( 'wpml_add_language_selector' );
	if ( ! empty( $languages ) ) {
		foreach ( $languages as $l ) {
			if ( $l['active'] == 0 ) {
				?>
			<a class="font-secondary text-base flex space-x-3 items-center lg:pr-6" href="<?php echo $l['url']; ?>">
				<img class="w-auto h-4 mr-3" src="<?php echo $l['country_flag_url']; ?>" alt="<?php echo $l['native_name']; ?>"> <?php echo $l['native_name']; ?>
			</a>
				<?php
			}
		}
	}
}
