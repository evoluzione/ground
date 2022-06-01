/* eslint-disable react/display-name */
/* eslint-disable react/react-in-jsx-scope */
import classnames from 'classnames';

/**
 * Reference: https://jeffreycarandang.com/extending-gutenberg-core-blocks-with-custom-attributes-and-controls/
 */

const { __ } = wp.i18n;
const { addFilter } = wp.hooks;
const { Fragment } = wp.element;
const { createHigherOrderComponent } = wp.compose;
const { ToggleControl, SelectControl, PanelBody, PanelRow } = wp.components;
const { InspectorAdvancedControls, InspectorControls } = wp.blockEditor;

export default class BlocksRegisterBlockAttribute {
	/**
	 * Fullscreen
	 */
	registerFullscreen() {
		const classToAdd = 'is-fullscreen';

		function addAttributes(settings, name) {
			// Check if object exists for old Gutenberg version compatibility
			// Woocommerce blocks generate an error
			if (typeof settings.attributes !== 'undefined' && !name.includes('woocommerce')) {
				settings.attributes = Object.assign(settings.attributes, {
					fullscreen: {
						type: 'boolean',
						default: false
					}
				});
			}

			return settings;
		}

		const withAdvancedControls = createHigherOrderComponent((BlockEdit) => {
			return (props) => {
				const { name, attributes, setAttributes, isSelected } = props;

				const { fullscreen } = attributes;

				return (
					<Fragment>
						<BlockEdit {...props} />
						{isSelected && (
							<InspectorAdvancedControls>
								<ToggleControl
									label={__('Full screen')}
									checked={!!fullscreen}
									onChange={() => setAttributes({ fullscreen: !fullscreen })}
									help={fullscreen ? __('The block is fullscreen.') : __('The block is boxed.')}
								/>
							</InspectorAdvancedControls>
						)}
					</Fragment>
				);
			};
		}, 'withAdvancedControls');

		function applyExtraClass(extraProps, blockType, attributes) {
			const { fullscreen } = attributes;

			//check if attribute exists for old Gutenberg version compatibility
			//add class only when fullscreen = true
			if (typeof fullscreen !== 'undefined' && fullscreen) {
				extraProps.className = classnames(extraProps.className, classToAdd);
			}

			return extraProps;
		}

		//add filters
		wp.hooks.addFilter('blocks.registerBlockType', 'ground/custom-attributes', addAttributes);
		addFilter('editor.BlockEdit', 'ground/custom-advanced-control', withAdvancedControls);
		addFilter('blocks.getSaveContent.extraProps', 'ground/applyExtraClass', applyExtraClass);
	}

	/**
	 * Remove Padding
	 */
	 registerFullBleed() {
		const classToAdd = 'is-full-bleed';

		function addAttributes(settings, name) {
			// Check if object exists for old Gutenberg version compatibility
			// Woocommerce blocks generate an error
			if (typeof settings.attributes !== 'undefined' && !name.includes('woocommerce')) {
				settings.attributes = Object.assign(settings.attributes, {
					fullBleed: {
						type: 'boolean',
						default: false
					}
				});
			}

			return settings;
		}

		const withAdvancedControls = createHigherOrderComponent((BlockEdit) => {
			return (props) => {
				const { name, attributes, setAttributes, isSelected } = props;

				const { fullBleed } = attributes;

				return (
					<Fragment>
						<BlockEdit {...props} />
						{isSelected && (
							<InspectorAdvancedControls>
								<ToggleControl
									label={__('Full bleed')}
									checked={!!fullBleed}
									onChange={() => setAttributes({ fullBleed: !fullBleed })}
									help={fullBleed ? __('The block has no margin.') : __('The block has margin.')}
								/>
							</InspectorAdvancedControls>
						)}
					</Fragment>
				);
			};
		}, 'withAdvancedControls');

		function applyExtraClass(extraProps, blockType, attributes) {
			const { fullBleed } = attributes;

			//check if attribute exists for old Gutenberg version compatibility
			//add class only when fullscreen = true
			if (typeof fullBleed !== 'undefined' && fullBleed) {
				extraProps.className = classnames(extraProps.className, classToAdd);
			}

			return extraProps;
		}

		//add filters
		wp.hooks.addFilter('blocks.registerBlockType', 'ground/custom-attributes', addAttributes);
		addFilter('editor.BlockEdit', 'ground/custom-advanced-control', withAdvancedControls);
		addFilter('blocks.getSaveContent.extraProps', 'ground/applyExtraClass', applyExtraClass);
	}

	/**
	 * Spacer
	 */
	registerSpacerVariation() {
		const ALLOWED_BLOCKS = ['core/spacer'];
		const sizeSmallDefault = '!h-3';
		const sizeMediumDefault = 'md:!h-6';
		const sizeLargeDefault = 'lg:!h-12';

		function addAttributes(settings) {
			//check if object exists for old Gutenberg version compatibility
			if (typeof settings.attributes !== 'undefined' && ALLOWED_BLOCKS.includes(settings.name)) {
				settings.attributes = Object.assign(settings.attributes, {
					sizeSmall: {
						type: 'string'
					},
					sizeMedium: {
						type: 'string'
					},
					sizeLarge: {
						type: 'string'
					}
				});
			}

			return settings;
		}

		const withAdvancedControls = createHigherOrderComponent((BlockEdit) => {
			return (props) => {
				const { name, attributes, setAttributes, isSelected } = props;
				const { sizeSmall, sizeMedium, sizeLarge } = attributes;

				// Return if this block is disallowed for this feature.
				if (!ALLOWED_BLOCKS.includes(name)) {
					return <BlockEdit {...props} />;
				}

				const optionsSmall = [
					{ label: 'Disattivato', value: '0' },
					{ label: '3', value: '!h-3' },
					{ label: '6', value: '!h-6' },
					{ label: '12', value: '!h-12' },
					{ label: '24', value: '!h-24' },
					{ label: '48', value: '!h-48' },
				];

				const optionsMedium = [
					{ label: 'Disattivato', value: '0' },
					{ label: '3', value: 'md:!h-3' },
					{ label: '6', value: 'md:!h-6' },
					{ label: '12', value: 'md:!h-12' },
					{ label: '24', value: 'md:!h-24' },
					{ label: '48', value: 'md:!h-48' },
				];

				const optionsLarge = [
					{ label: 'Disattivato', value: '0' },
					{ label: '3', value: 'lg:!h-3' },
					{ label: '6', value: 'lg:!h-6' },
					{ label: '12', value: 'lg:!h-12' },
					{ label: '24', value: 'lg:!h-24' },
					{ label: '48', value: 'lg:!h-48' },
				];

				setAttributes({ sizeSmall: sizeSmall || sizeSmallDefault });
				setAttributes({ sizeMedium: sizeMedium || sizeMediumDefault });
				setAttributes({ sizeLarge: sizeLarge || sizeLargeDefault });

				return (
					<Fragment>
						<BlockEdit {...props} />
						{isSelected && (
							<InspectorControls>
								<PanelBody title={__('Size', 'ground')} initialOpen={true}>
									<PanelRow>
										<fieldset>
											<SelectControl
												label="Small"
												value={sizeSmall}
												options={optionsSmall}
												onChange={(newSize) => setAttributes({ sizeSmall: newSize })}
											/>
										</fieldset>
									</PanelRow>

									<PanelRow>
										<fieldset>
											<SelectControl
												label="Medium"
												value={sizeMedium}
												options={optionsMedium}
												onChange={(newSize) => setAttributes({ sizeMedium: newSize })}
											/>
										</fieldset>
									</PanelRow>

									<PanelRow>
										<fieldset>
											<SelectControl
												label="Large"
												value={sizeLarge}
												options={optionsLarge}
												onChange={(newSize) => setAttributes({ sizeLarge: newSize })}
											/>
										</fieldset>
									</PanelRow>
								</PanelBody>
							</InspectorControls>
						)}
					</Fragment>
				);
			};
		}, 'withAdvancedControls');

		function applyExtraClass(extraProps, blockType, attributes) {

			if (!ALLOWED_BLOCKS.includes(blockType.name)) {
				return extraProps;
			}

			const { sizeSmall, sizeMedium, sizeLarge } = attributes;

			if (typeof sizeSmall !== 'undefined' && sizeSmall !== '0') {
				extraProps.className = classnames(extraProps.className, sizeSmall);
			}
			if (typeof sizeMedium !== 'undefined' && sizeMedium !== '0') {
				extraProps.className = classnames(extraProps.className, sizeMedium);
			}
			if (typeof sizeLarge !== 'undefined' && sizeLarge !== '0') {
				extraProps.className = classnames(extraProps.className, sizeLarge);
			}

			return extraProps;
		}

		//add filters
		wp.hooks.addFilter('blocks.registerBlockType', 'ground/spacer/custom-attributes', addAttributes);
		addFilter('editor.BlockEdit', 'ground/spacer/custom-advanced-control', withAdvancedControls);
		addFilter('blocks.getSaveContent.extraProps', 'ground/spacer/applyExtraClass', applyExtraClass);
	}
}
