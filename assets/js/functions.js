import { elementExist } from './utilities/selector';
import isMobile from 'ismobilejs';
import { trigger } from './utilities/trigger';


function initAlwaysRunScripts() {

	// ScrollDirection
	if (!isMobile().any) {
		import(/* webpackChunkName: "ground-scrollDirection" */'./components/scrollDirection')
			.then((module) => {
				const ScrollDirection = module.default;
				new ScrollDirection();
			});
	}

	// Search
	if (elementExist('#js-ajax-search')) {
		import(/* webpackChunkName: "ground-search" */'./components/search')
			.then((module) => {
				const Search = module.default;
				new Search();
			})
			.catch((error) => console.log(error));
	}

	// Toggle
	if (elementExist('.js-toggle')) {
		import(/* webpackChunkName: "ground-toggle" */'./components/toggle')
			.then((module) => {
				const Toggle = module.default;
				new Toggle;
			})
			.catch((error) => console.log(error));
	}

	// Modal
	if (elementExist('[data-modal]')) {
		import(/* webpackChunkName: "ground-modal" */'./components/modal')
			.then((module) => {
				const Modal = module.default;
				new Modal();
			})
			.catch((error) => console.log(error));
	}

	// Slider
	if (elementExist('.js-slider')) {
		import(/* webpackChunkName: "ground-slider" */'./components/slider')
			.then((module) => {

				trigger('MODULE_SLIDER_LOADED', module);
				const Slider = module.default;

				if (elementExist('.js-slider-default')) {
					new Slider;
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
								spaceBetween: 80
							}
						}
					});
				}

			})
			.catch((error) => console.log(error));
	}

	// YoastFaqBlock
	if (elementExist('.schema-faq-question')) {
		import(/* webpackChunkName: "ground-yoastFaqBlock" */'./components/yoastFaqBlock')
			.then((module) => {
				const YoastFaqBlock = module.default;
				new YoastFaqBlock();
			})
			.catch((error) => console.log(error));
	}

	// InfiniteScroll
	if (elementExist('.js-pagination')) {
		import(/* webpackChunkName: "ground-infiniteScroll" */'./components/infiniteScroll')
			.then((module) => {
				const InfiniteScroll = module.default;
				new InfiniteScroll();
			})
			.catch((error) => console.log(error));
	}

	// Menu
	if (elementExist('.navigation__item.has-children')) {
		import(/* webpackChunkName: "ground-menu" */'./components/menu')
			.then((module) => {
				const Menu = module.default;
				new Menu();
			})
			.catch((error) => console.log(error));
	}
}

function initWoocommerceScripts() {

	// Billing Invoices
	if (elementExist('#billing_invoice')) {
		import(/* webpackChunkName: "ground-billing" */'./components/billing')
			.then((module) => {
				const Billing = module.default;
				new Billing();
			})
			.catch((error) => console.log(error));
	}

	// Cart
	if (elementExist('.minicart')) {
		import(/* webpackChunkName: "ground-cart" */'./components/cart')
			.then((module) => {
				const Cart = module.default;
				new Cart();
			})
			.catch((error) => console.log(error));
	}

	// WidgetAccordion
	if (elementExist('.woocommerce-widget-layered-nav')) {
		import(/* webpackChunkName: "ground-widgetAccordion" */'./components/widgetAccordion')
			.then((module) => {
				const WidgetAccordion = module.default;
				new WidgetAccordion();
			})
			.catch((error) => console.log(error));
	}

}

export {
	initAlwaysRunScripts,
	initWoocommerceScripts
};
