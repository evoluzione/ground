/**
 * Announcement bar above the header
 * (template-parts/announcement/announcement-bar.php): its messages take turns,
 * with a pause/play button and a close button.
 *
 * Only one message is reachable at a time: the others are inert, which also
 * fades them out in CSS (inert:opacity-0). The rotation stops while the pointer
 * or the focus is on the messages and while the tab is hidden, so a link can be
 * read and followed; the buttons stay outside that area, or pressing "play"
 * would do nothing until the pointer left. Closing it is remembered until the
 * messages change (their key), and read back by the inline script the template
 * prints before the bar.
 */
const STORAGE_KEY = "ground-announcement-bar-closed";

export default class AnnouncementBar {
	/**
	 * @param {HTMLElement} bar - The .js-announcement-bar section.
	 */
	constructor(bar) {
		this.bar = bar;
		this.area = bar.querySelector(".js-announcement-bar-messages");
		this.messages = [
			...bar.querySelectorAll(".js-announcement-bar-message"),
		];
		this.pauseButton = bar.querySelector(".js-announcement-bar-pause");
		this.closeButton = bar.querySelector(".js-announcement-bar-close");
		this.interval = Number(bar.dataset.interval) || 5000;

		this.current = 0;
		this.timer = null;
		this.paused = false; // Chosen with the button.
		this.hovered = false;
		this.focused = false;

		this.closeButton.hidden = false;
		this.closeButton.addEventListener("click", this.close);

		if (this.messages.length < 2) return;

		this.pauseButton.hidden = false;
		this.pauseButton.addEventListener("click", this.togglePause);

		this.area.addEventListener("pointerenter", () =>
			this.hold("hovered", true),
		);
		this.area.addEventListener("pointerleave", () =>
			this.hold("hovered", false),
		);
		this.area.addEventListener("focusin", () => this.hold("focused", true));
		this.area.addEventListener("focusout", (event) => {
			if (!this.area.contains(event.relatedTarget)) {
				this.hold("focused", false);
			}
		});
		document.addEventListener("visibilitychange", this.schedule);

		// Reduced motion: no rotation until the visitor presses play.
		if (matchMedia("(prefers-reduced-motion: reduce)").matches) {
			this.togglePause();
		} else {
			this.schedule();
		}
	}

	/**
	 * Whether the messages should be taking turns right now.
	 * @returns {boolean}
	 */
	get running() {
		return (
			!this.paused && !this.hovered && !this.focused && !document.hidden
		);
	}

	/**
	 * Restarts the wait for the next message, or stops it: each message gets a
	 * full interval after the rotation resumes.
	 */
	schedule = () => {
		clearTimeout(this.timer);

		if (this.running) {
			this.timer = setTimeout(this.next, this.interval);
		}
	};

	next = () => {
		this.show((this.current + 1) % this.messages.length);
		this.schedule();
	};

	/**
	 * @param {number} index
	 */
	show(index) {
		this.messages[this.current].inert = true;
		this.messages[index].inert = false;
		this.current = index;
	}

	/**
	 * Records a reason to stop (or no longer stop) the rotation.
	 * @param {"hovered"|"focused"} reason
	 * @param {boolean} value
	 */
	hold(reason, value) {
		this[reason] = value;
		this.schedule();
	}

	togglePause = () => {
		this.paused = !this.paused;
		this.bar.toggleAttribute("data-paused", this.paused);
		this.pauseButton.setAttribute(
			"aria-label",
			this.paused
				? this.pauseButton.dataset.labelPlay
				: this.pauseButton.dataset.labelPause,
		);
		this.schedule();
	};

	close = () => {
		// The button is about to disappear: keyboard focus moves on to the
		// header instead of falling back to the start of the page.
		const hadFocus = this.bar.contains(document.activeElement);

		document.documentElement.classList.add("is-announcement-bar-closed");

		if (hadFocus) {
			this.bar.nextElementSibling
				?.querySelector("a[href], button, input, select, textarea")
				?.focus();
		}

		clearTimeout(this.timer);
		document.removeEventListener("visibilitychange", this.schedule);

		try {
			localStorage.setItem(STORAGE_KEY, this.bar.dataset.key);
		} catch {
			// Storage blocked: closed for this page view only.
		}
	};
}
