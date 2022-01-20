/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationHorizontalScroll extends AnimationDefault {
	
	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-horizontal-scroll"]';
	}

	fireAnimation(item) {
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
				scrub: targetScrub || false
			}
		});
	}

}
