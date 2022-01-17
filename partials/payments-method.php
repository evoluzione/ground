<div class="flex flex-wrap gap-4 justify-center lg:justify-start mb-3">
	<?php if (GROUND_PAYMENT_AMEX) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/amex.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if (GROUND_PAYMENT_APPLEPAY) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/applepay.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if (GROUND_PAYMENT_GPAY) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/gpay.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if (GROUND_PAYMENT_MASTERCARD) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/mastercard.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if (GROUND_PAYMENT_MAESTRO) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/maestro.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if (GROUND_PAYMENT_PAYPAL) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/paypal.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if (GROUND_PAYMENT_SATISPAY) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/satispay.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if (GROUND_PAYMENT_SEPA) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/sepa.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if (GROUND_PAYMENT_VISA) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/visa.svg'; ?>" />
		</div>
	<?php endif; ?>
</div>