/* eslint-disable no-unused-vars */
import { initObserver } from '../utilities/observer';
import { gsap } from 'gsap';

export default class HandleAnimation {

	// List all the Classes we can add dynamically
	AnimationSplitText;
	AnimationRotation;
	AnimationPin;
	AnimationComparison;
	AnimationDefault;
	AnimationBatch;
	AnimationScale;
	AnimationDraw;
	AnimationBgColor;
	AnimationSpriteImages;
	AnimationHorizontalScroll;
	AnimationHorizontalScrollContainer;
	AnimationHorizontalScrollSection;
	AnimationParallax;
	AnimationVideo;

	/**
	 * @type {string[]}
	 */
	animationToActivate = [];

	/**
	 * @type {promise[]}
	 */
	promiseList = [];
	hasCssAnimation = false;
	triggers = '[data-scroll]';

	constructor() {
		this.initEvents();
	}

	/**
	 * Init events to run animations
	 * @param {*} triggers
	 */
	initEvents() {
		this.getAnimationToActivate(this.triggers);
		this.populatePromiseList();
		this.resolveAllPromise(this.triggers);
		initObserver('[data-scroll]', this.updateEvents);
	}

	/**
	 * Get all animations we need in array
	 * @param {string} triggers
	 */
	getAnimationToActivate(triggers) {

		gsap.utils.toArray(triggers).forEach((element) => {
			const dataAttribute = element.dataset.scroll;

			const isInArray = this.animationToActivate.includes(dataAttribute);
			if (isInArray) return;

			if (!this.hasCssAnimation && dataAttribute.substring(0, 2) !== 'js') {
				this.hasCssAnimation = true;
			}

			this.animationToActivate.push(dataAttribute);
		});

		// console.log(this.animationToActivate);
		// console.log(this.hasCssAnimation);

	}

	/**
	 * Create an array of promises to import partials
	 */
	populatePromiseList() {

		if (this.animationToActivate.includes('js-split-text')) {
			const promise = import(/* webpackChunkName: "ground-animationSplitText" */'./animationSplitText')
				.then((module) => {
					this.AnimationSplitText = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)
		}

		if (this.animationToActivate.includes('js-rotation')) {
			const promise = import(/* webpackChunkName: "ground-animationRotation" */'./animationRotation')
				.then((module) => {
					this.AnimationRotation = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)
		}

		if (this.animationToActivate.includes('js-pin')) {
			const promise = import(/* webpackChunkName: "ground-animationPin" */'./animationPin')
				.then((module) => {
					this.AnimationPin = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)
		}

		if (this.animationToActivate.includes('js-comparison')) {
			const promise = import(/* webpackChunkName: "ground-animationComparison" */'./animationComparison')
				.then((module) => {
					this.AnimationComparison = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)
		}

		if (this.animationToActivate.includes('js-batch')) {
			const promise = import(/* webpackChunkName: "ground-animationBatch" */'./animationBatch')
				.then((module) => {
					this.AnimationBatch = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)

		}

		if (this.animationToActivate.includes('js-scale')) {
			const promise = import(/* webpackChunkName: "ground-animationScale" */'./animationScale')
				.then((module) => {
					this.AnimationScale = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)
		}

		if (this.animationToActivate.includes('js-draw')) {
			const promise = import(/* webpackChunkName: "ground-animationDraw" */'./animationDraw')
				.then((module) => {
					this.AnimationDraw = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise);
		}

		if (this.animationToActivate.includes('js-bg-color')) {
			const promise = import(/* webpackChunkName: "ground-animationBgColor" */'./animationBgColor')
				.then((module) => {
					this.AnimationBgColor = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise);
		}

		if (this.animationToActivate.includes('js-sprite-images')) {
			const promise = import(/* webpackChunkName: "ground-animationSpriteImages" */'./animationSpriteImages')
				.then((module) => {
					this.AnimationSpriteImages = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise);
		}

		if (this.animationToActivate.includes('js-horizontal-scroll')) {
			const promise = import(/* webpackChunkName: "ground-animationHorizontalScroll" */'./animationHorizontalScroll')
				.then((module) => {
					this.AnimationHorizontalScroll = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise);
		}

		if (this.animationToActivate.includes('js-horizontal-scroll-container')) {
			const promise = import(/* webpackChunkName: "ground-animationHorizontalScrollContainer" */'./animationHorizontalScrollContainer')
				.then((module) => {
					this.AnimationHorizontalScrollContainer = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise);
		}

		if (this.animationToActivate.includes('js-horizontal-scroll-section')) {
			const promise = import(/* webpackChunkName: "ground-animationHorizontalScrollSection" */'./animationHorizontalScrollSection')
				.then((module) => {
					this.AnimationHorizontalScrollSection = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise);
		}

		if (this.animationToActivate.includes('js-parallax')) {
			const promise = import(/* webpackChunkName: "ground-animationParallax" */'./animationParallax')
				.then((module) => {
					this.AnimationParallax = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise);
		}

		if (this.animationToActivate.includes('js-video')) {
			const promise = import(/* webpackChunkName: "ground-animationVideo" */'./animationVideo')
				.then((module) => {
					this.AnimationVideo = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise);
		}

		if (this.hasCssAnimation) {
			const promise = import(/* webpackChunkName: "ground-animationDefault" */'./animationDefault')
				.then((module) => {
					this.AnimationDefault = module.default;
					return module.default.name;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)
		}

	}

	/**
	 * Resolve all promises and then fire animation instances
	 * @param {string} triggers
	 */
	resolveAllPromise(triggers) {
		// Once all promises are resolved
		Promise.all(this.promiseList).then(res => {
			// console.log(res);
			this.fireAnimations(triggers)
		});
	}

	/**
	 * Loop the nodes to activate correct animation
	 * @param {object} triggers
	 */
	fireAnimations(triggers) {
		gsap.utils.toArray(triggers).forEach((element) => {
			// console.log(element);
			this.getAnimation(element);
		});
	}

	/**
	 * Select the correct animation to fire
	 * @param {any} element
	 */
	getAnimation(element) {

		switch (element.dataset.scroll) {

			case 'js-split-text':
				new this.AnimationSplitText(element);
				break;

			case 'js-rotation':
				new this.AnimationRotation(element);
				break;

			case 'js-batch':
				new this.AnimationBatch(element);
				break;

			case 'js-scale':
				new this.AnimationScale(element);
				break;

			case 'js-draw':
				new this.AnimationDraw(element);
				break;

			case 'js-bg-color':
				new this.AnimationBgColor(element);
				break;

			case 'js-pin':
				new this.AnimationPin(element);
				break;

			case 'js-sprite-images':
				new this.AnimationSpriteImages(element);
				break;

			case 'js-horizontal-scroll':
				new this.AnimationHorizontalScroll(element);
				break;

			case 'js-horizontal-scroll-container':
				new this.AnimationHorizontalScrollContainer(element);
				break;

			case 'js-horizontal-scroll-section':
				new this.AnimationHorizontalScrollSection(element);
				break;

			case 'js-comparison':
				new this.AnimationComparison(element);
				break;

			case 'js-parallax':
				new this.AnimationParallax(element);
				break;

			case 'js-video':
				new this.AnimationVideo(element);
				break;

			default:
				new this.AnimationDefault(element);
				break;
		}

	}
}
