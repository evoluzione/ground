/**
 * Dropdowns opened from the keyboard: the main menu's submenus, the language
 * switcher and the account menu.
 *
 * The mouse opens them on hover, in CSS. This only drives the button next to
 * each parent link (or alone, in the language switcher): its aria-expanded is
 * what CSS reads to show the dropdown (peer-aria-expanded) and what screen
 * readers announce.
 */
export default class Submenu {
	/**
	 * @param {string} selector - Selector for the buttons; each button's
	 * parent element (an <li> in the main menu, the <nav> elsewhere) also
	 * contains its dropdown.
	 */
	constructor(selector = ".js-submenu-toggle") {
		this.selector = selector;

		// Delegated, like Toggle: a menu rendered later needs no re-binding.
		document.addEventListener("click", this.onClick);
		document.addEventListener("keydown", this.onKeydown);
		document.addEventListener("focusin", this.onFocusin);
	}

	/**
	 * Buttons whose dropdown is open, except those whose parent element
	 * contains `target`.
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
	 * Tabbing out of a dropdown's parent element closes it.
	 * @param {FocusEvent} event
	 */
	onFocusin = (event) => {
		this.openElsewhere(event.target).forEach(this.close);
	};
}
