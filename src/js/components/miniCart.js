/**
 * Header mini-cart drawer: a native <dialog> opened as modal, so Esc, the
 * focus trap and the inert page behind it come from the browser.
 *
 * Clicks are delegated to the document because WooCommerce's AJAX fragments
 * replace the trigger (a.cart-contents) after every cart change. Without JS
 * the trigger is a plain link to the cart page.
 */
export default class MiniCart {
	/**
	 * @param {HTMLDialogElement} dialog
	 */
	constructor(dialog) {
		this.dialog = dialog;

		document.addEventListener("click", this.handleClick);
		dialog.addEventListener("close", this.handleClose);
	}

	/**
	 * @param {MouseEvent} event
	 */
	handleClick = (event) => {
		const { target } = event;

		if (target.closest("a.cart-contents")) {
			event.preventDefault();
			this.dialog.showModal();
		} else if (
			// The dialog itself is only the target on a backdrop click: its
			// children fill it edge to edge.
			target === this.dialog ||
			target.closest(".mini-cart-close")
		) {
			this.dialog.close();
		} else if (
			this.dialog.contains(target) &&
			target.closest(".remove_from_cart_button")
		) {
			// The AJAX removal re-renders the list, focused link included:
			// keep focus in the dialog instead of losing it to <body>.
			this.dialog.querySelector(".mini-cart-close").focus();
		}
	};

	/**
	 * The browser hands focus back to the trigger on close, unless the
	 * fragments replaced it while the dialog was open (an item removed): focus
	 * then stays inside the dialog while it slides out, and drops to <body>.
	 */
	handleClose = () => {
		const active = document.activeElement;

		if (active === document.body || this.dialog.contains(active)) {
			document.querySelector("a.cart-contents")?.focus();
		}
	};
}
