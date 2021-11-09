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

/**
 * Example to register plugin
 */

// wp.blocks.registerBlockType('example-plugin/example-custom-block', {
// 	title: wp.i18n.__('Example Custom block', 'ground'),
// 	category: 'common',
// 	icon: 'filter',
// 	keywords: [wp.i18n.__('Demo', 'ground')],
// 	supports: { html: false },
// 	edit: function () {
// 		return wp.i18n.__('Show in editor.', 'ground');
// 	},
// 	save: function () {
// 		return wp.i18n.__('Show in frontend.', 'ground');
// 	}
// });
