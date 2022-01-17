/* eslint-disable no-unused-vars */
import deepmerge from 'deepmerge';
import { initObserver } from '../utilities/observer';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationHorizontalScroll {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || '[data-scroll="js-horizontal-scroll"]';
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
		// TODO: js pin non funziona
		gsap.utils.toArray(triggers).forEach((element) => {
			this.animationHorizontalScroll(element);
		});
	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();

		setTimeout(() => {
			this.animationHorizontalScroll(element);
		}, 1000);
	}

	/**
	 * default Animation
	 */
	animationDefault(item) {
		const targetClass = item.dataset.scroll;

		ScrollTrigger.create({
			trigger: item,
			start: 'top 100%',
			toggleClass: targetClass,
			toggleActions: 'play none none none'
			// markers: true,
			// once: true,
		});
	}


	/**
	 * pin Horizontal Animation
	 */
	animationHorizontalScroll(item) {
		const target = item.querySelector('[data-scroll-target]');
		const targetContainer = item.querySelector('[data-scroll-target-animate]');
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		gsap.to(targetContainer, {
			x: () => -targetContainer.getBoundingClientRect().width + target.getBoundingClientRect().width,
			ease: 'none',
			scrollTrigger: {
				trigger: target,
				invalidateOnRefresh: true,
				start: 'center center',
				end: () => '+=' + targetContainer.offsetWidth,
				pin: true,
				pinReparent: true,
				anticipatePin: 1,
				scrub: targetScrub || false
			}
		});
	}

}
