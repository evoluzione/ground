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
		const sizeSmallDefault = '1';
		const sizeMediumDefault = '3';
		const sizeLargeDefault = '5';

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

				const options = ['0', '1', '2', '3', '4', '5', '6'].map((i) => ({ label: i, value: i }));

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
												options={options}
												onChange={(newSize) => setAttributes({ sizeSmall: newSize })}
											/>
										</fieldset>
									</PanelRow>

									<PanelRow>
										<fieldset>
											<SelectControl
												label="Medium"
												value={sizeMedium}
												options={options}
												onChange={(newSize) => setAttributes({ sizeMedium: newSize })}
											/>
										</fieldset>
									</PanelRow>

									<PanelRow>
										<fieldset>
											<SelectControl
												label="Large"
												value={sizeLarge}
												options={options}
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
				extraProps.className = classnames(extraProps.className, 'spacer-' + sizeSmall);
			}

			if (typeof sizeMedium !== 'undefined' && sizeMedium !== '0') {
				extraProps.className = classnames(extraProps.className, 'spacer-md-' + sizeMedium);
			}

			if (typeof sizeLarge !== 'undefined' && sizeLarge !== '0') {
				extraProps.className = classnames(extraProps.className, 'spacer-lg-' + sizeLarge);
			}

			return extraProps;
		}

		//add filters
		wp.hooks.addFilter('blocks.registerBlockType', 'ground/spacer/custom-attributes', addAttributes);
		addFilter('editor.BlockEdit', 'ground/spacer/custom-advanced-control', withAdvancedControls);
		addFilter('blocks.getSaveContent.extraProps', 'ground/spacer/applyExtraClass', applyExtraClass);
	}
}
