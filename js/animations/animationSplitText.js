/* eslint-disable no-unused-vars */
import { initObserver } from '../utilities/observer';
// import { getTemplateUrl } from '../utilities/paths';
import deepmerge from 'deepmerge';
import { gsap } from 'gsap';
import { SplitText } from 'gsap/all';
import AnimationDefault from './animationDefault';

gsap.registerPlugin(SplitText);

export default class AnimationSplitText extends AnimationDefault {
	
	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll="js-split-text"]';
	}

	 fireAnimation(item) {

		gsap.set(item, { autoAlpha: 1 });
		const targetSplitBy = item.dataset.scrollSplittext;
		const targetScrub = parseInt(item.dataset.scrollScrub, 10);

		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: item,
				start: 'top 90%',
				end: 'bottom 60%',
				scrub: targetScrub || false,
				// markers: true,
				toggleActions: 'play none play reset'
			}
		});

		if (targetSplitBy === 'chars') {
			const itemSplitted = new SplitText(item, { type: 'chars' });
			tl.from(itemSplitted.chars, {
				yPercent: 100,
				opacity: 0,
				stagger: 0.05,
				duration: 0.5,
				ease: 'back.inOut'
			});
		}

		if (targetSplitBy === 'words') {
			const itemSplitted = new SplitText(item, { type: 'words' });
			tl.from(itemSplitted.words, {
				yPercent: 100,
				opacity: 0,
				stagger: 0.05,
				duration: 0.5,
				ease: 'back.inOut'
			});
		}

		if (targetSplitBy === 'lines') {
			const itemSplitted = new SplitText(item, { type: 'lines' });
			tl.from(itemSplitted.lines, { y: 20, opacity: 0, stagger: 0.01, duration: 0.01, ease: 'back.inOut' });
		}
	}
}
