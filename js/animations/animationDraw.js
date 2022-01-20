/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import { gsap } from 'gsap';
import { ScrollTrigger, DrawSVGPlugin } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger, DrawSVGPlugin);

export default class AnimationDraw extends AnimationDefault{
	
	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-draw"]';
	}

	fireAnimation(item) {
		const target = item.querySelectorAll('path');
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: item,
				scrub: targetScrub || false,
				toggleActions: 'play none none none'
			}
		});

		tl.from(target, {
			drawSVG: 0
		});
	}
}
