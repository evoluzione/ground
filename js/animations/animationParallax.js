/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationParallax extends AnimationDefault {
	
	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-parallax"]';
	}

	fireAnimation(item) {
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: item,
				toggleActions: 'play pause none none',
				scrub: targetScrub || 2
			}
		});

		tl.to(item, {
			y: -item.dataset.scrollSpeedY * 100 || 0,
			x: -item.dataset.scrollSpeedX * 100 || 0
		});
	}

}
