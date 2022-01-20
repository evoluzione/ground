/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import deepmerge from 'deepmerge';
import { initObserver } from '../utilities/observer';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationComparison extends AnimationDefault {

	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-comparison"]';;
	}

	fireAnimation(item) {
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
