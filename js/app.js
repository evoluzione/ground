/* eslint-disable no-unused-vars */

import { initAlwaysRunScripts, initAnimationScripts, initCustomizerScripts, initGenericScripts, initWoocommerceScripts } from './functions';

(() => {
	window.addEventListener('DOMContentLoaded', () => {
		initAlwaysRunScripts();
		initCustomizerScripts();
		initGenericScripts();
		initWoocommerceScripts();
		initAnimationScripts();
	});
})();