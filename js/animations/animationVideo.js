/* eslint-disable no-unused-vars */
import { initObserver } from '../utilities/observer';
import deepmerge from 'deepmerge';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationVideo {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || '[data-scroll]';
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
			if (element.dataset.scroll === 'js-video') {
				this.animationVideo(element);
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
			if (element.dataset.scroll === 'js-video') {
				this.animationVideo(element);
			}
		}, 1000);
	}

	/**
	 * video Animation
	 */
	animationVideo(item) {
		const targetVideo = item.querySelector('[data-scroll-target]');

		gsap.timeline({
			scrollTrigger: {
				trigger: item,
				start: 'top bottom',
				end: 'bottom top',
				markers: false,
				onEnter: () => targetVideo.play(),
				onLeave: () => {
					targetVideo.pause();
					targetVideo.currentTime = 0;
				},
				onEnterBack: () => targetVideo.play(),
				onLeaveBack: () => {
					targetVideo.pause();
					targetVideo.currentTime = 0;
				}
			}
		});
	}

}
