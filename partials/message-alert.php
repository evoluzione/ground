<?php if ( GROUND_HEADER_ADVICE_PRIMARY ) : ?>
<div class="message-alert message-alert--primary px-6 <?php echo GROUND_HEADER_ADVICE_PRIMARY ? 'bg-body-secondary py-2' : ''; ?>">
	<div class="relative h-10 text-center text-typo-primary">
		<p class="message-alert__content text-typo-primary">
			<?php echo GROUND_HEADER_ADVICE_PRIMARY; ?>
		</p>

		<p class="message-alert__content text-typo-primary">
			<?php echo GROUND_HEADER_ADVICE_SECONDARY; ?>
		</p>

		<p class="message-alert__content text-typo-primary">
			<?php echo GROUND_HEADER_ADVICE_TERTIARY; ?>
		</p>
	</div>
</div>
<?php endif; ?>
