<?php
$repeater = GROUND_SHOP_PAYMENT;

?>

 <div class="container my-12 lg:my-24">
	<div class="text-center mb-24 grid grid-cols-12 gap-6 lg:text-left">
		<div class="col-span-full lg:col-span-6">
			<?php if(GROUND_PAYMENTS_TITLE) : ?>
				<div class="text-xl font-bold mb-4">
					<?php echo esc_html( GROUND_PAYMENTS_TITLE ); ?>
				</div>
			<?php endif; ?>

			<div class="flex flex-wrap gap-4 justify-start mb-3">
				<?php if ( $repeater ) : ?>
				<?php foreach ( $repeater as $row ) : ?>
					<div class="p-2 flex justify-center border border-line-primary rounded">
						<img class="object-contain w-12" src="<?php echo GROUND_TEMPLATE_URL . '/img/getway-icons/' . $row . '.svg'; ?>"/>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
			</div>

			<?php if(GROUND_PAYMENTS_CONTENT) : ?>
				<div class="text-typo-secondary md:max-w-lg">
					<?php echo esc_html( GROUND_PAYMENTS_CONTENT ); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="col-span-full lg:col-span-6">
			 <?php ground_icon( 'faster', 'icon--faster w-12 mb-3 text-typo-primary' ); ?>

			<div class="col-span-full lg:col-span-4 lg:text-left">
				<div class="text-xl font-bold mb-3">
					<?php echo esc_html( GROUND_SHIPPING_TITLE ); ?>
				</div>
				<div class="text-typo-secondary md:max-w-lg">
					<?php echo esc_html( GROUND_SHIPPING_CONTENT ); ?>
				</div>
			</div>
		</div>
	</div>
</div>




