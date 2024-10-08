/**
 * Observe DOM Node Changes
 * @param {string} triggers - Selectors
 * @param {requestCallback} cb - The callback that handles the response.
 *
 * @see https://stackoverflow.com/questions/56608748/how-to-use-queryselectorall-on-the-added-nodes-in-a-mutationobserver
 */
export function initObserver(triggers, callback) {
	const filterSelector = (selector, mutationsList) => {
		// We can't create a NodeList; let's use a Set
		const result = new Set();
		// Loop through the mutationsList...
		for (const { addedNodes } of mutationsList) {
			for (const node of addedNodes) {
				// console.log(node);

				// If it's an element...
				if (node.nodeType === 1) {
					// Add it if it's a match
					if (node.matches(selector)) {
						result.add(node);
					}
					// Add any children
					for (const entry of node.querySelectorAll(selector)) {
						result.add(entry);
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

		return [...result]; // Result is an array, or just return the set
	};

	const observerCallback = (mutationsList) => {
		const result = filterSelector(triggers, mutationsList);
		result.forEach((element) => {
			callback(element);
		});
	};

	const config = {
		childList: true,
		attributes: false,
		characterData: false,
		subtree: true,
	};
	const observer = new MutationObserver(observerCallback);
	observer.observe(document.documentElement, config);
	//observer.disconnect();
}
