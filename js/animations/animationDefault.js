/* eslint-disable no-unused-vars */
// import { initObserver } from '../utilities/observer';
// import { getTemplateUrl } from '../utilities/paths';
import deepmerge from 'deepmerge';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationDefault {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element;
		this.defaults = {
			triggers: this.element
		};
		this.DOM = {
			html: document.documentElement,
			body: document.body
		};
		this.options = options ? deepmerge(this.defaults, options) : this.defaults;
		// this.updateEvents = this.updateEvents.bind(this);

		//  window.addEventListener('LOADER_COMPLETE', () => {
		this.init();
		this.initEvents(this.options.triggers);
		// initObserver(this.options.triggers, this.updateEvents);
		//  });
	}

	/**
	 * Init
	 */
	init() {
		this.DOM.element = this.element;
	}

	/**
	 * Initialize events
	 * @param {string} triggers - Selectors
	 */
	initEvents(triggers) {
		this.fireAnimation(triggers);

		// gsap.utils.toArray(triggers).forEach((element) => {
		// 	if (element.dataset.scroll === 'js-split-text') {
		// 	}  else {
		// 		this.animationDefault(target);
		// 	}
		// });
	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();
		setTimeout(() => {
			this.fireAnimation(target);
		}, 1000);
	}

	/**
	 * Fire the animation
	 * @param {node} item 
	 */
	fireAnimation(item) {

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
}
