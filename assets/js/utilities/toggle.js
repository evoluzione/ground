/**
 * Toggle module
 */

export default class Toggle {
	/**
	 * @param {string} selector - Selector for toggle elements
	 * @param {Object} options - User-defined options
	 */
	constructor(selector = '.js-toggle', options = {}) {
	  this.defaults = {
		toggleClassName: 'is-active',
		preventDefault: true, // Whether to prevent the default action
		triggers: selector,
	  };

	  // Shallow merge of user options
	  this.options = { ...this.defaults, ...options };

	  this.selector = selector;
	  this.DOM = {
		html: document.documentElement,
		body: document.body,
		elements: [],
	  };

	  this.init();
	}

	/**
	 * Initialize toggle elements and attach click events
	 */
	init = () => {
	  this.DOM.elements = document.querySelectorAll(this.options.triggers);

	  this.DOM.elements.forEach((el) => {
		el.addEventListener('click', this.toggleHandler);
	  });
	}

	/**
	 * Handle click event: toggle class and handle data attributes
	 * @param {MouseEvent} event
	 */
	toggleHandler = (event) => {
	  const current = event.currentTarget;
	  if (!current) return;

	  // Override: data-toggle-prevent-default="false" - Restore default click behavior if set to "false"
	  const preventDefault = current.dataset.togglePreventDefault
		? current.dataset.togglePreventDefault === 'true'
		: this.options.preventDefault;

	  if (preventDefault) {
		event.preventDefault();
	  }

	  // Override: data-toggle-class-name="my-custom-class" - Override default toggle class
	  const toggleClass = current.dataset.toggleClassName
		? current.dataset.toggleClassName
		: this.options.toggleClassName;

	  // Override: data-toggle-target=".selector1 #selector2" - Toggle multiple or specific targets
	  const targets = current.dataset.toggleTarget
		? document.querySelectorAll(current.dataset.toggleTarget)
		: [current];

	  targets.forEach((target) => {
		target.classList.toggle(toggleClass);
	  });
	}

	/**
	 * Add click events to new elements dynamically
	 * @param {Element} newTarget - A new element that should trigger toggling
	 */
	updateEvents = (newTarget) => {
	  if (!newTarget) return;
	  newTarget.addEventListener('click', this.toggleHandler);
	}
  }
