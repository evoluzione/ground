/**
 * Filter blocks
 */
// function filterBlocks(settings) {
// 	if (settings.name !== 'core/paragraph') {
// 		return settings;
// 	}

// 	const newSettings = {
// 		...settings
// 	};

// 	return newSettings;
// }
// wp.hooks.addFilter('blocks.registerBlockType', 'ground/gutenberg/filter-blocks', filterBlocks);

/**
 * Custom Attribute
 */
// function customAttribute(settings, name) {
// 	if (typeof settings.attributes !== 'undefined') {
// 		if (name == 'core/paragraph') {
// 			settings.attributes = Object.assign(settings.attributes, {
// 				hideOnMobile: {
// 					type: 'boolean'
// 				}
// 			});
// 		}
// 	}
// 	return settings;
// }
// wp.hooks.addFilter('blocks.registerBlockType', 'ground/gutenberg/custom-attribute', customAttribute);
