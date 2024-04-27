<?php
// Video modal (Register block here: "inc/gutenberg.php")
$image_cover  = get_field( 'image_cover' );
$video_cover  = get_field( 'video_cover' );
$embed_modal  = get_field( 'embed_modal' );
$video_modal  = get_field( 'video_modal' );
$no_margin = get_field( 'no_margin' );
?>
<div class="ground-block not-prose relative cursor-pointer <?php echo esc_attr( ground_block_class( $block ) ); ?>  <?php echo $no_margin ? '' : 'my-12 lg:my-24'; ?>">

	<div class="overflow-hidden aspect-w-16 aspect-h-9" data-scroll="js-video" data-modal="gallery">
		<a class="group" data-pswp-type="<?php echo $embed_modal ? "embed" : "video" ?>" href="<?php echo $embed_modal ? $embed_modal : $video_modal ?>" target="_blank">
			<?php if($image_cover) { ?>
			<div class="aspect-w-16 aspect-h-9">
				<img class="object-cover" src="<?php echo $image_cover['sizes']['16-9-large'];?>" alt="">
			</div>
			<?php } elseif($video_cover) {?>
			<video data-scroll-target preload="none" playsinline muted loop>
				<source src="<?php echo $video_cover;?>" type="video/mp4">
			</video>
			<?php } ?>
			<div class=" absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
				<div class="absolute -left-5 -right-5 -top-5 -bottom-5 group-hover:-left-3 group-hover:-right-3 group-hover:-top-3 group-hover:-bottom-3 transition-all border border-white rounded-full"></div>
				<div class="drop-shadow-xl relative flex w-24 h-24 pl-2 justify-center items-center rounded-full bg-white">
					<div class="flex text-black">
						<?php ground_icon( 'play-button', 'h-20' ); ?>
					</div>
				</div>
			</div>
		</a>
	</div>


</div>







