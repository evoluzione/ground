/* eslint-disable no-unused-vars */
import AnimationDefault from './animationDefault';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/all';

gsap.registerPlugin(ScrollTrigger);

export default class AnimationVideo extends AnimationDefault {
	
	constructor(element, options) {
		super(element, options);
		this.element = element || '[data-scroll]';
	}

	fireAnimation(item) {
		const targetVideo = item.querySelector('[data-scroll-target]');

		const pauseVideo = (targetVideo) => {
			// check if is already pause to avoid conflicts
			if(!targetVideo.paused){
				targetVideo.pause();
				targetVideo.currentTime = 0;
			}
		}

		const playVideo = (targetVideo) => {
			// check if is NOT already pause to avoid conflicts
			if(targetVideo.paused){
				targetVideo.play();
			}
		}

		gsap.timeline({
			scrollTrigger: {
				trigger: item,
				start: 'top bottom',
				end: 'bottom top',
				markers: false,
				onEnter: () => playVideo(targetVideo),
				onLeave: () => pauseVideo(targetVideo),
				onEnterBack: () => playVideo(targetVideo),
				onLeaveBack: () => pauseVideo(targetVideo)
			}
		});
	}

}
