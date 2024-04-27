import isMobile from 'ismobilejs';
import { dispatchCustomEvent, elementExist } from '@fabioquarantini/js-utils';

(() => {
	// ScrollDirection
	//if (!isMobile().any) {
		import(
			 './components/scrollDirection'
		)
			.then((module) => {
				module.scrollDirection();
			})
			.catch((error) => console.log(error));
	//}

	// Search
	if (elementExist('#js-ajax-search')) {
		import( './components/search')
			.then((module) => {
				const Search = module.default;
				new Search();
			})
			.catch((error) => console.log(error));
	}

	// Toggle
	// if (elementExist('.js-toggle')) {
	// 	import( './components/toggle')
	// 		.then((module) => {
	// 			const Toggle = module.default;
	// 			new Toggle();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// Modal
	// if (elementExist('[data-modal]')) {
	// 	import( './components/modal')
	// 		.then((module) => {
	// 			const Modal = module.default;
	// 			new Modal();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// Slider
	if (elementExist('.js-slider')) {
		import( './components/slider')
			.then((module) => {
				dispatchCustomEvent('MODULE_SLIDER_LOADED', module);
				const Slider = module.default;

				if (elementExist('.js-slider-default')) {
					new Slider();
				}

				if (elementExist('.js-slider-primary')) {
					new Slider('.js-slider-primary');
				}

				if (elementExist('.js-slider-gallery')) {
					new Slider('.js-slider-gallery', {
						direction: 'horizontal',
						loop: false,
						effect: 'slide',
						speed: 1000,
						autoHeight: false,
						parallax: true,
						autoplay: false,
						slidesPerView: 1,
						spaceBetween: 40,
						breakpoints: {
							// when window width is >= xl
							1440: {
								speed: 1400,
								spaceBetween: 80,
							},
						},
					});
				}
			})
			.catch((error) => console.log(error));
	}

	// YoastFaqBlock
	// if (elementExist('.schema-faq-question')) {
	// 	import(
	// 		 './components/yoastFaqBlock'
	// 	)
	// 		.then((module) => {
	// 			const YoastFaqBlock = module.default;
	// 			new YoastFaqBlock();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// InfiniteScroll
	// if (elementExist('.js-pagination')) {
	// 	import(
	// 		 './components/infiniteScroll'
	// 	)
	// 		.then((module) => {
	// 			const InfiniteScroll = module.default;
	// 			new InfiniteScroll();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// Menu
	// if (elementExist('.navigation__item.has-children')) {
	// 	import( './components/menu')
	// 		.then((module) => {
	// 			const Menu = module.default;
	// 			if (elementExist('.navigation__item--panel-primary')) {
	// 				new Menu('.navigation__item--panel-primary.has-children');
	// 			} else {
	// 				document.body.classList.add('panel-not-active');
	// 				new Menu();
	// 			}
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// Mega menu
	// if (elementExist('.navigation__item.has-children')) {
	// 	import( './components/mega-menu')
	// 		.then((module) => {
	// 			const MegaMenu = module.default;
	// 			new MegaMenu();
	// 		})
	// 		.catch((error) => console.log(error));
	// }



	// initWoocommerceScripts();
	// Billing Invoices
	// if (elementExist('#billing_invoice')) {
	// 	import( './components/billing')
	// 		.then((module) => {
	// 			const Billing = module.default;
	// 			new Billing();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// Cart
	// if (elementExist('.minicart')) {
	// 	import( './components/cart')
	// 		.then((module) => {
	// 			const Cart = module.default;
	// 			new Cart();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// WidgetAccordion
	// if (elementExist('.woocommerce-widget-layered-nav')) {
	// 	import(
	// 		 './components/widgetAccordion'
	// 	)
	// 		.then((module) => {
	// 			const WidgetAccordion = module.default;
	// 			new WidgetAccordion();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// woocommerce-checkout autocomplete
	// if (elementExist('form.woocommerce-checkout')) {
	// 	import(
	// 		 './components/checkoutAutocomplete'
	// 	)
	// 		.then((module) => {
	// 			const CheckoutAutocomplete = module.default;
	// 			new CheckoutAutocomplete();
	// 		})
	// 		.catch((error) => console.log(error));

	// }

})();
