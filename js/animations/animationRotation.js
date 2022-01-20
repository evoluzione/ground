/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import { gsap } from 'gsap';
export default class AnimationRotation extends AnimationDefault {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		
		super(element, options);
		this.element = element || '[data-scroll="js-rotation"]';
	}

	/**
	 * rotation Animation
	 */
	fireAnimation(item) {
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: item,
				start: 'top 90%',
				end: 'bottom 80%',
				scrub: targetScrub || false,
				toggleActions: 'play none play reverse'
			}
		});

		tl.from(item, {
			x: 400,
			rotation: 360
		});
	}

}
