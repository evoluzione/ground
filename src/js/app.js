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

	// Dropdowns (main menu, languages, account), opened from the keyboard
	if (document.querySelector(".js-submenu-toggle")) {
		import("./components/submenu.js")
			.then(({ default: Submenu }) => {
				new Submenu();
			})
			.catch((error) => console.log(error));
	}

	// Announcement bar above the header: rotating messages, pause and close
	const bar = document.querySelector(".js-announcement-bar");
	if (
		bar &&
		!document.documentElement.classList.contains(
			"is-announcement-bar-closed",
		)
	) {
		import("./components/announcementBar.js")
			.then(({ default: AnnouncementBar }) => {
				new AnnouncementBar(bar);
			})
			.catch((error) => console.log(error));
	}

	// Header mini-cart drawer. Without <dialog> support the trigger stays a
	// plain link to the cart page.
	const miniCart = document.querySelector(".mini-cart-panel");
	if (miniCart?.showModal) {
		import("./components/miniCart.js")
			.then(({ default: MiniCart }) => {
				new MiniCart(miniCart);
			})
			.catch((error) => console.log(error));
	}

	// Scroll direction
	scrollDirection();
})();
