/* eslint-disable no-unused-vars */

import {
	initAlwaysRunScripts,
	initWoocommerceScripts,
} from './functions';

(() => {
	window.addEventListener( 'DOMContentLoaded', () => {
		initAlwaysRunScripts();
		initWoocommerceScripts();
	});
})();
