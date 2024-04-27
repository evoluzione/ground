import deepmerge from 'deepmerge';

export default class CheckoutAutocomplete {
	/**
	 * @param {string} element - Selector
	 * @param {Object} options - User options
	 */
	constructor(element, options) {
		this.element = element || 'form.woocommerce-checkout';
		this.defaults = {
			triggers: this.element,
		};
		this.options = options ? deepmerge(this.defaults, options) : this.defaults;
		this.init();
	}

	citiesJson = [];
	selectOption = { placeholder: 'Seleziona un\'opzione...' };

	// Country - e.g. Italy
	// State - e.g. Brescia
	// City - e.g. Flero
	// Postcode - e.g. 25125
	selectCountry = jQuery('#billing_country');
	selectState = jQuery('#billing_state');
	selectCity = jQuery('#billing_city');
	selectPostcode = jQuery('#billing_postcode');

	/**
	 * Init
	 */
	async init() {
		this.getJson();
	}

	/**
	 * Utility function to initialize an array of fields with Select2
	 * @param {*} fields 
	 */
	initializeSelect2Fields(fields) {
		fields.forEach(
			field => field.select2({ ...this.selectOption, disabled: true })
		);
	}

	/**
	 * Retreive Json from local file
	 * @returns 
	 */
	getJson() {

		const path = document.body.dataset.templateUrl;
		if (!path) return;

		jQuery.getJSON(`${path}/data/db/Cities-it.json`, function (json) {
			return json;
		}).then((json) => {
			this.citiesJson = json;
			if (json.length > 0) this.initPopulateAutocomplete();
		}).catch(err => {
			console.error('[checkoutAutocomplete] getJson failed ', err);
		});

	}

	initPopulateAutocomplete() {

		if (this.selectCountry.val() === 'IT') this.populateAutocompleteItaly();

		// Callback if country is selected
		const cbCountrySelected = (e) => {
			const data = e.params.data;

			// Svuoto i valori inseriti in precedenza
			this.selectState.val(null);
			this.selectCity.val(null);
			this.selectPostcode.val(null);

			if (data.id !== 'IT') {

				[this.selectCity, this.selectPostcode].forEach(field => {
					// Se sono stati inizializzati con select2
					if (field.hasClass('select2-hidden-accessible')) {
						// li distruggo
						field.select2('destroy');
						// e li rendo non disabled
						field.prop('disabled', false);
					}
				});

				return;
			}

			// Re-initialize field because on change state AJAX inject new items
			this.selectCountry = jQuery('#billing_country');
			this.selectState = jQuery('#billing_state');
			this.selectCity = jQuery('#billing_city');
			this.selectPostcode = jQuery('#billing_postcode');

			this.populateAutocompleteItaly();
		};
		this.selectCountry.on('select2:select', cbCountrySelected);
	}

	populateAutocompleteItaly() {

		// initialize select2 fields
		this.initializeSelect2Fields([this.selectCity, this.selectPostcode]);

		/**
		 * City
		 */
		this.populateAutocompleteCity(this.selectState.val());
		// Callback if state is selected
		const cbStateSelected = (e) => {
			const data = e.params.data;
			// Svuoto city e postcode
			this.initializeSelect2Fields([this.selectCity, this.selectPostcode]);
			// Aggiorno i valori di city
			if (data.id) this.populateAutocompleteCity(data.id);

		};
		this.selectState.on('select2:select', cbStateSelected);

		/**
		 * Postcode
		 */
		this.populateAutocompletePostcode(this.selectCity.val());
		// Callback if city is selected
		const cbCitySelected = (e) => {
			const data = e.params.data;
			// Svuoto il postcode
			this.initializeSelect2Fields([this.selectPostcode]);
			// aggiorno i valori di postcode
			if (data.id) this.populateAutocompletePostcode(data.id);
		};
		this.selectCity.on('select2:select', cbCitySelected);

	}

	populateAutocompleteCity(value) {

		const filteredList = this.citiesJson
			.filter(item => item.ProvinceCode === value)
			.map(item => ({ id: item.Title, text: item.Title }));

		if (!filteredList.length) return;

		this.selectCity.select2({
			...this.selectOption,
			disabled: false,
			data: filteredList
		});
	}

	populateAutocompletePostcode(value) {

		const filteredItem = this.citiesJson
			.find(item => item.Title === value);

		if (!filteredItem) return;

		const filteredList = filteredItem.ZipCodes
			.map(item => ({ id: item, text: item }));

		if (!filteredList.length) return;

		this.selectPostcode.select2({
			...this.selectOption,
			disabled: false,
			data: filteredList
		});
	}

}
