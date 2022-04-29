<?php get_template_part( 'template-parts/meassage-alert' ); ?>

<header class="header header-simple w-full z-30 bg-white">

	<div class="bg-white h-16 w-full z-30 lg:hidden">
		
	<button type="button" class="js-back absolute mt-5 left-4 header__back cursor-pointer">
		<span> <?php ground_icon( 'chevron-left', 'text-black' ); ?> </span> <?php _e( 'Back', 'ground' ); ?>
	</button>

		<div class="header__bar-mobile container py-2 bg-white grid grid-cols-12 items-center lg:flex lg:items-center lg:justify-between">
			<div class="col-span-4">
				<?php get_template_part( 'template-parts/header/navicon-primary' ); ?>
			</div>
			<div class="col-span-4 flex justify-center header__logo">
				<?php get_template_part( 'template-parts/shared/logo-primary' ); ?>
			</div>
			<div class="col-span-4 flex justify-end items-center">
				<button class="js-toggle js-cursor-hover mr-6 lg:mr-12" data-toggle-target=".search-form__wrapper html" data-toggle-class-name="is-search-open" aria-label="<?php esc_attr_e( 'Search', 'ground' ); ?>">
					<?php ground_icon( 'search', 'icon--filled text-black' ); ?>
				</button>
				<div class="header__cart relative py-4 col-span-4 flex justify-end items-center lg:hidden">
					<?php get_template_part( 'template-parts/woocommerce/shopping-cart' ); ?>
				</div>
			</div>
		</div>

	</div>

	<div class="js-menu-body header__body fixed left-0 pb-72 h-full w-screen z-40 bg-white overflow-y-scroll lg:pt-0 lg:mt-0 lg:relative lg:top-auto lg:left-auto lg:bottom-auto lg:right-auto lg:bg-transparent lg:overflow-y-visible lg:w-full lg:pb-0">
		<div class="js-menu-container header__container relative">
			<div class="container hidden lg:relative lg:flex lg:justify-between lg:items-center lg:h-16 xl:justify-end xl:space-x-6">
				<?php if ( has_nav_menu( 'header-secondary' ) ) : ?>
					<div class="xl:border-r xl:border-gray-200 xl:pr-6">
						<?php get_template_part( 'template-parts/navigation/navigation-header-secondary' ); ?>
					</div>
				<?php endif; ?>
				<div class="pl-6 lg:items-center lg:space-x-6 lg:pl-0 lg:flex lg:justify-end xl:justify-start">
					<div class="hidden lg:inline-block ">
						<?php get_template_part( 'template-parts/shared/company-info-contacts' ); ?>
					</div>

					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<ul class=" relative z-0 lg:flex lg:items-center lg:space-x-5 lg:justify-end lg:m-0">
							<li class="text-lg lg:border-l lg:border-gray-200 lg:pl-6 lg:text-base"><a class="inline-block lg:py-auto" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><?php _e( 'Account', 'ground' ); ?><span class="hidden ml-2 lg:inline-block"><?php ground_icon( 'user', 'icon--filled text-black' ); ?></span></a></li>
							<li class="hidden minicart-wrapper py-4 lg:inline-block"><?php get_template_part( 'template-parts/woocommerce/shopping-cart' ); ?> </li>
						</ul>
					<?php endif; ?>
				</div>

			</div>

			<div class="flex flex-col-reverse lg:block">

				<div class="container lg:relative lg:flex lg:justify-between lg:items-center lg:h-16">

					<div class="hidden lg:inline-block mr-8">
						<?php get_template_part( 'template-parts/shared/logo-primary' ); ?>
					</div>

					<div class="relative lg:flex lg:justify-end lg:items-center">

						<?php get_template_part( 'template-parts/navigation/navigation-header-primary' ); ?>

						<button class="hidden js-toggle lg:block" data-toggle-target="#js-search-form html" data-toggle-class-name="is-search-open">
							<?php ground_icon( 'search', 'icon--filled text-black' ); ?>
						</button>

						<div class="block lg:hidden">
							<?php get_template_part( 'template-parts/navigation/navigation-header-secondary' ); ?>
						</div>

						<div class="block lg:hidden">
							<?php get_template_part( 'template-parts/shared/company-info-contacts' ); ?>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>

</header> <!-- End header -->
