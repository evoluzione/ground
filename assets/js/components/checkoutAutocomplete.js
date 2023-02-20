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
		this.citiesJson;

		this.init();
	}

	/**
	 * Init
	 */
	init() {
		const form = document.querySelector(this.element);

		const path = document.body.dataset.templateUrl;
		if(!path) return;

		const billingStateInput = form.querySelector('#billing_state');
		const billingStateWrapper = document.getElementById('select2-billing_state-container');

		const billingCityInput = form.querySelector('#billing_city');
		billingCityInput.setAttribute('list', 'billing_city_list');
        
		const billingPostcodeInput = form.querySelector('#billing_postcode');
		billingPostcodeInput.setAttribute('list', 'billing_postcode_list');

		// Retreive data from JSON
		jQuery.getJSON(`${path}/data/db/Cities-it.json`, function(json) {
			this.citiesJson = json;
			populateAutocomplete(this.citiesJson);
		});

		function populateAutocomplete(citiesJson) {

			/**
             * City
             */
			populateAutocompleteCity(citiesJson, billingStateInput.value);
			// Se cambio province popolo billing_city
			new MutationObserver(() => {
				populateAutocompleteCity(citiesJson, billingStateInput.value);
			}).observe(billingStateWrapper, { attributes: true, childList: false, subtree: false });

			/**
             * Postcode
             */
			populateAutocompletePostcode(citiesJson, billingCityInput.value);
			// Se cambio billing_city popolo billing_postcode
			billingCityInput.addEventListener('change', function(e){ populateAutocompletePostcode(citiesJson, e.target.value); });

		}

		function populateAutocompleteCity(citiesJson, value) {
			if(!citiesJson) return;

			const listId = 'billing_city_list';

			// Remove old generated node
			const oldNode = document.getElementById(listId); 
			if(oldNode) oldNode.remove();

			// Filtro solo le città necessarie
			const cityList = citiesJson.filter(item => item.ProvinceCode === value);
            
			// Creo un datalist
			const datalist = document.createElement('datalist');
			datalist.id = listId;

			cityList.forEach(element => {
				const option = document.createElement('option');
				option.value = element.Title;
				datalist.appendChild(option);
			});
			billingCityInput.after(datalist);
		}

		function populateAutocompletePostcode(citiesJson, value) {
			if(!citiesJson) return;

			const listId = 'billing_postcode_list';

			// Remove old generated node
			const oldNode = document.getElementById(listId); 
			if(oldNode) oldNode.remove();

			if(!value) return;

			// Filtro solo le città necessarie
			const list = citiesJson.filter(item => item.Title === value);
            
			if(!list) return;
            
			// Creo un datalist
			const datalist = document.createElement('datalist');
			datalist.id = listId;

			list.forEach(element => {
				const option = document.createElement('option');
				option.value = element.ZipCodes;
				datalist.appendChild(option);
			});
			billingPostcodeInput.after(datalist);
		}
        
	}

}
