<?php if ( GROUND_COMPANY_PHONE || GROUND_COMPANY_WHATSAPP ) : ?>
<ul class="mt-6 block list-none lg:mt-0 lg:flex lg:flex-row-reverse ">
	<?php if ( function_exists( 'icl_object_id' ) ) : ?>
		<li class="js-toggle py-3 text-lg lg:pl-4 lg:text-base lg:py-0" data-toggle-target="#modal-languages" data-toggle-class-name="hidden"><a class="cursor-pointer"><span class="mr-2"><?php ground_icon( 'globe-alt', 'icon--filled rounded-full text-white bg-black p-1 w-6 h-6' ); ?></span><?php _e( 'Language', 'ground' ); ?><span><?php ground_icon( 'chevron-down', 'text-black w-6 h-6' ); ?></span></a></li>
	<?php endif; ?>
	<?php if ( GROUND_COMPANY_PHONE ) : ?>
		<li class="py-3 text-lg lg:pl-4 lg:text-base lg:py-0"><a class="cursor-pointer" href="tel:<?php echo GROUND_COMPANY_PHONE; ?>"><span class="mr-2"><?php ground_icon( 'phone', 'icon--filled rounded-full text-white bg-purple-600 p-1 w-6 h-6' ); ?></span> <?php echo GROUND_COMPANY_PHONE; ?></a></li>
	<?php endif; ?>
	<?php if ( GROUND_COMPANY_WHATSAPP ) : ?>
		<li class="py-3 text-lg lg:text-base lg:py-0"><a class="cursor-pointer" href="https://wa.me/<?php echo GROUND_COMPANY_WHATSAPP; ?>"><span class="mr-2"><?php ground_icon( 'whatsapp', 'icon--filled rounded-full text-white bg-green-400 p-1 w-6 h-6', 'social' ); ?></span> <?php echo GROUND_COMPANY_WHATSAPP; ?></a></li>
	<?php endif; ?>
</ul>
<?php endif; ?>
