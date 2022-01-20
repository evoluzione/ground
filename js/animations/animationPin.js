/* eslint-disable no-unused-vars */
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';
import AnimationDefault from './animationDefault';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationPin extends AnimationDefault {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-pin"]';
	}

	fireAnimation(item) {
		const target = item.querySelectorAll('[data-scroll-target]');
		const targetElement = item.querySelectorAll('[data-scroll-target-animate]');
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: target,
				start: 'center center',
				// end: '+=200%',
				// toggleClass: 'active',
				scrub: targetScrub || false,
				pin: true
			}
		});

		tl.from(targetElement, {
			scale: 0.6,
			transformOrigin: 'center center'
		});
	}

}
