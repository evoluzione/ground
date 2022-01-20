/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationBatch extends AnimationDefault {
	
	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-batch"]';
	}

	fireAnimation(item) {
		const target = item.querySelectorAll('[data-scroll-target]');

		// gsap.set(target, { y: 100, opacity: 0 });

		ScrollTrigger.batch(target, {
			interval: 0.3, // time window (in seconds) for batching to occur.
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
