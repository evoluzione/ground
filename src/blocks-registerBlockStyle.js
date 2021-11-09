/**
 * Register block style
 */

wp.domReady(() => {
	/**
	 * Register block style
	 */

	// Spacer
	wp.blocks.registerBlockStyle('core/spacer', {
		name: 'default',
		label: 'Default',
		isDefault: true
	});

	wp.blocks.registerBlockStyle('core/spacer', {
		name: 'responsive-large',
		label: 'Responsive Large'
	});

	wp.blocks.registerBlockStyle('core/spacer', {
		name: 'responsive-medium',
		label: 'Responsive Medium'
	});

	wp.blocks.registerBlockStyle('core/spacer', {
		name: 'responsive-small',
		label: 'Responsive Small'
	});

	/**
	 * Unregister block style
	 */
	// wp.blocks.unregisterBlockStyle('core/paragraph', ['paragraph']);
});
