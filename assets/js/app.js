(() => {

	// Toggle
	if (document.querySelector('.js-toggle')) {
		import('./utilities/toggle.js').then(({default: Toggle}) => {
			new Toggle();
		})
		.catch((error) => console.log(error));
	}

})();
