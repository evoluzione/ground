import isMobile from 'ismobilejs';

export default class MegaMenu {
	/**
	 * @param {string} element - Selector
	 */
	constructor(element) {
		this.element = element || '.navigation__item.has-children';

		this.DOM = {
			element: document.querySelectorAll(this.element),
			html: document.querySelector('html'),
		};

		// window.addEventListener('DOMContentLoaded', () => {
		this.init();
		// });

		/**
		 * isMobile detect the user agent and not the width
		 */
		if (!isMobile().any) {
			this.init();
		}
	}

	init() {
		if (this.DOM.element.length === 0) {
			return;
		}
		this.activateHoverNavigation();
	}

	/**
	 * Attiva l'hover nella navigation header del mega menu (solo desktop)
	 */
	activateHoverNavigation() {
		this.DOM.element.forEach((item) => {
			let timerHandle = null;

			item.addEventListener('mouseenter', () => {
				clearTimeout(timerHandle);

				const isDesktop = window.matchMedia('(min-width:1024px)').matches;
				if (!isDesktop) {
					return;
				}

				this.DOM.html.classList.add('is-navigation-hover');
				timerHandle = setTimeout(() => {
					item.classList.add('is-hover');
				}, 200);
			});

			item.addEventListener('mouseleave', () => {
				clearTimeout(timerHandle);

				const isDesktop = window.matchMedia('(min-width:1024px)').matches;
				if (!isDesktop) {
					return;
				}

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
