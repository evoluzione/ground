import classnames from 'classnames';

/**
 * Reference: https://jeffreycarandang.com/extending-gutenberg-core-blocks-with-custom-attributes-and-controls/
 */

const { __ } = wp.i18n;
const { addFilter } = wp.hooks;
const { Fragment } = wp.element;
const { InspectorControls, InspectorAdvancedControls } = wp.editor;
const { createHigherOrderComponent } = wp.compose;
const { ToggleControl, SelectControl, PanelBody, PanelRow } = wp.components;
export default class BlocksRegisterBlockAttribute {
	/**
	 * Fullscreen
	 */
	registerFullscreen() {
		const classToAdd = 'fullscreen';

		function addAttributes(settings) {
			//check if object exists for old Gutenberg version compatibility
			if (typeof settings.attributes !== 'undefined') {
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
									help={!!fullscreen ? __('The block is fullscreen.') : __('The block is boxed.')}
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
	 * Spacer
	 */
	registerSpacerVariation() {
		const ALLOWED_BLOCKS = ['core/spacer'];
		const sizeSmallDefault = '!h-3';
		const sizeMediumDefault = '!md:h-6';
		const sizeLargeDefault = '!lg:h-12';

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

				const formatOptions = (list) => list.map(
					(i) => ({ label: i.label, value: i.value })
				);
				
				const optionsSmall = formatOptions([
					{ label: 'Disattivato', value: '0' },
					{ label: '3', value: '!h-3' },
					{ label: '6', value: '!h-6' },
					{ label: '12', value: '!h-12' },
					{ label: '24', value: '!h-24' },
				]);

				const optionsMedium = formatOptions([
					{ label: 'Disattivato', value: '0' },
					{ label: '3', value: '!md:h-3' },
					{ label: '6', value: '!md:h-6' },
					{ label: '12', value: '!md:h-12' },
					{ label: '24', value: '!md:h-24' },
				]);

				const optionsLarge = formatOptions([
					{ label: 'Disattivato', value: '0' },
					{ label: '3', value: '!lg:h-3' },
					{ label: '6', value: '!lg:h-6' },
					{ label: '12', value: '!lg:h-12' },
					{ label: '24', value: '!lg:h-24' },
				]);

				setAttributes({ sizeSmall: sizeSmall || sizeSmallDefault });
				setAttributes({ sizeMedium: sizeMedium || sizeMediumDefault });
				setAttributes({ sizeLarge: sizeLarge || sizeLargeDefault });

				return (
					<Fragment>
						<BlockEdit {...props} />
						{isSelected && (
							<InspectorControls>
								<PanelBody title={__('Size (rem)', 'ground')} initialOpen={true}>
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
