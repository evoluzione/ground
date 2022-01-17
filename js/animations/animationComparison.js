/* eslint-disable no-unused-vars */
import deepmerge from 'deepmerge';
import { initObserver } from '../utilities/observer';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationComparison {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || '[data-scroll="js-comparison"]';;
		this.defaults = {
			triggers: this.element
		};
		this.DOM = {
			html: document.documentElement,
			body: document.body
		};
		this.options = options ? deepmerge(this.defaults, options) : this.defaults;
		this.updateEvents = this.updateEvents.bind(this);

		window.addEventListener('DOMContentLoaded', () => {});

		ScrollTrigger.addEventListener('scrollStart', () => {});

		ScrollTrigger.addEventListener('scrollEnd', () => {});

		ScrollTrigger.addEventListener('refreshInit', () => {});

		ScrollTrigger.addEventListener('refresh', () => {});

		window.addEventListener('NAVIGATE_OUT', () => {
			// ScrollTrigger.update();
			// ScrollTrigger.refresh();
		});

		window.addEventListener('resize', () => {
			// ScrollTrigger.update();
			// ScrollTrigger.refresh();
		});

		window.addEventListener('NAVIGATE_IN', () => {});

		window.addEventListener('NAVIGATE_END', () => {});

		// window.addEventListener('LOADER_COMPLETE', () => {
			this.init();
			this.initEvents(this.options.triggers);
			initObserver(this.options.triggers, this.updateEvents);
		// });
	}

	/**
	 * Init
	 */
	init() {
		this.DOM.element = document.querySelectorAll(this.element);
	}

	/**
	 * Initialize events
	 * @param {string} triggers - Selectors
	 */
	initEvents(triggers) {
		// TODO: js pin non funziona
		gsap.utils.toArray(triggers).forEach((element) => {
			if (element.dataset.scroll === 'js-comparison') {
				this.animationComparison(element);
			} else if (element.dataset.scroll === 'js-parallax') {
				this.animationParallax(element);
			} else if (element.dataset.scroll === 'js-video') {
				this.animationVideo(element);
			} 
			else {
				this.animationDefault(element);
			}
		});
	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();

		setTimeout(() => {
			if (target.dataset.scroll === 'js-comparison') {
				this.animationComparison(target);
			} else if (target.dataset.scroll === 'js-parallax') {
				this.animationParallax(target);
			} else if (target.dataset.scroll === 'js-video') {
				this.animationVideo(target);
			} 
			else {
				// TODO: individuare il trigger
				this.animationDefault(target);
			}
		}, 1000);
	}

	/**
	 * default Animation
	 */
	animationDefault(item) {
		const targetClass = item.dataset.scroll;

		ScrollTrigger.create({
			trigger: item,
			start: 'top 100%',
			toggleClass: targetClass,
			toggleActions: 'play none none none'
			// markers: true,
			// once: true,
		});
	}

	/**
	 * parallax Animation
	 */
	animationParallax(item) {
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

	/**
	 * video Animation
	 */
	animationVideo(item) {
		const targetVideo = item.querySelector('[data-scroll-target]');

		gsap.timeline({
			scrollTrigger: {
				trigger: item,
				start: 'top bottom',
				end: 'bottom top',
				markers: false,
				onEnter: () => targetVideo.play(),
				onLeave: () => {
					targetVideo.pause();
					targetVideo.currentTime = 0;
				},
				onEnterBack: () => targetVideo.play(),
				onLeaveBack: () => {
					targetVideo.pause();
					targetVideo.currentTime = 0;
				}
			}
		});
	}

	/**
	 * pin Horizontal Section Animation
	 */
	animationHorizontalScrollSection(item) {
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
				pinReparent: true,
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

	/**
	 * comparison Animation
	 */
	animationComparison(item) {
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
				pin: true,
				pinReparent: true,
				anticipatePin: 1
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
