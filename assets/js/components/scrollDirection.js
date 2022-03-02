export default class ScrollDirection {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	// eslint-disable-next-line no-unused-vars
	constructor(element, options) {
		this.initEvents();
	}

	/**
	 * Initialize events
	 * @param {string} triggers - Selectors
	 */
	initEvents() {
		// Initial state
		let scrollPos = document.body.getBoundingClientRect().top;
		const offset = -100;
		const htmlEl = document.documentElement.classList;

		// adding scroll event
		window.addEventListener('scroll', () => {
			const currentPos = document.body.getBoundingClientRect().top;
			if (scrollPos < offset) {
				htmlEl.add('body-scrolled');
				if (currentPos > scrollPos) {
					// scrolling up
					htmlEl.remove('scroll-direction-down');
					htmlEl.add('scroll-direction-up');
				} else {
					// Scrolling down
					htmlEl.remove('scroll-direction-up');
					htmlEl.add('scroll-direction-down');
				}
			} else {
				htmlEl.remove('body-scrolled');
			}
			// saves the new position for iteration.
			scrollPos = currentPos;
		} );
	}
}
