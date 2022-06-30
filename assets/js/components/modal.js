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
			pswpModule: () => import('photoswipe')
		});

		this.lightbox.init();
	}

	destroy() {
		this.lightbox.destroy();
	}
}
