/* eslint-disable no-unused-vars */

import { initAlwaysRunScripts, initCustomizerScripts, initGenericScripts, initWoocommerceScripts } from './functions';

(() => {
	window.addEventListener('DOMContentLoaded', () => {
		initAlwaysRunScripts();
		initCustomizerScripts();
		initGenericScripts();
		initWoocommerceScripts();
	});
})();