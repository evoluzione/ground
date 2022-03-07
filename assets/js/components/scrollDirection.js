
// https://developer.mozilla.org/en-US/docs/Web/API/Document/scroll_event#Example

let scrollPos = window.scrollY;
let ticking = false;

export function scrollDirection() {

	// Initial state
	const offset = 100;
	const htmlEl = document.documentElement.classList;

	function onScroll() {

		const currentPos = window.scrollY;
		const isScrollingUp = currentPos < scrollPos;

		if (!ticking) {
			window.requestAnimationFrame(function () {

				// Body scrolled
				if (scrollPos > offset) {
					htmlEl.add('body-scrolled');
				} else {
					htmlEl.remove('body-scrolled');
				}

				// Scroll direction
				if (isScrollingUp) {
					htmlEl.remove('scroll-direction-down');
					htmlEl.add('scroll-direction-up');
				} else {
					htmlEl.remove('scroll-direction-up');
					htmlEl.add('scroll-direction-down');
				}

				ticking = false;

			});

			ticking = true;
		}

		// saves the new position for iteration.
		scrollPos = currentPos;

	}

	// adding scroll event
	window.addEventListener('scroll', onScroll, {
		capture: true,
		passive: true
	});
}