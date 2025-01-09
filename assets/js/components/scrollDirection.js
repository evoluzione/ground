let lastScrollPos = window.scrollY;
let ticking = false;

/**
 * Monitors scroll events to determine scroll direction and apply relevant CSS classes.
 */
export function scrollDirection() {
    const offset = 1; // Threshold to determine if the body has been scrolled
    const htmlClassList = document.documentElement.classList;

    // Current state of classes
    let hasBodyScrolled = lastScrollPos > offset;
    let scrollDir = null; // Possible values: 'up' or 'down'

    // Initialize the state based on the initial scroll position
    if (hasBodyScrolled) {
        htmlClassList.add('is-scrolled');
    }

    function onScroll() {
        // Get the current scroll position, ensuring it's not negative (handles iOS bouncing)
        let currentPos = Math.max(window.scrollY, 0);

        // Determine the direction of scrolling
        const direction = currentPos < lastScrollPos ? 'up' : (currentPos > lastScrollPos ? 'down' : null);

        // Check if there's any significant change to handle
        if (direction === null && hasBodyScrolled === (currentPos > offset)) {
            return;
        }

        if (!ticking) {
            window.requestAnimationFrame(() => {

				const shouldBeScrolled = currentPos > offset;
                if (shouldBeScrolled !== hasBodyScrolled) {
                    if (shouldBeScrolled) {
                        htmlClassList.add('is-scrolled');
                    } else {
                        htmlClassList.remove('is-scrolled');
                    }
                    hasBodyScrolled = shouldBeScrolled;
                }

                if (direction) {
                    if (direction !== scrollDir) {
                        if (direction === 'up') {
                            htmlClassList.remove('is-scroll-down');
                            htmlClassList.add('is-scroll-up');
                        } else {
                            htmlClassList.remove('is-scroll-up');
                            htmlClassList.add('is-scroll-down');
                        }
                        scrollDir = direction;
                    }
                }

                ticking = false;
            });

            ticking = true;
        }

        lastScrollPos = currentPos;
    }

    window.addEventListener('scroll', onScroll, { passive: true });
}
