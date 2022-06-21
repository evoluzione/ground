import isMobile from 'ismobilejs';

export default class MegaMenu {
	/**
	 * @param {string} element - Selector
	 */
	constructor(element) {
		this.element = element || '.navigation__item.has-children';
		this.defaults = {
			triggers: this.element,
			level: 0
		};

		this.DOM = {
			element: document.querySelectorAll(this.element),
			html: document.querySelector('html'),
			back: document.querySelectorAll('.js-back'),
			navicon: document.querySelector('.js-navicon'),
			menuBody: document.querySelector('.js-menu-body'),
			menuContainer: document.querySelector('.js-menu-container'),
			closeOverlayPanel: document.querySelector('.js-close-overlay-panel'),
			closePanel: document.querySelector('.js-close-panel'),
			menuPanel: document.querySelector('.js-navigation-panel')
		};

		// window.addEventListener('DOMContentLoaded', () => {
		this.init();
		// });

		window.addEventListener('resize', () => {
			console.log('resizing');
			if (isMobile().any) {
				this.init();
			}
		});
	}

	/**
	 * Attiva l'hover nella navigation header del mega menu (solo desktop)
	 */
	activateHoverNavigation() {

		if (window.matchMedia('(min-width:1024px)').matches) {

			this.DOM.element.forEach((item) => {
				let timerHandle = null;

				item.addEventListener('mouseenter', () => {
					clearTimeout(timerHandle);
					this.DOM.html.classList.add('is-navigation-hover');
					timerHandle = setTimeout(() => {
						item.classList.add('is-hover');
					}, 200);
				});

				item.addEventListener('mouseleave', () => {
					clearTimeout(timerHandle);
					this.DOM.html.classList.remove('is-navigation-hover');
					if (item.classList.contains('is-hover')) {
						timerHandle = setTimeout(() => {
							item.classList.remove('is-hover');
						}, 200);
					}
				});

			});
		}

	}

	init() {

		if (this.DOM.element.length === 0) return;

		this.activateHoverNavigation();

	}

}
