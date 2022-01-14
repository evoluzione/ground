/* eslint-disable no-unused-vars */
// import { gsap } from 'gsap';
// import InfiniteScroll from './components/infiniteScroll';
// import Modal from './components/modal';
// import AjaxNavigation from './components/ajaxNavigation';
import Slider from './components/slider';
import Loader from './components/loader';
// import Toggle from './components/toggle';
import Menu from './components/menu';
import Cart from './components/cart';
// import Cursor from './components/cursorV2';
import Search from './components/search';
// import Magnet from './components/magnetV2';
import Billing from './components/billing';
import GdprCompliance from './components/gdprCompliance';
import ScrollDirection from './components/scrollDirection';
import WidgetAccordion from './components/widgetAccordion';

// Animations
// import AnimationAll from './animations/animationAll';
import AnimationsFlip from './animations/animationsFlip';
// import AnimationBatch from './animations/animationBatch'
// import AnimationChangeBgColor from './animations/animationChangeBgColor'
// import AnimationComparison from './animations/animationComparison'
// import AnimationDraw from './animations/animationDraw'
// import AnimationHorizontalScroll from './animations/animationHorizontalScroll'
// import AnimationHorizontalScrollSection from './animations/animationHorizontalScrollSection'
// import AnimationParallax from './animations/animationParallax'
// import AnimationPin from './animations/animationPin'
// import AnimationRotation from './animations/animationRotation'
// import AnimationScale from './animations/animationScale'
// import AnimationSplitText from './animations/animationSplitText'
// import AnimationSpriteImages from './animations/animationSpriteImages'
// import AnimationVideo from './animations/animationVideo'
// import AnimationWebGl from './animations/animationWebGl';
// import AnimationDefault from './animations/animationDefault'

// const infiniteScroll = new InfiniteScroll();
const loader = new Loader();
// const modal = new Modal();
// const ajaxNavigation = new AjaxNavigation();
const sliderPrimary = new Slider('.js-slider-primary');
// const toggle = new Toggle();
const billing = new Billing();
const menu = new Menu();
const cart = new Cart();
//const cursor = new Cursor();
const search = new Search();
// const magnet = new Magnet();
const gdprCompliance = new GdprCompliance();
const scrollDirection = new ScrollDirection();
const widgetAccordion = new WidgetAccordion();

// Animations
// const animationBatch = new AnimationBatch()
// const animationChangeBgColor = new AnimationChangeBgColor()
// const animationComparison = new AnimationComparison()
// const animationDraw = new AnimationDraw()
// const animationHorizontalScroll = new AnimationHorizontalScroll()
// const animationHorizontalScrollSection = new AnimationHorizontalScrollSection()
// const animationParallax = new AnimationParallax()
// const animationRotation = new AnimationRotation()
// const animationScale = new AnimationScale()
// const animationSpriteImages = new AnimationSpriteImages()
// const animationVideo = new AnimationVideo()
// const animationWebGl = new AnimationWebGl();
// const animationSplitText = new AnimationSplitText()
// const animationPin = new AnimationPin()
// const animationDefault = new AnimationDefault()
// const animationAll = new AnimationAll();
const animationsFlip = new AnimationsFlip();

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
	// on: {
	// 	touchStart() {
	// 		const swiper = this;
	// 		for (let i = 0; i < swiper.slides.length; i++) {
	// 			gsap.to(swiper.slides[i], {
	// 				duration: 0.6,
	// 				ease: 'circ.out',
	// 				scale: 0.9
	// 			});
	// 			gsap.to(swiper.slides[i].querySelector('.carousel__media'), {
	// 				duration: 2,
	// 				ease: 'circ.out',
	// 				scale: 1.2
	// 			});
	// 		}
	// 	},
	// 	touchEnd() {
	// 		const swiper = this;
	// 		for (let i = 0; i < swiper.slides.length; i++) {
	// 			gsap.to(swiper.slides[i], {
	// 				duration: 0.2,
	// 				ease: 'circ.out',
	// 				scale: 1
	// 			});
	// 			gsap.to(swiper.slides[i].querySelector('.carousel__media'), {
	// 				duration: 0.2,
	// 				ease: 'circ.out',
	// 				scale: 1
	// 			});
	// 		}
	// 	}
	// }
});

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
});

