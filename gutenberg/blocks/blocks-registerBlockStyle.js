/**
 * Register block style - Spacer
 */

export default class BlocksRegisterBlockStyle {
	registerBlockStyleSpacer() {
		wp.domReady(() => {
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
		});
	}
}
