/**
 * Utilities module
 */

export default class Utilities {
	/**
	 * Returns a function, that, as long as it continues to be invoked, will not be triggered.
	 * The function will be called after it stops being called for N milliseconds.
	 * If 'immediate' is passed, trigger the function on the leading edge, instead of the trailing.
	 * @see https://davidwalsh.name/javascript-debounce-function
	 * @param {function} func - Function to wrap
	 * @param {number} wait - Timeout in ms (`100`)
	 * @param {boolean} immediate - Whether to execute at the beginning (`false`)
	 */
	static debounce(func, wait, immediate) {
		let timeout

		// This is the function that is actually executed when
		// the DOM event is triggered.
		return function executedFunction() {
			// Store the context of this and any
			// parameters passed to executedFunction
			const context = this
			// eslint-disable-next-line prefer-rest-params
			const args = arguments

			// The function to be called after
			// the debounce time has elapsed
			const later = () => {
				// null timeout to indicate the debounce ended
				timeout = null

				// Call function now if you did not on the leading end
				if (!immediate) func.apply(context, args)
			}

			// Determine if you should call the function
			// on the leading or trail end
			const callNow = immediate && !timeout

			// This will reset the waiting every function execution.
			// This is the step that prevents the function from
			// being executed because it will never reach the
			// inside of the previous setTimeout
			clearTimeout(timeout)

			// Restart the debounce waiting period.
			// setTimeout returns a truthy value (it differs in web vs node)
			timeout = setTimeout(later, wait)

			// Call immediately if you're dong a leading
			// end execution
			if (callNow) func.apply(context, args)
		}
	}

	/**
	 * Observe DOM Node Changes
	 * @param {string} triggers - Selectors
	 * @param {requestCallback} cb - The callback that handles the response.
	 *
	 * @see https://stackoverflow.com/questions/56608748/how-to-use-queryselectorall-on-the-added-nodes-in-a-mutationobserver
	 */
	static initObserver(triggers, callback) {
		const filterSelector = (selector, mutationsList) => {
			// We can't create a NodeList; let's use a Set
			const result = new Set()
			// Loop through the mutationsList...
			for (const { addedNodes } of mutationsList) {
				for (const node of addedNodes) {
					// console.log(node);

					// If it's an element...
					if (node.nodeType === 1) {
						// Add it if it's a match
						if (node.matches(selector)) {
							result.add(node)
						}
						// Add any children
						for (const entry of node.querySelectorAll(selector)) {
							result.add(entry)
						}
					}
				}
			}

			/* mutationsList.map((e) => e.addedNodes).forEach((n) => {
				if (n.nodeType === 1) {
					if (n.matches(selector)) {
						result.add(n);
					}
					// Add any children
					n.querySelectorAll(selector).forEach((c) => result.add(c));
				}
			}); */

			return [...result] // Result is an array, or just return the set
		}

		const observerCallback = (mutationsList) => {
			const result = filterSelector(triggers, mutationsList)
			result.forEach((element) => {
				callback(element)
			})
		}

		const config = {
			childList: true,
			attributes: false,
			characterData: false,
			subtree: true,
		}
		const observer = new MutationObserver(observerCallback)
		observer.observe(document.documentElement, config)
		//observer.disconnect();
	}
}
