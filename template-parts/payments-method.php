<div class="flex flex-wrap gap-4 justify-center lg:justify-start mb-3">
	<?php if ( GROUND_PAYMENT_AMEX ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/icons/payments/amex.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_APPLEPAY ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/icons/payments/applepay.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_GPAY ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/icons/payments/gpay.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_MASTERCARD ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/icons/payments/mastercard.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_MAESTRO ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/icons/payments/maestro.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_PAYPAL ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/icons/payments/paypal.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_SATISPAY ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/icons/payments/satispay.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_SEPA ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/icons/payments/sepa.svg'; ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_VISA ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/img/icons/payments/visa.svg'; ?>" />
		</div>
	<?php endif; ?>
</div>
