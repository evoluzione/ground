import isMobile from 'ismobilejs';

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

		this.breakpoint = '1024px';
		this.breakpoint = '900px';

		this.DOM = {
			element: document.querySelectorAll(this.element),
			html: document.querySelector('html'),
			back: document.querySelectorAll('.js-back'),
			navicon: document.querySelector('.js-navicon'),
			menuBody: document.querySelector('.js-menu-body'),
			menuContainer: document.querySelector('.js-menu-container'),
			closeOverviewPanel: document.querySelector('.js-close-overlay-panel'),
			closePanel: document.querySelector('.js-close-panel'),
			menuPanel: document.querySelector('.js-navigation-panel')
		};

		// window.addEventListener('DOMContentLoaded', () => {
		this.init();
		// });

		window.addEventListener('resize', () => {
			if (!isMobile().any) return;

			if (this.DOM.menuContainer) this.DOM.menuContainer.style.cssText += 'transform: none';
			if (this.DOM.menuPanel) this.DOM.menuPanel.style.cssText += 'transform: none';

			this.DOM.html.classList.remove('is-navigation-open', 'is-sub-navigation-open', 'is-overlay-panel-open');

			this.reset();
			this.init();

		});
	}

	reset() {
		for (let i = 0; i <= this.defaults.level - 1; i++) {
			this.DOM.element.forEach((item) => {

				if (!item.classList.contains('level' + i)) return;

				item.classList.remove('level' + i);

				item.childNodes.forEach((t) =>
					t.classList && t.classList.contains('is-active') ? t.classList.remove('is-active') : null
				);

			});
		}

		this.defaults.level = 0;
	}

	init() {

		if (this.DOM.element.length === 0) return;

		this.handleLevelNavigation();

		this.handleLevelBackNavigation();

		this.activateHoverNavigation();

		this.handleResetAll();

	}

	/**
	 * Gestione dei submenu delle navigation
	 * @param {*} item l'elemento che ho cliccato 
	 * @param {*} menu il menu di riferimento
	 * @returns 
	 */
	multiLevelMenu = (item, menu) => {

		console.log('multiLevelMenu');

		let subMenu = null;
		let subMenuImage = null;

		item.target.parentNode.childNodes.forEach((sub) => {
			sub.classList && sub.classList.contains('navigation__sub-menu') ? (subMenu = sub) : null;
			sub.classList && sub.classList.contains('navigation__image') ? (subMenuImage = sub) : null;
		});

		if (!subMenu || !menu) return;

		item.preventDefault();

		item.target.parentElement.classList.add('level' + this.defaults.level);
		this.DOM.html.classList.add('is-sub-navigation-open');

		subMenu.classList.add('is-active');
		subMenuImage && subMenuImage.classList.add('is-active');

		this.defaults.level++;
		let translation = -100 * this.defaults.level;
		menu.style.cssText += 'transform: translateX(' + translation + '%);';

		this.DOM.menuBody.scrollTo({
			top: 0,
			left: 0,
			behavior: 'smooth'
		});

	};

	/**
	 * Gestione dei back
	 * @param {*} menu il menu di riferimento
	 */
	multiLevelBack = (menu) => {

		console.log('multiLevelBack');

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
			menu.style.cssText += 'transform: translateX(' + translation + '%);';

			this.defaults.level == 0 ? this.DOM.html.classList.remove('is-sub-navigation-open') : null;

		}

	};

	/**
	 * Reset All
	 * @param {*} e The event to stop
	 */
	resetAll(e) {
		e.stopImmediatePropagation();

		this.DOM.html.classList.remove('is-sub-navigation-open');
		this.DOM.menuContainer.style.cssText += 'transform: none';
		if (this.DOM.menuPanel) this.DOM.menuPanel.style.cssText += 'transform: none';
		this.DOM.html.classList.remove('is-overlay-panel-open');
		this.reset();
	}

	//Gestione livelli delle navigation
	handleLevelNavigation() {

		this.DOM.element.forEach((item) => {

			item.addEventListener('click', (t) => {
				t.stopImmediatePropagation();

				if (window.matchMedia('(max-width: ' + this.breakpoint + ')').matches) {
					//Attivo la transtion sul container dell'header per il mobile
					this.multiLevelMenu(t, this.DOM.menuContainer);
				} else {
					//Attivo la transtion sul panel-primary per il desk
					if (t.target.parentNode.classList.contains('navigation__item--panel-primary')) {
						this.multiLevelMenu(t, this.DOM.menuPanel);
					}
				}
			});
		});

	}

	//Gestione livelli del back per le navigation
	handleLevelBackNavigation() {

		this.DOM.back.forEach((b) => {
			b.addEventListener('click', (t) => {
				t.stopImmediatePropagation();

				if (window.matchMedia('(max-width: ' + this.breakpoint + ')').matches) {
					//Attivo il back transition sul container dell'header per il mobile
					this.multiLevelBack(this.DOM.menuContainer);
				} else {
					//Attivo il back transtion sul panel-primary per il desk
					this.multiLevelBack(this.DOM.menuPanel);
				}
			});
		});

	}

	//Attivo l'hover nella navigation header solo del desk
	activateHoverNavigation() {

		if (window.matchMedia('(min-width: ' + this.breakpoint + ')').matches) {

			this.DOM.element.forEach((item) => {
				let timerHandle = null;

				console.log(item);

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

	handleResetAll() {

		//Se clicco la navicon resetto tutto
		this.DOM.navicon.addEventListener('click', (t) => this.resetAll(t));

		//Se clicco il close di navigation panel resetto tutto
		if (this.DOM.closePanel) this.DOM.closePanel.addEventListener('click', (t) => this.resetAll(t));

		//Se clicco l'overlay-panel di navigation panel resetto tutto - da fare solo se non sono mobile
		if (!isMobile().any) {
			if (this.DOM.closeOverviewPanel) {
				this.DOM.closeOverviewPanel.addEventListener('click', (t) => {
					t.stopImmediatePropagation();

					this.DOM.html.classList.remove('is-sub-navigation-open');

					this.DOM.menuContainer.style.cssText += 'transform: none';
					if (this.DOM.menuPanel) this.DOM.menuPanel.style.cssText += 'transform: none';
					this.DOM.html.classList.remove('is-overlay-panel-open');

					this.reset();
				});
			}
		}

	}

}
