<?php
/**
 * Announcement bar above the header: short messages, one at a time, that take
 * turns every few seconds. Its content is the Barra annunci box of the Opzioni
 * tema ACF options page, under Appearance (announcement_bar_* options); with
 * WPML, ACF reads the current language's.
 *
 * A message outside its dates is left out when the page is built: a cached page
 * keeps showing it until the cache is renewed.
 *
 * The messages share one grid cell, so the bar is as tall as the longest and
 * doesn't move when they change. The hidden ones are inert (out of reach of the
 * keyboard and screen readers) and inert:opacity-0 fades them out: without JS
 * the first one stays. src/js/components/announcementBar.js moves the inert
 * attribute and shows the buttons, which need it to work.
 *
 * Closing it hides it until the messages shown change, a scheduled one starting
 * included: the script stores their key and the inline script below reads it.
 */
if ( ! function_exists( 'get_field' ) || ! get_field( 'announcement_bar_active', 'option' ) ) {
	return;
}

// The messages within their dates. Same format as the date fields' return
// format: the strings compare in order.
$now = current_time( 'Y-m-d H:i:s' );
$messages = array_values( array_filter(
	get_field( 'announcement_bar_messages', 'option' ) ?: [],
	fn( $row ) => '' !== trim( $row['text'] )
		&& ( ! $row['start'] || $row['start'] <= $now )
		&& ( ! $row['end'] || $row['end'] > $now )
) );

if ( ! $messages ) {
	return;
}

// Text and links only: a new color alone doesn't bring a closed bar back.
$key = substr( md5( wp_json_encode( array_map( fn( $row ) => [ $row['text'], $row['link'] ], $messages ) ) ), 0, 8 );
$interval = (int) ( get_field( 'announcement_bar_interval', 'option' ) ?: 5 ) * 1000;

// A visitor who closed these messages: the class goes on <html> before the bar
// is parsed, so it never shows. The server can't leave it out (pages may come
// from a cache) and hiding it from the theme's deferred script would flash it.
wp_print_inline_script_tag( sprintf(
	'try{if(localStorage.getItem("ground-announcement-bar-closed")===%s)document.documentElement.classList.add("is-announcement-bar-closed")}catch(e){}',
	wp_json_encode( $key )
) );

// Each message's style colors the whole bar while it shows: the section reads it
// from the visible message (the one without inert), so the JS only moves inert.
// Dark unless primary or light; colors from the theme, so contrast is checked here.
?>
<section class="js-announcement-bar group/announcement-bar text-sm in-[.is-announcement-bar-closed]:hidden
	bg-gray-900 text-white transition-colors duration-300 motion-reduce:transition-none
	has-[[data-style=primary]:not([inert])]:bg-primary
	has-[[data-style=light]:not([inert])]:bg-gray-100 has-[[data-style=light]:not([inert])]:text-gray-900"
	aria-label="<?php esc_attr_e( 'Announcements', 'ground' ); ?>"
	data-key="<?php echo esc_attr( $key ); ?>"
	data-interval="<?php echo esc_attr( $interval ); ?>">
	<div class="container flex items-center gap-4 py-2">
		<div class="js-announcement-bar-messages grid flex-1 text-center">
			<?php foreach ( $messages as $index => $row ) : ?>
				<p class="js-announcement-bar-message [grid-area:1/1] self-center transition-opacity duration-300 motion-reduce:transition-none inert:opacity-0"
					data-style="<?php echo esc_attr( $row['style'] ?: 'dark' ); ?>"
					<?php echo $index ? 'inert' : ''; ?>>
					<?php echo esc_html( $row['text'] ); ?>
					<?php if ( $row['link'] ) : ?>
						<a class="ml-1 font-medium underline underline-offset-2 hover:no-underline" <?php echo ground_link_attributes( $row['link'] + [ 'current' => false ] ); ?>><?php echo esc_html( $row['link']['title'] ?: $row['link']['url'] ); ?></a>
					<?php endif; ?>
				</p>
			<?php endforeach; ?>
		</div>

		<div class="flex shrink-0 items-center gap-1">
			<?php if ( count( $messages ) > 1 ) : ?>
				<button class="js-announcement-bar-pause flex h-6 w-6 cursor-pointer items-center justify-center hover:opacity-70" type="button" hidden
					aria-label="<?php esc_attr_e( 'Pause the announcements', 'ground' ); ?>"
					data-label-pause="<?php esc_attr_e( 'Pause the announcements', 'ground' ); ?>"
					data-label-play="<?php esc_attr_e( 'Play the announcements', 'ground' ); ?>">
					<?php ground_icon( [
						'name' => 'circle-pause',
						'attr' => [
							'class' => 'w-5 h-5 group-data-paused/announcement-bar:hidden',
						],
					] ); ?>
					<?php ground_icon( [
						'name' => 'circle-play',
						'attr' => [
							'class' => 'w-5 h-5 hidden group-data-paused/announcement-bar:block',
						],
					] ); ?>
				</button>
			<?php endif; ?>
			<button class="js-announcement-bar-close flex h-6 w-6 cursor-pointer items-center justify-center hover:opacity-70" type="button" hidden
				aria-label="<?php esc_attr_e( 'Close the announcements', 'ground' ); ?>">
				<?php ground_icon( [
					'name' => 'x',
					'attr' => [
						'class' => 'w-5 h-5',
					],
				] ); ?>
			</button>
		</div>
	</div>
</section>
