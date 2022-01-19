/* eslint-disable no-unused-vars */
import { elementExist } from './utilities/selector';
import isMobile from 'ismobilejs';

window.addEventListener('DOMContentLoaded', () => {

	// Cursor
	if (elementExist('.js-cursor') && !isMobile().any) {
		import(/* webpackChunkName: "cursor" */'./components/cursorV2')
			.then((module) => {
				const Cursor = module.default;
				new Cursor();
			})
			.catch((error) => console.log(error));
	}

	// Modal - TODO
	if (elementExist('[data-modal]')) {
		import(/* webpackChunkName: "modal" */'./components/modal')
			.then((module) => {
				const Modal = module.default;
				new Modal();
			})
			.catch((error) => console.log(error));
	}

	// Toggle
	if (elementExist('.js-toggle')) {
		import(/* webpackChunkName: "toggle" */'./components/toggle')
			.then((module) => {
				const Toggle = module.default;
				new Toggle;
			})
			.catch((error) => console.log(error));
	}

	// Magnet
	if (elementExist('.js-magnet')) {
		import(/* webpackChunkName: "magnet" */'./components/magnetV2')
			.then((module) => {
				const Magnet = module.default;
				new Magnet();
			})
			.catch((error) => console.log(error));
	}

	// Animations
	if (elementExist('[data-scroll]')) {
		import(/* webpackChunkName: "handleAnimation" */'./animations/handleAnimation')
			.then((module) => {
				const HandleAnimation = module.default;
				new HandleAnimation();
			})
			.catch((error) => console.log(error));
	}

	// AnimationFlip
	if (elementExist('[data-flip]')) {
		import(/* webpackChunkName: "animationFlip" */'./animations/animationFlip')
			.then((module) => {
				const AnimationFlip = module.default;
				new AnimationFlip();
			})
			.catch((error) => console.log(error));
	}

	// // animationBatch
	// if (elementExist('[data-scroll="js-batch"]')) {
	// 	import(/* webpackChunkName: "animationBatch" */'./animations/animationBatch')
	// 		.then((module) => {
	// 			const AnimationBatch = module.default;
	// 			new AnimationBatch();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationScale
	// if (elementExist('[data-scroll="js-scale"]')) {
	// 	import(/* webpackChunkName: "animationScale" */'./animations/animationScale')
	// 		.then((module) => {
	// 			const AnimationScale = module.default;
	// 			new AnimationScale();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationDraw
	// if (elementExist('[data-scroll="js-draw"]')) {
	// 	import(/* webpackChunkName: "animationDraw" */'./animations/animationDraw')
	// 		.then((module) => {
	// 			const AnimationDraw = module.default;
	// 			new AnimationDraw();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationBgColor
	// if (elementExist('[data-scroll="js-bg-color"]')) {
	// 	import(/* webpackChunkName: "animationBgColor" */'./animations/animationBgColor')
	// 		.then((module) => {
	// 			const AnimationBgColor = module.default;
	// 			new AnimationBgColor();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationPin
	// if (elementExist('[data-scroll="js-pin"]')) {
	// 	import(/* webpackChunkName: "animationPin" */'./animations/animationPin')
	// 		.then((module) => {
	// 			const AnimationPin = module.default;
	// 			new AnimationPin();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationSpriteImages
	// if (elementExist('[data-scroll="js-sprite-images"]')) {
	// 	import(/* webpackChunkName: "animationSpriteImages" */'./animations/animationSpriteImages')
	// 		.then((module) => {
	// 			const AnimationSpriteImages = module.default;
	// 			new AnimationSpriteImages();
	// 		})
	// 		.catch((error) => console.log(error));
	// }
	
	// // animationHorizontalScroll
	// if (elementExist('[data-scroll="js-horizontal-scroll"]')) {
	// 	import(/* webpackChunkName: "animationHorizontalScroll" */'./animations/animationHorizontalScroll')
	// 		.then((module) => {
	// 			const AnimationHorizontalScroll = module.default;
	// 			new AnimationHorizontalScroll();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationHorizontalScrollContainer
	// if (elementExist('[data-scroll="js-horizontal-scroll-container"]')) {
	// 	import(/* webpackChunkName: "animationHorizontalScrollContainer" */'./animations/animationHorizontalScrollContainer')
	// 		.then((module) => {
	// 			const AnimationHorizontalScrollContainer = module.default;
	// 			new AnimationHorizontalScrollContainer();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationHorizontalScrollSection
	// if (elementExist('[data-scroll="js-horizontal-scroll-section"]')) {
	// 	import(/* webpackChunkName: "animationHorizontalScrollSection" */'./animations/animationHorizontalScrollSection')
	// 		.then((module) => {
	// 			const AnimationHorizontalScrollSection = module.default;
	// 			new AnimationHorizontalScrollSection();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationComparison
	// if (elementExist('[data-scroll="js-comparison"]')) {
	// 	import(/* webpackChunkName: "animationComparison" */'./animations/animationComparison')
	// 		.then((module) => {
	// 			const AnimationComparison = module.default;
	// 			new AnimationComparison();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationParallax
	// if (elementExist('[data-scroll="js-parallax"]')) {
	// 	import(/* webpackChunkName: "animationParallax" */'./animations/animationParallax')
	// 		.then((module) => {
	// 			const AnimationParallax = module.default;
	// 			new AnimationParallax();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	// // animationVideo
	// if (elementExist('[data-scroll="js-video"]')) {
	// 	import(/* webpackChunkName: "animationVideo" */'./animations/animationVideo')
	// 		.then((module) => {
	// 			const AnimationVideo = module.default;
	// 			new AnimationVideo();
	// 		})
	// 		.catch((error) => console.log(error));
	// }

	

	// Slider
	if (
		elementExist('.js-slider-primary')
		|| elementExist('.js-slider')
		|| elementExist('.js-carousel')
		|| elementExist('.js-slider-gallery')
	) {
		import(/* webpackChunkName: "slider" */'./components/slider')
			.then((module) => {
				const Slider = module.default;

				if(elementExist('.js-slider')) {
					new Slider;
				}

				if (elementExist('.js-slider-primary')) {
					new Slider('.js-slider-primary')
				}

				if (elementExist('.js-carousel')) {

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

	// Search
	if (elementExist('#js-ajax-search')) {
		import(/* webpackChunkName: "search" */'./components/search')
			.then((module) => {
				const Search = module.default;
				new Search();
			})
			.catch((error) => console.log(error));
	}

	// Menu
	if (elementExist('.navigation__item.has-children')) {
		import(/* webpackChunkName: "menu" */'./components/menu')
			.then((module) => {
				const Menu = module.default;
				new Menu();
			})
			.catch((error) => console.log(error));
	}

	// Cart
	if (elementExist('.minicart')) {
		import(/* webpackChunkName: "cart" */'./components/cart')
			.then((module) => {
				const Cart = module.default;
				new Cart();
			})
			.catch((error) => console.log(error));
	}

	// ScrollDirection
	if(!isMobile().any){
		import(/* webpackChunkName: "scrollDirection" */'./components/scrollDirection')
			.then((module) => {
				const ScrollDirection = module.default;
				new ScrollDirection();
			})
	}
	
	// WidgetAccordion
	if (elementExist('.woocommerce-widget-layered-nav')) {
		import(/* webpackChunkName: "widgetAccordion" */'./components/widgetAccordion')
			.then((module) => {
				const WidgetAccordion = module.default;
				new WidgetAccordion();
			})
			.catch((error) => console.log(error));
	}

	// Billing Invoices
	if(elementExist('#billing_invoice')){
		import(/* webpackChunkName: "billing" */'./components/billing')
			.then((module) => {
				const Billing = module.default;
				new Billing();
			})
			.catch((error) => console.log(error));
	}

	// JS Loader
	if(elementExist('#js-loader')){
		import(/* webpackChunkName: "loader" */'./components/loader')
			.then((module) => {
				const Loader = module.default;
				new Loader();
			})
			.catch((error) => console.log(error));
	}

	// InfiniteScroll
	if (elementExist('.js-infinite-container')) {
		import(/* webpackChunkName: "infiniteScroll" */'./components/infiniteScroll')
			.then((module) => {
				const InfiniteScroll = module.default;
				new InfiniteScroll();
			})
			.catch((error) => console.log(error));
	}

	// YoastFaqBlock
	
	if (elementExist('.schema-faq-question')) {
		import(/* webpackChunkName: "yoastFaqBlock" */'./components/yoastFaqBlock')
			.then((module) => {
				const YoastFaqBlock = module.default;
				new YoastFaqBlock();
			})
			.catch((error) => console.log(error));
	}

});