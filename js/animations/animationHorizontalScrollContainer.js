/* eslint-disable no-unused-vars */
import deepmerge from 'deepmerge';
import { initObserver } from '../utilities/observer';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationHorizontalScrollContainer {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || '[data-scroll="js-horizontal-scroll-container"]';
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
			this.animationHorizontalScrollContainer(element);
		});
	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();

		setTimeout(() => {
			this.animationHorizontalScrollContainer(element);
		}, 1000);
	}

	/**
	 * pin Horizontal Container Animation
	 */
	animationHorizontalScrollContainer(item) {
		const target = item.querySelector('[data-scroll-target]');
		const panel = item.querySelectorAll('[data-scroll-panel]');
		const targetScrub = item.dataset.scrollScrub;

		console.log(targetScrub);

		let sections = gsap.utils.toArray(panel);

		let scrollTween = gsap.to(sections, {
			xPercent: -100 * (sections.length - 1),
			ease: 'none', // <-- IMPORTANT!
			scrollTrigger: {
				trigger: target,
				pin: true,
				scrub: targetScrub || false,
				//snap: directionalSnap(1 / (sections.length - 1)),
				end: '+=3000'
			}
		});

		gsap.to('.js-box-1', {
			y: -130,
			duration: 2,
			ease: 'elastic',
			scrollTrigger: {
				trigger: '.js-box-1',
				containerAnimation: scrollTween,
				start: 'left center',
				toggleActions: 'play none play reverse'
				// markers: true,
			}
		});

		gsap.to('.js-box-2', {
			y: 320,
			backgroundColor: 'red',
			ease: 'none',
			scrollTrigger: {
				trigger: '.js-box-2',
				containerAnimation: scrollTween,
				start: 'center 80%',
				end: 'center 20%',
				scrub: 2
				// markers: true
			}
		});
	}
}
