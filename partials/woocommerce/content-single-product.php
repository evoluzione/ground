<?php
global $product;
$product_id    = get_the_ID();
$product_video = get_post_meta( $product_id, 'product_video', true );
?>

<div class="relative my-12 lg:my-24 bg-body-secondary py-6 px-6 lg:py-12 lg:px-0 transform -translate-x-2/4 w-screen ml-1/2 lg:rounded-theme lg:ml-0 lg:translate-x-0 lg:w-auto">

	<div class="grid grid-cols-12 gap-6 pt-3 pb-6 lg:py-12">
		<div class="col-span-full lg:col-start-2 lg:col-span-3">
			<h1 class="color-typo-primary text-3xl font-bold"><?php _e( 'Product specifications', 'ground' ); ?></h1>
		</div>
		<div class="col-span-full lg:col-start-7 lg:col-span-5">			
			<div class="text-typo-secondary text-base">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

	<?php if ( $product_video ) : ?>
		<div class="grid grid-cols-12 gap-6 lg:py-12">
			<div class="col-span-full lg:col-start-2 lg:col-span-10">
				<?php
				$product_video_iframe = apply_filters( 'the_content', $product_video );
				echo $product_video_iframe;
				?>
			</div>
		</div>
	<?php endif; ?>

</div>
