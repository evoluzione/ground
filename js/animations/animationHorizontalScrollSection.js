/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationHorizontalScrollSection extends AnimationDefault {
	

	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-horizontal-scroll-section"]';
	}

	fireAnimation(item) {
		const target = item.querySelector('[data-scroll-target]');
		const section = item.querySelectorAll('[data-scroll-section]');
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		const sections = gsap.utils.toArray(section);

		let maxWidth = 0;

		const getMaxWidth = () => {
			maxWidth = 0;
			sections.forEach((section) => {
				maxWidth += section.offsetWidth;
			});
		};
		getMaxWidth();
		ScrollTrigger.addEventListener('refreshInit', getMaxWidth);

		gsap.to(sections, {
			x: () => `-${maxWidth - window.innerWidth}`,
			ease: 'none',
			scrollTrigger: {
				trigger: target,
				pin: true,
				scrub: targetScrub || false,
				start: 'center center',
				end: () => `+=${maxWidth}`,
				invalidateOnRefresh: true
			}
		});

		// ADD SKEW
		// let proxy = { skew: 0 },
		// 	skewSetter = gsap.quickSetter(section, 'skewX', 'deg'), // fast
		// 	clamp = gsap.utils.clamp(-10, 10) // don't let the skew go beyond [X] degrees.
		// END SKEW

		sections.forEach((sct, i) => {
			ScrollTrigger.create({
				trigger: sct,
				start: () =>
					'top top-=' +
					(sct.offsetLeft - window.innerWidth / 2) * (maxWidth / (maxWidth - window.innerWidth)),
				end: () => '+=' + sct.offsetWidth * (maxWidth / (maxWidth - window.innerWidth)),
				toggleClass: { targets: sct, className: 'active' }
				// ADD SKEW
				// onUpdate: (self) => {
				// 	let skew = clamp(self.getVelocity() / -500)
				// 	// only do something if the skew is MORE severe. Remember, we're always tweening back to 0, so if the user slows their scrolling quickly, it's more natural to just let the tween handle that smoothly rather than jumping to the smaller skew.
				// 	if (Math.abs(skew) > Math.abs(proxy.skew)) {
				// 		proxy.skew = skew
				// 		gsap.to(proxy, {
				// 			skew: 0,
				// 			duration: 0.5,
				// 			ease: 'circ',
				// 			overwrite: true,
				// 			onUpdate: () => skewSetter(proxy.skew),
				// 		})
				// 	}
				// },
				// END SKEW
			});
		});

		// SKEW: make the right edge "stick" to the scroll bar. force3D: true improves performance
		// gsap.set(section, { transformOrigin: 'center center', force3D: true })
		// END SKEW
	}
}
