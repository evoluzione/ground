/* eslint-disable no-unused-vars */
import { initObserver } from '../utilities/observer';
// import deepmerge from 'deepmerge';
import { gsap } from 'gsap';
// import { MorphSVGPlugin, DrawSVGPlugin, SplitText, ScrollTrigger } from 'gsap/all';

// import AnimationSplitText from './animationSplitText';

// gsap.registerPlugin(ScrollTrigger, SplitText, DrawSVGPlugin, MorphSVGPlugin);

export default class HandleAnimation {

	AnimationSplitText;
	AnimationRotation;
	AnimationDefault;

	animationToActivate = [];
	promiseList = [];
	hasCssAnimation = false;

	constructor() {
		this.initEvents('[data-scroll]');
		initObserver('[data-scroll]', this.updateEvents);
	}

	initEvents(triggers) {

		this.getAnimationToActivate(triggers);

		this.populatePromiseList();

		this.resolveAllPromise(triggers);

	}

	// get all animations we need
	getAnimationToActivate(triggers) {

		gsap.utils.toArray(triggers).forEach((element) => {
			const dataAttribute = element.dataset.scroll;

			const isInArray = this.animationToActivate.includes(dataAttribute);
			if (isInArray) return;

			if(!this.hasCssAnimation && dataAttribute.substring(0,2) !== 'js'){
				this.hasCssAnimation = true;
			}

			this.animationToActivate.push(dataAttribute);
		});

		// console.log(this.animationToActivate);
		// console.log(this.hasCssAnimation);

	}

	// Create an array of promises to import partials
	populatePromiseList() {

		if (this.animationToActivate.includes('js-split-text')) {
			const promise = import(/* webpackChunkName: "animationSplitText" */'./animationSplitText')
				.then((module) => {
					this.AnimationSplitText = module.default;
					return true;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)
		}

		if (this.animationToActivate.includes('js-rotation')) {
			const promise = import(/* webpackChunkName: "animationRotation" */'./animationRotation')
				.then((module) => {
					this.AnimationRotation = module.default;
					return true;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)
		}

		if (this.hasCssAnimation) {
			const promise = import(/* webpackChunkName: "animationDefault" */'./animationDefault')
				.then((module) => {
					this.AnimationDefault = module.default;
					return true;
				})
				.catch((error) => console.log(error));

			this.promiseList.push(promise)
		}
	}

	resolveAllPromise(triggers) {
		// Once all promises are resolved
		Promise.all(this.promiseList).then(res => {
			console.log(res);
			this.activateAnimations(triggers)
		});

	}

	activateAnimations(triggers) {
		gsap.utils.toArray(triggers).forEach((element) => {
			this.fireAnimation(element);
		});
	}

	fireAnimation(element) {

		switch (element.dataset.scroll) {

			case 'js-split-text':
				new this.AnimationSplitText(element);
				break;

			case 'js-rotation':
				new this.AnimationRotation(element);
				break;

			// case 'js-batch':
			// 	this.animationBatch(element);
			// 	break;

			// case 'js-scale':
			// 	this.animationScale(element);
			// 	break;

			// case 'js-draw':
			// 	this.animationDraw(element);
			// 	break;

			// case 'js-bg-color':
			// 	this.animationChangeBgColor(element);
			// 	break;

			// case 'js-pin':
			// 	this.animationPin(element);
			// 	break;

			// case 'js-sprite-image':
			// 	this.animationSpriteImages(element);
			// 	break;

			// case 'js-horizontal-scrol':
			// 	this.animationHorizontalScroll(element);
			// 	break;

			// case 'js-horizontal-scroll-container':
			// 	this.animationHorizontalScrollContainer(element);
			// 	break;

			// case 'js-horizontal-scroll-section':
			// 	this.animationHorizontalScrollSection(element);
			// 	break;

			// case 'js-comparison':
			// 	this.animationComparison(element);
			// 	break;

			// case 'js-parallax':
			// 	this.animationParallax(element);
			// 	break;

			// case 'js-video':
			// 	this.animationVideo(element);
			// 	break;

			default:
				new this.AnimationDefault(element);
				break;
		}

	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();
		setTimeout(() => {

			this.fireAnimation(target);

		}, 1000);
	}

	// /**
	//  * default Animation
	//  */
	// animationDefault(item) {
	// 	const targetClass = item.dataset.scroll;

	// 	ScrollTrigger.create({
	// 		trigger: item,
	// 		start: 'top 100%',
	// 		toggleClass: targetClass,
	// 		toggleActions: 'play none none none'
	// 		// markers: true,
	// 		// once: true,
	// 	});
	// }

	// /**
	//  * splitText Animation
	//  */
	// animationSplitText(item) {
	// 	gsap.set(item, { autoAlpha: 1 });
	// 	const targetSplitBy = item.dataset.scrollSplittext;
	// 	const targetScrub = parseInt(item.dataset.scrollScrub, 10);

	// 	const tl = gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: item,
	// 			start: 'top 90%',
	// 			end: 'bottom 60%',
	// 			scrub: targetScrub || false,
	// 			// markers: true,
	// 			toggleActions: 'play none play reset'
	// 		}
	// 	});

	// 	if (targetSplitBy === 'chars') {
	// 		const itemSplitted = new SplitText(item, { type: 'chars' });
	// 		tl.from(itemSplitted.chars, {
	// 			yPercent: 100,
	// 			opacity: 0,
	// 			stagger: 0.05,
	// 			duration: 0.5,
	// 			ease: 'back.inOut'
	// 		});
	// 	}

	// 	if (targetSplitBy === 'words') {
	// 		const itemSplitted = new SplitText(item, { type: 'words' });
	// 		tl.from(itemSplitted.words, {
	// 			yPercent: 100,
	// 			opacity: 0,
	// 			stagger: 0.05,
	// 			duration: 0.5,
	// 			ease: 'back.inOut'
	// 		});
	// 	}

	// 	if (targetSplitBy === 'lines') {
	// 		const itemSplitted = new SplitText(item, { type: 'lines' });
	// 		tl.from(itemSplitted.lines, { y: 20, opacity: 0, stagger: 0.01, duration: 0.01, ease: 'back.inOut' });
	// 	}
	// }

	// /**
	//  * rotation Animation
	//  */
	// animationRotation(item) {
	// 	const targetScrub = parseInt(item.dataset.scrollScrub, 10);

	// 	const tl = gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: item,
	// 			start: 'top 90%',
	// 			end: 'bottom 80%',
	// 			scrub: targetScrub || false,
	// 			toggleActions: 'play none play reverse'
	// 		}
	// 	});

	// 	tl.from(item, {
	// 		x: 400,
	// 		rotation: 360
	// 	});
	// }

	// /**
	//  * batch Animation
	//  */
	// animationBatch(item) {
	// 	const target = item.querySelectorAll('[data-scroll-target]');

	// 	// gsap.set(target, { y: 100, opacity: 0 });

	// 	ScrollTrigger.batch(target, {
	// 		interval: 0.1, // time window (in seconds) for batching to occur.
	// 		batchMax: 3, // maximum batch size (targets)
	// 		onEnter: (batch) => gsap.to(batch, { autoAlpha: 1, stagger: 0.1, overwrite: true }),
	// 		onLeave: (batch) => gsap.set(batch, { autoAlpha: 0, overwrite: true }),
	// 		onEnterBack: (batch) => gsap.to(batch, { autoAlpha: 1, stagger: 0.1, overwrite: true }),
	// 		onLeaveBack: (batch) => gsap.set(batch, { autoAlpha: 0, overwrite: true })
	// 	});

	// 	// ScrollTrigger.addEventListener('refreshInit', () =>
	// 	// 	gsap.set(target, { y: 0 })
	// 	// )
	// }

	// /**
	//  * scale Animation
	//  */
	// animationScale(item) {
	// 	const targetScrub = parseInt(item.dataset.scrollScrub, 10);

	// 	const tl = gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: item,
	// 			start: 'top 100%',
	// 			end: 'bottom 0%',
	// 			scrub: targetScrub || false,
	// 			toggleActions: 'play none play reverse'
	// 		}
	// 	});

	// 	tl.to(item, {
	// 		scale: 1.5
	// 	});
	// }

	// /**
	//  * parallax Animation
	//  */
	// animationParallax(item) {
	// 	const targetScrub = parseInt(item.dataset.scrollScrub, 10);

	// 	const tl = gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: item,
	// 			toggleActions: 'play pause none none',
	// 			scrub: targetScrub || 2
	// 		}
	// 	});

	// 	tl.to(item, {
	// 		y: -item.dataset.scrollSpeedY * 100 || 0,
	// 		x: -item.dataset.scrollSpeedX * 100 || 0
	// 	});
	// }

	// /**
	//  * video Animation
	//  */
	// animationVideo(item) {
	// 	const targetVideo = item.querySelector('[data-scroll-target]');

	// 	gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: item,
	// 			start: 'top bottom',
	// 			end: 'bottom top',
	// 			markers: false,
	// 			onEnter: () => targetVideo.play(),
	// 			onLeave: () => {
	// 				targetVideo.pause();
	// 				targetVideo.currentTime = 0;
	// 			},
	// 			onEnterBack: () => targetVideo.play(),
	// 			onLeaveBack: () => {
	// 				targetVideo.pause();
	// 				targetVideo.currentTime = 0;
	// 			}
	// 		}
	// 	});
	// }

	// /**
	//  * darwSvg Animation
	//  */
	// animationDraw(item) {
	// 	const target = item.querySelectorAll('path');
	// 	const targetScrub = parseInt(item.dataset.scrollScrub, 10);

	// 	const tl = gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: item,
	// 			scrub: targetScrub || false,
	// 			toggleActions: 'play none none none'
	// 		}
	// 	});

	// 	tl.from(target, {
	// 		drawSVG: 0
	// 	});
	// }

	// /**
	//  * backgroundColor Animation
	//  */
	// animationChangeBgColor(item) {
	// 	const target = document.body;
	// 	const targetColor = item.dataset.scrollBgcolor;

	// 	const tl = gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: item,
	// 			scrub: 1,
	// 			toggleActions: 'play reset play reset'
	// 		}
	// 	});

	// 	tl.to(target, {
	// 		backgroundColor: targetColor,
	// 		ease: 'power1'
	// 	});
	// }

	// /**
	//  * pin Animation
	//  */
	// animationPin(item) {
	// 	const target = item.querySelectorAll('[data-scroll-target]');
	// 	const targetElement = item.querySelectorAll('[data-scroll-target-animate]');
	// 	const targetScrub = parseInt(item.dataset.scrollScrub, 10);

	// 	const tl = gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: target,
	// 			start: 'center center',
	// 			// end: '+=200%',
	// 			// toggleClass: 'active',
	// 			scrub: targetScrub || false,
	// 			pin: true,
	// 		}
	// 	});

	// 	tl.from(targetElement, {
	// 		scale: 0.6,
	// 		transformOrigin: 'center center'
	// 	});
	// }

	// /**
	//  * pin Image Sequence https://codepen.io/GreenSock/pen/yLOVJxd
	//  */
	// animationSpriteImages(item) {
	// 	const target = item.querySelector('[data-scroll-target]');
	// 	const canvas = item.querySelector('[data-scroll-canvas]');
	// 	const targetContainer = item.querySelector('[data-scroll-target-animate]');
	// 	const context = canvas.getContext('2d');
	// 	const frameCount = parseInt(item.dataset.scrollFrames, 10);
	// 	const framePath = item.dataset.scrollPath;

	// 	canvas.width = 900;
	// 	canvas.height = 859;

	// 	const currentFrame = (index) => `${framePath}/${(index + 1).toString().padStart(4, '0')}.jpg`;
	// 	// `https://www.apple.com/105/media/us/airpods-pro/2019/1299e2f5_9206_4470_b28e_08307a42f19b/anim/sequence/large/01-hero-lightpass/${(index + 1).toString().padStart(4, '0')}.jpg`

	// 	const images = [];
	// 	const frames = {
	// 		frame: 0
	// 	};

	// 	for (let i = 0; i < frameCount; i++) {
	// 		const img = new Image();
	// 		img.src = currentFrame(i);
	// 		images.push(img);
	// 	}

	// 	const tl = gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: target,
	// 			start: 'center center',
	// 			end: '+=400%',
	// 			scrub: 0.5,
	// 			pin: true,
	// 		}
	// 	});

	// 	tl.to(
	// 		frames,
	// 		{
	// 			frame: frameCount - 1,
	// 			snap: 'frame',
	// 			onUpdate: render,
	// 			duration: 20
	// 		},
	// 		'together'
	// 	).fromTo(targetContainer, { scale: 0.95 }, { scale: 1, duration: 20 }, 'together');

	// 	images[0].onload = render;

	// 	function render() {
	// 		context.clearRect(0, 0, canvas.width, canvas.height);
	// 		context.drawImage(images[frames.frame], 0, 0);
	// 	}
	// }

	// /**
	//  * pin Horizontal Animation
	//  */
	// animationHorizontalScroll(item) {
	// 	const target = item.querySelector('[data-scroll-target]');
	// 	const targetContainer = item.querySelector('[data-scroll-target-animate]');
	// 	const targetScrub = parseInt(item.dataset.scrollScrub, 10);

	// 	gsap.to(targetContainer, {
	// 		x: () => -targetContainer.getBoundingClientRect().width + target.getBoundingClientRect().width,
	// 		ease: 'none',
	// 		scrollTrigger: {
	// 			trigger: target,
	// 			invalidateOnRefresh: true,
	// 			start: 'center center',
	// 			end: () => '+=' + targetContainer.offsetWidth,
	// 			pin: true,
	// 			scrub: targetScrub || false
	// 		}
	// 	});
	// }

	// /**
	//  * pin Horizontal Container Animation
	//  */
	// animationHorizontalScrollContainer(item) {
	// 	const target = item.querySelector('[data-scroll-target]');
	// 	const panel = item.querySelectorAll('[data-scroll-panel]');
	// 	const targetScrub = item.dataset.scrollScrub;

	// 	let sections = gsap.utils.toArray(panel);

	// 	let scrollTween = gsap.to(sections, {
	// 		xPercent: -100 * (sections.length - 1),
	// 		ease: 'none', // <-- IMPORTANT!
	// 		scrollTrigger: {
	// 			trigger: target,
	// 			pin: true,
	// 			scrub: targetScrub || false,
	// 			//snap: directionalSnap(1 / (sections.length - 1)),
	// 			end: '+=3000'
	// 		}
	// 	});

	// 	gsap.to('.js-box-1', {
	// 		y: -130,
	// 		duration: 2,
	// 		ease: 'elastic',
	// 		scrollTrigger: {
	// 			trigger: '.js-box-1',
	// 			containerAnimation: scrollTween,
	// 			start: 'left center',
	// 			toggleActions: 'play none play reverse'
	// 			// markers: true,
	// 		}
	// 	});

	// 	gsap.to('.js-box-2', {
	// 		y: 320,
	// 		backgroundColor: 'red',
	// 		ease: 'none',
	// 		scrollTrigger: {
	// 			trigger: '.js-box-2',
	// 			containerAnimation: scrollTween,
	// 			start: 'center 80%',
	// 			end: 'center 20%',
	// 			scrub: 2
	// 			// markers: true
	// 		}
	// 	});
	// }

	// /**
	//  * pin Horizontal Section Animation
	//  */
	// animationHorizontalScrollSection(item) {
	// 	const target = item.querySelector('[data-scroll-target]');
	// 	const section = item.querySelectorAll('[data-scroll-section]');
	// 	const targetScrub = parseInt(item.dataset.scrollScrub, 10);

	// 	const sections = gsap.utils.toArray(section);

	// 	let maxWidth = 0;

	// 	const getMaxWidth = () => {
	// 		maxWidth = 0;
	// 		sections.forEach((section) => {
	// 			maxWidth += section.offsetWidth;
	// 		});
	// 	};
	// 	getMaxWidth();
	// 	ScrollTrigger.addEventListener('refreshInit', getMaxWidth);

	// 	gsap.to(sections, {
	// 		x: () => `-${maxWidth - window.innerWidth}`,
	// 		ease: 'none',
	// 		scrollTrigger: {
	// 			trigger: target,
	// 			pin: true,
	// 			scrub: targetScrub || false,
	// 			start: 'center center',
	// 			end: () => `+=${maxWidth}`,
	// 			invalidateOnRefresh: true
	// 		}
	// 	});

	// 	// ADD SKEW
	// 	// let proxy = { skew: 0 },
	// 	// 	skewSetter = gsap.quickSetter(section, 'skewX', 'deg'), // fast
	// 	// 	clamp = gsap.utils.clamp(-10, 10) // don't let the skew go beyond [X] degrees.
	// 	// END SKEW

	// 	sections.forEach((sct, i) => {
	// 		ScrollTrigger.create({
	// 			trigger: sct,
	// 			start: () =>
	// 				'top top-=' +
	// 				(sct.offsetLeft - window.innerWidth / 2) * (maxWidth / (maxWidth - window.innerWidth)),
	// 			end: () => '+=' + sct.offsetWidth * (maxWidth / (maxWidth - window.innerWidth)),
	// 			toggleClass: { targets: sct, className: 'active' }
	// 			// ADD SKEW
	// 			// onUpdate: (self) => {
	// 			// 	let skew = clamp(self.getVelocity() / -500)
	// 			// 	// only do something if the skew is MORE severe. Remember, we're always tweening back to 0, so if the user slows their scrolling quickly, it's more natural to just let the tween handle that smoothly rather than jumping to the smaller skew.
	// 			// 	if (Math.abs(skew) > Math.abs(proxy.skew)) {
	// 			// 		proxy.skew = skew
	// 			// 		gsap.to(proxy, {
	// 			// 			skew: 0,
	// 			// 			duration: 0.5,
	// 			// 			ease: 'circ',
	// 			// 			overwrite: true,
	// 			// 			onUpdate: () => skewSetter(proxy.skew),
	// 			// 		})
	// 			// 	}
	// 			// },
	// 			// END SKEW
	// 		});
	// 	});

	// 	// SKEW: make the right edge "stick" to the scroll bar. force3D: true improves performance
	// 	// gsap.set(section, { transformOrigin: 'center center', force3D: true })
	// 	// END SKEW
	// }

	// /**
	//  * comparison Animation
	//  */
	// animationComparison(item) {
	// 	const target = item.querySelector('[data-scroll-target]');
	// 	const targetMedia = item.querySelectorAll('[data-scroll-target-media]');
	// 	const targetImage = item.querySelectorAll('[data-scroll-target-media] img');
	// 	const targetScrub = parseInt(item.dataset.scrollScrub, 10);

	// 	const tl = gsap.timeline({
	// 		scrollTrigger: {
	// 			trigger: target,
	// 			start: 'center center',
	// 			end: () => `+=${target.offsetWidth}`,
	// 			scrub: targetScrub || false,
	// 			pin: true,
	// 		},
	// 		defaults: { ease: 'none' }
	// 	});

	// 	tl.fromTo(targetMedia, { xPercent: 100, x: 0 }, { xPercent: 0 }).fromTo(
	// 		targetImage,
	// 		{ xPercent: -100, x: 0 },
	// 		{ xPercent: 0 },
	// 		0
	// 	);
	// }

}
