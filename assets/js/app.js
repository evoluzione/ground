/* eslint-disable no-unused-vars */

import { initAlwaysRunScripts, initCustomizerScripts, initWoocommerceScripts } from './functions';

(() => {
	window.addEventListener('DOMContentLoaded', () => {
		initAlwaysRunScripts();
		initCustomizerScripts();
		initWoocommerceScripts();
	});
})();