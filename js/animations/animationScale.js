/* eslint-disable no-unused-vars */
import { initObserver } from '../utilities/observer';
// import { getTemplateUrl } from '../utilities/paths';
import deepmerge from 'deepmerge';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationScale {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || '[data-scroll="js-scale"]';
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
			this.animationScale(element);
		});
	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();
		setTimeout(() => {
			this.animationScale(element);
		}, 1000);
	}

	/**
	 * scale Animation
	 */
	animationScale(item) {
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: item,
				start: 'top 100%',
				end: 'bottom 0%',
				scrub: targetScrub || false,
				toggleActions: 'play none play reverse'
			}
		});

		tl.to(item, {
			scale: 1.5
		});
	}
}
