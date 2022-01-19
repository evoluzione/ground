/* eslint-disable no-unused-vars */
import deepmerge from 'deepmerge';
import { initObserver } from '../utilities/observer';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationComparison {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || '[data-scroll="js-comparison"]';;
		this.defaults = {
			triggers: this.element
		};
		this.DOM = {
			html: document.documentElement,
			body: document.body
		};
		this.options = options ? deepmerge(this.defaults, options) : this.defaults;
		this.updateEvents = this.updateEvents.bind(this);

		// window.addEventListener('LOADER_COMPLETE', () => {
			this.init();
			this.initEvents(this.options.triggers);
			initObserver(this.options.triggers, this.updateEvents);
		// });
	}

	/**
	 * Init
	 */
	init() {
		this.DOM.element = document.querySelectorAll(this.element);
	}

	/**
	 * Initialize events
	 * @param {string} triggers - Selectors
	 */
	initEvents(triggers) {
		gsap.utils.toArray(triggers).forEach((element) => {
			this.animationComparison(element);
		});
	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();

		setTimeout(() => {
			this.animationComparison(target);
		}, 1000);
	}

	/**
	 * comparison Animation
	 */
	animationComparison(item) {
		const target = item.querySelector('[data-scroll-target]');
		const targetMedia = item.querySelectorAll('[data-scroll-target-media]');
		const targetImage = item.querySelectorAll('[data-scroll-target-media] img');
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: target,
				start: 'center center',
				end: () => `+=${target.offsetWidth}`,
				scrub: targetScrub || false,
				pin: true
			},
			defaults: { ease: 'none' }
		});

		tl.fromTo(targetMedia, { xPercent: 100, x: 0 }, { xPercent: 0 }).fromTo(
			targetImage,
			{ xPercent: -100, x: 0 },
			{ xPercent: 0 },
			0
		);
	}
}
