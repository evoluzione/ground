<?php if (GROUND_HEADER_ADVICE_PRIMARY) : ?>
	<div class="message-alert message-alert--primary px-6 <?php echo GROUND_HEADER_ADVICE_PRIMARY ? 'bg-senary py-2' : ''; ?>">
		<div class="relative <?php echo GROUND_HEADER_ADVICE_SECONDARY ? 'h-10' : ''; ?> text-center text-tertiary">
			<p class="<?php echo GROUND_HEADER_ADVICE_SECONDARY ? 'message-alert__content text-tertiary' : ''; ?>">
				<?php echo GROUND_HEADER_ADVICE_PRIMARY; ?>
			</p>
			<?php if (GROUND_HEADER_ADVICE_SECONDARY) : ?>
				<p class="message-alert__content text-tertiary">
					<?php echo GROUND_HEADER_ADVICE_SECONDARY; ?>
				</p>
			<?php endif; ?>
			<?php if (GROUND_HEADER_ADVICE_TERTIARY) : ?>
				<p class="message-alert__content text-tertiary">
					<?php echo GROUND_HEADER_ADVICE_TERTIARY; ?>
				</p>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>