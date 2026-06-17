import { scrollDirection } from "./components/scrollDirection.js";

(() => {
	// Load
	window.addEventListener("load", function () {
		document.documentElement.classList.remove("is-loading");
		document.documentElement.classList.add("is-loaded");
	});

	// Toggle
	if (document.querySelector(".js-toggle")) {
		import("./utilities/toggle.js")
			.then(({ default: Toggle }) => {
				new Toggle();
			})
			.catch((error) => console.log(error));
	}

	// Scroll direction
	scrollDirection();
})();
