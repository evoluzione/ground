<div class="flex flex-wrap gap-4 justify-center lg:justify-start mb-3">
	<?php if ( GROUND_PAYMENT_AMEX ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/assets/icons/payments/amex.svg'; ?>" alt="<?php esc_attr_e( 'Icon payment amex', 'ground' ); ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_APPLEPAY ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/assets/icons/payments/applepay.svg'; ?>" alt="<?php esc_attr_e( 'Icon payment apple pay', 'ground' ); ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_GPAY ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/assets/icons/payments/gpay.svg'; ?>" alt="<?php esc_attr_e( 'Icon payment google pay', 'ground' ); ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_MASTERCARD ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/assets/icons/payments/mastercard.svg'; ?>" alt="<?php esc_attr_e( 'Icon payment mastercard', 'ground' ); ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_MAESTRO ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/assets/icons/payments/maestro.svg'; ?>" alt="<?php esc_attr_e( 'Icon payment maestro', 'ground' ); ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_PAYPAL ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/assets/icons/payments/paypal.svg'; ?>" alt="<?php esc_attr_e( 'Icon payment paypal', 'ground' ); ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_SATISPAY ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/assets/icons/payments/satispay.svg'; ?>" alt="<?php esc_attr_e( 'Icon payment satispay', 'ground' ); ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_SEPA ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/assets/icons/payments/sepa.svg'; ?>" alt="<?php esc_attr_e( 'Icon payment sepa', 'ground' ); ?>" />
		</div>
	<?php endif; ?>
	<?php if ( GROUND_PAYMENT_VISA ) : ?>
		<div class="p-2 flex justify-center border border-septenary bg-white rounded">
			<img class="object-contain w-12 h-5 rounded-none" src="<?php echo GROUND_TEMPLATE_URL . '/assets/icons/payments/visa.svg'; ?>" alt="<?php esc_attr_e( 'Icon payment visa', 'ground' ); ?>" />
		</div>
	<?php endif; ?>
</div>
