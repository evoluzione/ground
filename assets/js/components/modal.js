/**
 * Modal module
 * Lightbox library for presenting various types of media
 */

import PhotoSwipeLightbox from 'photoswipe/lightbox';

const Deepmerge = require('deepmerge');

export default class Modal {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || '[data-modal]';
		this.defaults = {
			triggers: this.element
		};
		this.DOM = {
			html: document.documentElement,
			body: document.body
		};
		this.options = options ? Deepmerge(this.defaults, options) : this.defaults;
		this.init();
	}

	init() {
		this.lightbox = new PhotoSwipeLightbox({
			gallery: this.element, // Element, NodeList, or CSS selector (string)
			children: 'a',
			bgOpacity: 0.9,
			pswpModule: () => import('photoswipe')
		});

		this.lightbox.on('contentLoad', (e) => {
			const { content } = e;

			if (content.type === 'embed') {
				e.preventDefault();

				content.element = document.createElement('div');
				content.element.className = 'pswp__embed-container';

				const iframe = document.createElement('iframe');
				iframe.setAttribute('allowfullscreen', '');
				iframe.setAttribute('frameborder', '0');
				iframe.setAttribute(
					'allow',
					'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
				);
				iframe.src = content.data.src;
				content.element.appendChild(iframe);
			}

			if (content.type === 'video') {
				e.preventDefault();

				content.element = document.createElement('div');
				content.element.className = 'pswp__video-container';

				const video = document.createElement('video');
				video.className = 'pswp__video';
				video.setAttribute('loop', '');
				video.setAttribute('controls', '');
				video.setAttribute('autoplay', '');
				content.element.appendChild(video);

				const videoSource = document.createElement('source');
				videoSource.src = content.data.src;
				video.appendChild(videoSource);
			}
		});

		this.lightbox.init();
	}

	destroy() {
		this.lightbox.destroy();
	}
}
