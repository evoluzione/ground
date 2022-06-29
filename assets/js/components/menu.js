import isMobile from 'ismobilejs';
import { throttle } from '../utilities/throttle';

export default class Menu {
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

		/**
		 * We need different unit measure
		 * The panel isn't fullwidth so the % is correct
		 * The menu on mobile instead needs vw because the % create an offset each level bigger
		 */
		this.unitMeasure = {
			panel: '%',
			default: 'vw'
		};

		// window.addEventListener('DOMContentLoaded', () => {
		this.init();
		// });

		/**
		 * Bind the resize of the window to restore normal conditions
		 */
		window.addEventListener('resize', this.handleOnResizeMenu);
	}

	/**
	 * Use throttle to avoid high fire rate of the function
	 */
	handleOnResizeMenu = throttle(() => {
		this.resetTransformStyle([this.DOM.menuContainer, this.DOM.menuPanel]);
		this.DOM.html.classList.remove('is-navigation-open', 'is-sub-navigation-open', 'is-overlay-panel-open');
		this.removeAllClass();
	});

	/**
	 * Add inline style "transform: none" for each element
	 * @param {array} elementList
	 */
	resetTransformStyle(elementList) {
		elementList.forEach((element) => {
			if (element) {
				element.style.cssText += 'transform: none';
			}
		});
	}

	/**
	 * Remove all class to restore normal conditions
	 */
	removeAllClass() {
		for (let i = 0; i <= this.defaults.level - 1; i++) {
			this.DOM.element.forEach((item) => {
				if (item.classList.contains('level' + i)) {
					item.classList.remove('level' + i);
					item.childNodes.forEach((t) =>
						t.classList && t.classList.contains('is-active') ? t.classList.remove('is-active') : null
					);
				}
			});
		}

		this.defaults.level = 0;
	}

	/**
	 * Getter function that return the unit measure to handle animation
	 * @param {*} menu
	 */
	getUnitMeasure(menu) {
		if (menu && menu.classList.contains('js-navigation-panel')) {
			return this.unitMeasure.panel;
		}

		return this.unitMeasure.default;
	}

	/**
	 * Gestione dei submenu delle navigation
	 * @param {*} item l'elemento che ho cliccato
	 * @param {*} menu il menu di riferimento
	 * @returns
	 */
	multiLevelMenu = (item, menu) => {
		const unitMeasure = this.getUnitMeasure(menu);

		let subMenu = null;
		let subMenuImage = null;

		item.target.parentNode.childNodes.forEach((sub) => {
			sub.classList && sub.classList.contains('navigation__sub-menu') ? (subMenu = sub) : null;
			sub.classList && sub.classList.contains('navigation__image') ? (subMenuImage = sub) : null;
		});

		if (subMenu && menu) {
			item.preventDefault();

			item.target.parentElement.classList.add('level' + this.defaults.level);
			this.DOM.html.classList.add('is-sub-navigation-open');

			subMenu.classList.add('is-active');
			subMenuImage && subMenuImage.classList.add('is-active');

			this.defaults.level++;
			let translation = -100 * this.defaults.level;
			menu.style.cssText += `transform: translateX(${translation}${unitMeasure});`;

			this.DOM.menuBody.scrollTo({
				top: 0,
				left: 0,
				behavior: 'smooth'
			});
		}
	};

	/**
	 * Gestione dei back
	 * @param {*} menu il menu di riferimento
	 */
	multiLevelBack = (menu) => {
		const unitMeasure = this.getUnitMeasure(menu);

		if (this.defaults.level > 0) {
			this.defaults.level--;
			this.DOM.element.forEach((item) => {
				if (item.classList.contains('level' + this.defaults.level)) {
					item.classList.remove('level' + this.defaults.level);
					item.childNodes.forEach((t) =>
						t.classList && t.classList.contains('is-active') ? t.classList.remove('is-active') : null
					);
				}
			});

			let translation = -100 * this.defaults.level;
			menu.style.cssText += `transform: translateX(${translation}${unitMeasure});`;

			this.defaults.level == 0 ? this.DOM.html.classList.remove('is-sub-navigation-open') : null;
		}
	};

	/**
	 * Reset All
	 * @param {*} e The event to stop
	 */
	resetAll(e) {
		e.stopImmediatePropagation();
		this.DOM.html.classList.remove('is-sub-navigation-open', 'is-overlay-panel-open');
		this.resetTransformStyle([this.DOM.menuContainer, this.DOM.menuPanel]);
		this.removeAllClass();
	}

	/**
	 * Gestione dei livelli del drilldown - navigation items
	 */
	handleLevelNavigation() {
		this.DOM.element.forEach((item) => {
			/**
			 * Create a span to handle drilldown and preserve link to navigate
			 */
			const span = document.createElement('span');
			span.classList = 'js-drilldown';
			item.appendChild(span);

			item.addEventListener('click', (t) => {
				const classList = t.target.className;
				const isDrilldown = classList && classList.includes('js-drilldown');

				if (isDrilldown) {
					t.stopImmediatePropagation();
					t.preventDefault();

					if (window.matchMedia('(max-width:1024px)').matches) {
						//Attivo la transtion sul container dell'header per il mobile
						this.multiLevelMenu(t, this.DOM.menuContainer);
					} else {
						//Attivo la transtion sul panel-primary per il desk
						const isPanel = t.target.parentNode.classList.contains('navigation__item--panel-primary');
						if (isPanel) {
							this.multiLevelMenu(t, this.DOM.menuPanel);
						}
					}
				}
			});
		});
	}

	/**
	 * Gestione dei livelli del drilldown - Back btn
	 */
	handleLevelBackNavigation() {
		this.DOM.back.forEach((b) => {
			b.addEventListener('click', (t) => {
				t.stopImmediatePropagation();

				if (window.matchMedia('(max-width:1024px)').matches) {
					//Attivo il back transition sul container dell'header per il mobile
					this.multiLevelBack(this.DOM.menuContainer);
				} else {
					//Attivo il back transtion sul panel-primary per il desk
					this.multiLevelBack(this.DOM.menuPanel);
				}
			});
		});
	}

	/**
	 * Se clicco la navicon resetto tutto
	 */
	handleNaviconClick() {
		if (this.DOM.navicon) {
			this.DOM.navicon.addEventListener('click', (e) => this.resetAll(e));
		}
	}

	/**
	 * Se clicco il close di navigation panel resetto tutto
	 */
	handleCloseNavigationPanel() {
		if (this.DOM.closePanel) {
			this.DOM.closePanel.addEventListener('click', (e) => this.resetAll(e));
		}
	}

	/**
	 * Se clicco l'overlay-panel di navigation panel resetto tutto (solo NON mobile)
	 */
	handleCloseOverlayPanel() {
		if (this.DOM.closeOverlayPanel && !isMobile().any) {
			this.DOM.closeOverlayPanel.addEventListener('click', (e) => this.resetAll(e));
		}
	}

	init() {
		if (!this.DOM.element.length) {
			return;
		}

		this.handleLevelNavigation();
		this.handleLevelBackNavigation();
		this.handleNaviconClick();
		this.handleCloseNavigationPanel();
		this.handleCloseOverlayPanel();
	}
}
