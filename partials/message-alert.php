<?php if ( GROUND_HEADER_ADVICE_PRIMARY ) : ?>
<div class="message-alert message-alert--primary <?php echo GROUND_HEADER_ADVICE_PRIMARY ? 'bg-body-secondary py-2' : ''; ?> text-center text-typo-primary">
	<div class="<?php echo esc_attr( GROUND_CONTAINER ); ?>">

		<p class="advise-1 text-typo-primary"><?php echo GROUND_HEADER_ADVICE_PRIMARY; ?></p>

		<p class="advise-2 text-typo-primary"><?php echo GROUND_HEADER_ADVICE_SECONDARY; ?></p>

		<p class="advise-3 text-typo-primary"><?php echo GROUND_HEADER_ADVICE_TERTIARY; ?></p>

	</div>
</div>
<?php endif; ?>
