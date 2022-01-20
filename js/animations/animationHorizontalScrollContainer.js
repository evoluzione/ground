/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationHorizontalScrollContainer extends AnimationDefault {
	
	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-horizontal-scroll-container"]';
	}

	fireAnimation(item) {
		const target = item.querySelector('[data-scroll-target]');
		const panel = item.querySelectorAll('[data-scroll-panel]');
		const targetScrub = item.dataset.scrollScrub;

		console.log(targetScrub);

		let sections = gsap.utils.toArray(panel);

		let scrollTween = gsap.to(sections, {
			xPercent: -100 * (sections.length - 1),
			ease: 'none', // <-- IMPORTANT!
			scrollTrigger: {
				trigger: target,
				pin: true,
				scrub: targetScrub || false,
				//snap: directionalSnap(1 / (sections.length - 1)),
				end: '+=3000'
			}
		});

		gsap.to('.js-box-1', {
			y: -130,
			duration: 2,
			ease: 'elastic',
			scrollTrigger: {
				trigger: '.js-box-1',
				containerAnimation: scrollTween,
				start: 'left center',
				toggleActions: 'play none play reverse'
				// markers: true,
			}
		});

		gsap.to('.js-box-2', {
			y: 320,
			backgroundColor: 'red',
			ease: 'none',
			scrollTrigger: {
				trigger: '.js-box-2',
				containerAnimation: scrollTween,
				start: 'center 80%',
				end: 'center 20%',
				scrub: 2
				// markers: true
			}
		});
	}
}
