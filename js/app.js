/* eslint-disable no-unused-vars */
import { initGenericScripts, initAnimationScripts } from './functions';

(() => {
	window.addEventListener('DOMContentLoaded', () => {
		initGenericScripts();
		initAnimationScripts();
	});
})();
