/* eslint-disable no-unused-vars */
import Loader from './components/loader';
import GdprCompliance from './components/gdprCompliance';

// const infiniteScroll = new InfiniteScroll();
const loader = new Loader();
const gdprCompliance = new GdprCompliance();

// ----- TO DO -----
// Test this solution and move inside Javascript Class: Soluzione basata sul blocco FAQ di Yoast SEO.
const faqSingleTriggers = document.querySelectorAll('.schema-faq-question');
faqSingleTriggers.forEach((trigger) => trigger.addEventListener('click', toggleAccordion));
function toggleAccordion() {
	const items = document.querySelectorAll('.schema-faq-section');
	const thisItem = this.parentNode;

	items.forEach((item) => {
		if (thisItem == item) {
			thisItem.classList.toggle('is-open');
			return;
		}
		item.classList.remove('is-open');
	});
}

// Refactor lazy loading
// https://webpack.js.org/guides/lazy-loading/

window.addEventListener('DOMContentLoaded', () => {
	// Cursor
	if (document.getElementsByClassName('js-cursor').length > 0) {
		import(/* webpackChunkName: "cursor" */'./components/cursorV2')
			.then((module) => {
				const Cursor = module.default;
				new Cursor().init();
			})
			.catch((error) => console.log(error));
	}

	// Modal - TODO
	if (document.querySelectorAll('[data-modal]').length > 0) {
		import(/* webpackChunkName: "modal" */'./components/modal')
			.then((module) => {
				const Modal = module.default;
				new Modal().init();
			})
			.catch((error) => console.log(error));
	}

	// Toggle
	if (document.getElementsByClassName('js-toggle').length > 0) {
		import(/* webpackChunkName: "toggle" */'./components/toggle')
			.then((module) => {
				const Toggle = module.default;
				new Toggle;
			})
			.catch((error) => console.log(error));
	}

	// Magnet
	if (document.getElementsByClassName('js-magnet').length > 0) {
		import(/* webpackChunkName: "magnet" */'./components/magnetV2')
			.then((module) => {
				const Magnet = module.default;
				new Magnet().init(); // fire manually because async
			})
			.catch((error) => console.log(error));
	}

	// Animations
	if (document.querySelectorAll('[data-scroll]').length > 0) {
		import(/* webpackChunkName: "animationAll" */'./animations/animationAll')
			.then((module) => {
				const AnimationsAll = module.default;
				new AnimationsAll();
			})
			.catch((error) => console.log(error));
	}

	// AnimationsFlip
	if (document.querySelectorAll('[data-flip]').length > 0) {
		import(/* webpackChunkName: "animationsFlip" */'./animations/animationsFlip')
			.then((module) => {
				const AnimationsFlip = module.default;
				new AnimationsFlip();
			})
			.catch((error) => console.log(error));
	}

	// Slider
	if (
		document.getElementsByClassName('js-slider-primary').length > 0 || 
		document.getElementsByClassName('js-slider').length > 0 || 
		document.getElementsByClassName('js-carousel').length > 0 || 
		document.getElementsByClassName('js-slider-gallery').length > 0
	) {
		import(/* webpackChunkName: "slider" */'./components/slider')
			.then((module) => {
				const Slider = module.default;

				if(document.getElementsByClassName('js-slider').length > 0) {
					new Slider.init();
				}


				if (
					document.getElementsByClassName('js-slider-primary').length > 0
				) {
					const sliderPrimary = new Slider('.js-slider-primary')
					sliderPrimary.init();
				}

				if (document.getElementsByClassName('js-carousel').length > 0) {

					const carousel = new Slider('.js-carousel', {
						loop: false,
						autoHeight: false,
						effect: 'slide',
						slidesPerView: 'auto',
						spaceBetween: 24,
						parallax: false,
						autoplay: false,
						freeMode: false,
						speed: 1000,
						touchEventsTarget: '.swiper-wrapper',
						pagination: {
							el: '.swiper-pagination',
							type: 'progressbar'
						}
					});
					carousel.init();

				}

				if (document.getElementsByClassName('js-slider-gallery').length > 0) {

					const sliderGallery = new Slider('.js-slider-gallery', {
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
					sliderGallery.init();
				}

			})
			.catch((error) => console.log(error));
	}

	// Search
	if (document.getElementById('js-ajax-search')) {
		import(/* webpackChunkName: "search" */'./components/search')
			.then((module) => {
				const Search = module.default;
				new Search().init(); // fire manually because async
			})
			.catch((error) => console.log(error));
	}

	// Menu
	if (document.querySelectorAll('.navigation__item.has-children').length > 0) {
		import(/* webpackChunkName: "menu" */'./components/menu')
			.then((module) => {
				const Menu = module.default;
				new Menu().init(); // fire manually because async
			})
			.catch((error) => console.log(error));
	}

	// Cart
	if (document.querySelectorAll('.minicart').length > 0) {
		import(/* webpackChunkName: "cart" */'./components/cart')
			.then((module) => {
				const Cart = module.default;
				new Cart().init(); // fire manually because async
			})
			.catch((error) => console.log(error));
	}

	// ScrollDirection
	import(/* webpackChunkName: "scrollDirection" */'./components/scrollDirection')
		.then((module) => {
			const ScrollDirection = module.default;
			new ScrollDirection().initEvents(); // fire manually because async
		})
		.catch((error) => console.log(error));
	
	// WidgetAccordion
	if (document.querySelectorAll('.woocommerce-widget-layered-nav').length > 0) {
		import(/* webpackChunkName: "widgetAccordion" */'./components/widgetAccordion')
			.then((module) => {
				const WidgetAccordion = module.default;
				new WidgetAccordion().initEvents(); // fire manually because async
			})
			.catch((error) => console.log(error));
	}

	if(document.getElementById('billing_invoice')){
		import(/* webpackChunkName: "billing" */'./components/billing')
			.then((module) => {
				const Billing = module.default;
				new Billing().init(); // fire manually because async
			})
			.catch((error) => console.log(error));
	}
	

});