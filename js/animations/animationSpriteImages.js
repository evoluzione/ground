/* eslint-disable no-unused-vars */
import { initObserver } from '../utilities/observer';
// import { getTemplateUrl } from '../utilities/paths';
import deepmerge from 'deepmerge';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationSpriteImages {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || '[data-scroll="js-sprite-images"]';
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
		gsap.utils.toArray(triggers).forEach((element) => {
			this.animationSpriteImages(element);
		});
	}

	/**
	 * Update events
	 * @param {Object} target - New selector
	 */
	updateEvents(target) {
		this.init();

		setTimeout(() => {
			this.animationSpriteImages(element);
		}, 1000);
	}

	/**
	 * pin Image Sequence https://codepen.io/GreenSock/pen/yLOVJxd
	 */
	animationSpriteImages(item) {
		const target = item.querySelector('[data-scroll-target]');
		const canvas = item.querySelector('[data-scroll-canvas]');
		const targetContainer = item.querySelector('[data-scroll-target-animate]');
		const context = canvas.getContext('2d');
		const frameCount = parseInt(item.dataset.scrollFrames, 10);
		const framePath = item.dataset.scrollPath;

		canvas.width = 900;
		canvas.height = 859;

		const currentFrame = (index) => `${framePath}/${(index + 1).toString().padStart(4, '0')}.jpg`;
		// `https://www.apple.com/105/media/us/airpods-pro/2019/1299e2f5_9206_4470_b28e_08307a42f19b/anim/sequence/large/01-hero-lightpass/${(index + 1).toString().padStart(4, '0')}.jpg`

		const images = [];
		const frames = {
			frame: 0
		};

		for (let i = 0; i < frameCount; i++) {
			const img = new Image();
			img.src = currentFrame(i);
			images.push(img);
		}

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: target,
				start: 'center center',
				end: '+=400%',
				scrub: 0.5,
				pin: true,
				pinReparent: true,
				anticipatePin: 1
			}
		});

		tl.to(
			frames,
			{
				frame: frameCount - 1,
				snap: 'frame',
				onUpdate: render,
				duration: 20
			},
			'together'
		).fromTo(targetContainer, { scale: 0.95 }, { scale: 1, duration: 20 }, 'together');

		images[0].onload = render;

		function render() {
			context.clearRect(0, 0, canvas.width, canvas.height);
			context.drawImage(images[frames.frame], 0, 0);
		}
	}

}
