<?php get_template_part( 'template-parts/header/message-alert' ); ?>

<header class="header header-logo-centered w-full z-30 bg-quinary">

	<div class="bg-quinary h-16 w-full z-30 lg:hidden">
		<a class="js-back absolute mt-5 left-4 header__back cursor-pointer"> <span> <?php ground_icon( 'chevron-left', 'text-tertiary' ); ?> </span> <?php _e( 'Indietro', 'ground' ); ?> </a>

		<div class="header__bar-mobile container py-2 bg-quinary grid grid-cols-12 items-center lg:flex lg:items-center lg:justify-between">
			<div class="col-span-4">
				<?php get_template_part( 'template-parts/header/navicon-primary' ); ?>
			</div>
			<div class="col-span-4 flex justify-center header__logo">
				<?php get_template_part( 'template-parts/shared/logo-primary' ); ?>
			</div>
			<div class="col-span-4 flex justify-end items-center">
				<button class="js-toggle js-cursor-hover mr-6 lg:mr-12" data-toggle-target=".search html" data-toggle-class-name="is-search-open">
					<?php ground_icon( 'search', 'icon--filled text-tertiary' ); ?>
				</button>
				<div class="header__cart relative py-4 col-span-4 flex justify-end items-center lg:hidden">
					<?php get_template_part( 'template-parts/woocommerce/shopping-cart' ); ?>
				</div>
			</div>

		</div>

	</div>

	<div class="js-menu-body header__body fixed left-0 pb-72 h-full w-screen z-40 bg-quinary overflow-y-scroll lg:pt-0 lg:mt-0 lg:relative lg:top-auto lg:left-auto lg:bottom-auto lg:right-auto lg:bg-transparent lg:overflow-y-visible lg:w-full lg:pb-0">
		<div class="js-menu-container header__container relative">

			<div class="container lg:relative lg:grid lg:grid-cols-12 lg:items-center lg:h-32">
				<div class="relative lg:col-span-5 lg:flex lg:justify-start lg:items-center">
					<?php if ( has_nav_menu( 'header-primary' ) ) : ?>
						<?php get_template_part( 'template-parts/navigation/navigation-header-primary' ); ?>
					<?php endif; ?>

					<div class="block lg:hidden ">
						<?php get_template_part( 'template-parts/navigation/navigation-header-secondary' ); ?>
					</div>

					<div class="block lg:hidden">
						<?php get_template_part( 'template-parts/shared/company-info-contacts' ); ?>
					</div>
				</div>

				<div class="hidden lg:col-span-2 lg:relative lg:flex lg:justify-center lg:items-center">
					<?php get_template_part( 'template-parts/shared/logo-primary' ); ?>
				</div>

				<div class="hidden lg:col-span-5 lg:relative lg:flex lg:justify-end lg:items-center">
					<?php if ( has_nav_menu( 'header-secondary' ) ) : ?>
						<?php get_template_part( 'template-parts/navigation/navigation-header-secondary' ); ?>
					<?php endif; ?>

					<button class="js-toggle lg:block lg:pr-3 lg:pl-3 lg:ml-3" data-toggle-target="#js-search-form html" data-toggle-class-name="is-search-open">
						<?php ground_icon( 'search', 'icon--filled text-tertiary' ); ?>
					</button>

					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<ul class=" relative z-0 lg:flex lg:items-center lg:space-x-5 lg:justify-end lg:m-0">
							<li class="text-lg lg:pl-3 lg:text-base"><a class="inline-block lg:py-auto" href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"><?php ground_icon( 'user', 'icon--filled text-tertiary' ); ?></a></li>
							<li class="minicart-wrapper py-4 lg:inline-block"><?php get_template_part( 'template-parts/woocommerce/shopping-cart' ); ?> </li>
						</ul>
					<?php endif; ?>

				</div>
			</div>

		</div>
	</div>

</header> <!-- End header -->
