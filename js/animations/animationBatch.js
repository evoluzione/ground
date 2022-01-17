/* eslint-disable no-unused-vars */
import deepmerge from 'deepmerge';
import { initObserver } from '../utilities/observer';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationBatch {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
	
		this.element = element || '[data-scroll="js-batch"]';
		this.defaults = {
			triggers: this.element
		};
		this.DOM = {
			html: document.documentElement,
			body: document.body
		};
		this.options = options ? deepmerge(this.defaults, options) : this.defaults;
		this.updateEvents = this.updateEvents.bind(this);

		window.addEventListener('DOMContentLoaded', () => {});

		ScrollTrigger.addEventListener('scrollStart', () => {});

		ScrollTrigger.addEventListener('scrollEnd', () => {});

		ScrollTrigger.addEventListener('refreshInit', () => {});

		ScrollTrigger.addEventListener('refresh', () => {});

		window.addEventListener('NAVIGATE_OUT', () => {
			// ScrollTrigger.update();
			// ScrollTrigger.refresh();
		});

		window.addEventListener('resize', () => {
			// ScrollTrigger.update();
			// ScrollTrigger.refresh();
		});

		window.addEventListener('NAVIGATE_IN', () => {});

		window.addEventListener('NAVIGATE_END', () => {});

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
		// ScrollTrigger.defaults({
		// 	markers: false,
		// 	ease: 'power3',
		// })

		gsap.utils.toArray(triggers).forEach((element) => {
			this.animationBatch(element);
		});
	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();
		setTimeout(() => {
			this.animationBatch(element);
		}, 1000);
	}

	/**
	 * batch Animation
	 */
	animationBatch(item) {
		const target = item.querySelectorAll('[data-scroll-target]');

		// gsap.set(target, { y: 100, opacity: 0 });

		ScrollTrigger.batch(target, {
			interval: 0.1, // time window (in seconds) for batching to occur.
			batchMax: 3, // maximum batch size (targets)
			onEnter: (batch) => gsap.to(batch, { autoAlpha: 1, stagger: 0.1, overwrite: true }),
			onLeave: (batch) => gsap.set(batch, { autoAlpha: 0, overwrite: true }),
			onEnterBack: (batch) => gsap.to(batch, { autoAlpha: 1, stagger: 0.1, overwrite: true }),
			onLeaveBack: (batch) => gsap.set(batch, { autoAlpha: 0, overwrite: true })
		});

		// ScrollTrigger.addEventListener('refreshInit', () =>
		// 	gsap.set(target, { y: 0 })
		// )
	}
}
