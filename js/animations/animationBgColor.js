/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationBgColor extends AnimationDefault {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-bg-color"]';
	}

	fireAnimation(item) {
		const target = document.body;
		const targetColor = item.dataset.scrollBgcolor;

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: item,
				scrub: 1,
				toggleActions: 'play reset play reset'
			}
		});

		tl.to(target, {
			backgroundColor: targetColor,
			ease: 'power1'
		});
	}

}
