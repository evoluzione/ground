<?php
/**
 * Table block template.
 * Register block here: "inc/gutenberg.php".
 * Require: https://wordpress.org/plugins/advanced-custom-fields-table-field/
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$table     = get_field( 'table' );
$no_margin = get_field( 'no_margin' );
?>

<?php if ( ! empty( $table ) ) : ?>
	<div class="<?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?> relative">
	<?php if ( ! empty( $table['caption'] ) ) : ?>
		<h2 class=""> <?php echo $table['caption']; ?> </h2>
	<?php endif; ?>
	<div class="relative ground-block hidden rounded-theme lg:block border border-septenary overflow-hidden not-prose <?php echo esc_attr( ground_block_class( $block ) ); ?>">
		<table border="0" class="mb-0 table-fixed">
			<?php if ( ! empty( $table['header'] ) ) : ?>
				<thead>
					<tr class="text-center">
						<?php foreach ( $table['header'] as $th ) : ?>
							<th class="text-center text-2xl font-normal">
								<?php echo $th['c']; ?>
							</th>
						<?php endforeach; ?>
					</tr>
				</thead>
			<?php endif; ?>
			<tbody>
				<?php foreach ( $table['body'] as $tr ) : ?>
					<tr class="text-center">
						<?php foreach ( $tr as $td ) : ?>
							<td class="text-2xl">
								<?php echo $td['c']; ?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<?php if ( ! empty( $table['header'] || ! empty( $table['body'] ) ) ) : ?>
		<div class="border border-septenary overflow-hidden rounded-theme lg:hidden <?php echo esc_attr( ground_block_class( $block ) ); ?> <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?>">
			<div class="lg:grid lg:grid-flow-col lg:grid-cols- lg:gap-1">

				<?php for ( $i = 0; $i < count( $table['body'] ); $i++ ) : ?>
					<?php if ( $table['header'] && count( $table['header'] ) > 0 ) : ?>
						<h2 class="bg-primary text-white text-center text-2xl py-3 mb-0 lg:text-xl"><?php echo $table['header'][ $i ]['c']; ?></h2>
					<?php endif; ?>


					<?php for ( $j = 0; $j < count( $table['body'] ); $j++ ) : ?>
						<p class="text-center text-2xl py-3  <?php echo $j > 0 ? 'border-t border-septenary' : ''; ?> <?php echo ! $table['header'] ? 'border-t border-septenary' : ''; ?>"> <?php echo $table['body'][ $j ][ $i ]['c'] ? $table['body'][ $j ][ $i ]['c'] : ''; ?> </p>
					<?php endfor; ?>

				<?php endfor; ?>
			</div>
		</div>
	<?php endif; ?>
	</div>
<?php endif; ?>
