/**
 * Submenus of the main menu, opened from the keyboard.
 *
 * The mouse opens them on hover, in CSS. This only drives the button next to
 * each parent link: its aria-expanded is what CSS reads to show the submenu
 * (peer-aria-expanded) and what screen readers announce.
 */
export default class Submenu {
	/**
	 * @param {string} selector - Selector for the buttons; each sits in the
	 * same <li> as its submenu.
	 */
	constructor(selector = ".js-submenu-toggle") {
		this.selector = selector;

		// Delegated, like Toggle: a menu rendered later needs no re-binding.
		document.addEventListener("click", this.onClick);
		document.addEventListener("keydown", this.onKeydown);
		document.addEventListener("focusin", this.onFocusin);
	}

	/**
	 * Buttons whose submenu is open, except those whose <li> contains `target`.
	 * @param {Node|null} target
	 * @returns {Element[]}
	 */
	openElsewhere = (target = null) =>
		[
			...document.querySelectorAll(
				`${this.selector}[aria-expanded="true"]`,
			),
		].filter((button) => !button.parentElement.contains(target));

	close = (button) => button.setAttribute("aria-expanded", "false");

	/**
	 * A click on a button toggles its submenu; a click anywhere outside an
	 * open submenu closes it.
	 * @param {MouseEvent} event
	 */
	onClick = (event) => {
		this.openElsewhere(event.target).forEach(this.close);

		const button = event.target.closest?.(this.selector);
		if (!button) return;

		const expanded = button.getAttribute("aria-expanded") === "true";
		button.setAttribute("aria-expanded", String(!expanded));
	};

	/**
	 * Escape closes the open submenu and, when focus was inside it, hands it
	 * back to the button.
	 * @param {KeyboardEvent} event
	 */
	onKeydown = (event) => {
		if (event.key !== "Escape") return;

		this.openElsewhere().forEach((button) => {
			if (button.parentElement.contains(document.activeElement)) {
				button.focus();
			}
			this.close(button);
		});
	};

	/**
	 * Tabbing out of an item closes its submenu.
	 * @param {FocusEvent} event
	 */
	onFocusin = (event) => {
		this.openElsewhere(event.target).forEach(this.close);
	};
}
