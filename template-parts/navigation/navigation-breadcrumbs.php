<?php
/**
 * Breadcrumb trail from Yoast SEO.
 */
$crumbs = ground_breadcrumbs();

if ( ! $crumbs ) {
	return;
}

$last = array_key_last( $crumbs );
?>
<nav class="mb-6" aria-label="<?php esc_attr_e( 'Breadcrumb', 'ground' ); ?>">
	<ol class="flex items-center gap-2">
		<?php foreach ( $crumbs as $i => $crumb ) : ?>
			<?php if ( $i === $last ) : ?>
				<li aria-current="page"><?php echo esc_html( $crumb['text'] ); ?></li>
			<?php else : ?>
				<li class="flex items-center gap-2">
					<?php if ( ! empty( $crumb['url'] ) ) : ?>
						<a class="hover:text-primary"
							href="<?php echo esc_url( $crumb['url'] ); ?>"><?php echo esc_html( $crumb['text'] ); ?></a>
					<?php else : ?>
						<?php // A crumb without a URL stays text, not an <a href=""> to nowhere. ?>
						<span><?php echo esc_html( $crumb['text'] ); ?></span>
					<?php endif; ?>
					<?php // Visual only: ground_icon() hides it from screen readers, the <ol> already conveys the order. ?>
					<?php ground_icon( [
						'name' => 'chevron-right',
						'attr' => [
							'class' => 'w-4 h-4',
						],
					] ); ?>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ol>
</nav>