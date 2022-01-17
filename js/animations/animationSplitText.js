/* eslint-disable no-unused-vars */
import { initObserver } from '../utilities/observer';
// import { getTemplateUrl } from '../utilities/paths';
import deepmerge from 'deepmerge';
import { gsap } from 'gsap';
import { SplitText, ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger, SplitText);

export default class AnimationSplitText {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || '[data-scroll="js-split-text"]';
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

		//  window.addEventListener('LOADER_COMPLETE', () => {
			this.init();
			this.initEvents(this.options.triggers);
			initObserver(this.options.triggers, this.updateEvents);
		//  });
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
			if (element.dataset.scroll === 'js-split-text') {
				this.animationSplitText(element);
			}  else {
				this.animationDefault(target);
			}
		});
	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();
		setTimeout(() => {
			if (element.dataset.scroll === 'js-split-text') {
				this.animationSplitText(element);
			}  else {
				this.animationDefault(target);
			}
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
	 * splitText Animation
	 */
	animationSplitText(item) {
		gsap.set(item, { autoAlpha: 1 });
		const targetSplitBy = item.dataset.scrollSplittext;
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: item,
				start: 'top 90%',
				end: 'bottom 60%',
				scrub: targetScrub || false,
				// markers: true,
				toggleActions: 'play none play reset'
			}
		});

		if (targetSplitBy === 'chars') {
			const itemSplitted = new SplitText(item, { type: 'chars' });
			tl.from(itemSplitted.chars, {
				yPercent: 100,
				opacity: 0,
				stagger: 0.05,
				duration: 0.5,
				ease: 'back.inOut'
			});
		}

		if (targetSplitBy === 'words') {
			const itemSplitted = new SplitText(item, { type: 'words' });
			tl.from(itemSplitted.words, {
				yPercent: 100,
				opacity: 0,
				stagger: 0.05,
				duration: 0.5,
				ease: 'back.inOut'
			});
		}

		if (targetSplitBy === 'lines') {
			const itemSplitted = new SplitText(item, { type: 'lines' });
			tl.from(itemSplitted.lines, { y: 20, opacity: 0, stagger: 0.01, duration: 0.01, ease: 'back.inOut' });
		}
	}
}
