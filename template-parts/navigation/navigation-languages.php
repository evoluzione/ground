<?php
/**
 * Language switcher (WPML), shown when there is another language to switch to.
 * A language without a translation of this page links to its home page.
 */
$languages = apply_filters( 'wpml_active_languages', null, [ 'skip_missing' => 0 ] ) ?: [];
$current = current( wp_list_filter( $languages, [ 'active' => 1 ] ) );
$others = wp_list_filter( $languages, [ 'active' => 0 ] );

if ( ! $current || ! $others ) {
	return;
}

$list_id = wp_unique_id( 'languages-' );
/* translators: %s: name of the current language, in that language. */
$label = sprintf( __( 'Language: %s', 'ground' ), $current['native_name'] );
?>
<nav class="relative group" aria-label="<?php esc_attr_e( 'Languages', 'ground' ); ?>">
	<button class="peer js-submenu-toggle flex items-center pl-4 cursor-pointer" type="button" aria-expanded="false"
		aria-controls="<?php echo esc_attr( $list_id ); ?>" aria-label="<?php echo esc_attr( $label ); ?>">
		<?php ground_icon( [ 'name' => 'globe', 'attr' => [ 'class' => 'w-4 h-4 mr-2' ] ] ); ?>
		<?php echo esc_html( $current['native_name'] ); ?>
		<?php ground_icon( [ 'name' => 'chevron-down', 'attr' => [ 'class' => 'w-4 h-4 ml-2' ] ] ); ?>
	</button>

	<ul id="<?php echo esc_attr( $list_id ); ?>"
		class="hidden group-hover:block peer-aria-expanded:block absolute top-full right-0 min-w-full list-none bg-white border border-gray-300 rounded-md shadow-lg">
		<?php foreach ( $others as $language ) : ?>
			<li>
				<a class="block px-4 py-2 text-gray-700 hover:text-primary"
					href="<?php echo esc_url( $language['url'] ); ?>"
					lang="<?php echo esc_attr( $language['language_code'] ); ?>"
					hreflang="<?php echo esc_attr( $language['language_code'] ); ?>"><?php echo esc_html( $language['native_name'] ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>