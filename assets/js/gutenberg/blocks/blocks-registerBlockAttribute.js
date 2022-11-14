/* eslint-disable no-undef */
/* eslint-disable react/display-name */
/* eslint-disable react/react-in-jsx-scope */
import classnames from 'classnames';

/**
 * Reference: https://jeffreycarandang.com/extending-gutenberg-core-blocks-with-custom-attributes-and-controls/
 */

const { __ } = wp.i18n;
const { addFilter } = wp.hooks;
const { Fragment, useState } = wp.element;
const { createHigherOrderComponent } = wp.compose;
const { ToggleControl, SelectControl, PanelBody, PanelRow } = wp.components;
const { InspectorAdvancedControls, InspectorControls } = wp.blockEditor;

export default class BlocksRegisterBlockAttribute {
	/**
	 * Fullscreen
	 */
	registerBlockAttribute() {
		function addAttributes(settings, name) {
			// Check if object exists for old Gutenberg version compatibility
			// Woocommerce blocks generate an error
			if (
				typeof settings.attributes !== 'undefined' &&
				!name.includes('woocommerce')
			) {
				settings.attributes = Object.assign(settings.attributes, {
					fullscreen: {
						type: 'boolean',
						default: false,
					},
					fullbleed: {
						type: 'boolean',
						default: false,
					},
					boxed: {
						type: 'boolean',
						default: false,
					},
				});
			}

			return settings;
		}

		const withAdvancedControls = createHigherOrderComponent((BlockEdit) => {
			return (props) => {
				// eslint-disable-next-line no-unused-vars
				const { name, attributes, setAttributes, isSelected } = props;
				const { fullscreen, fullbleed, boxed } = attributes;

				const [blockContainer, setBlockContainer] = useState(
					getBlockContainerAttribute(fullscreen, boxed),
				);

				function getBlockContainerAttribute(fullscreen, boxed) {
					if (fullscreen) {
						return 'fullscreen';
					}
					if (boxed) {
						return 'boxed';
					}
					return '';
				}

				function setBlockContainerAttribute(value) {
					// reset all attributes
					setAttributes({ boxed: false });
					setAttributes({ fullscreen: false });

					// Set the state to view in select the correct value
					setBlockContainer(value);

					// Set block attribute
					if (value === 'boxed') {
						setAttributes({ boxed: true });
					}
					if (value === 'fullscreen') {
						setAttributes({ fullscreen: true });
					}
				}

				return (
					<Fragment>
						<BlockEdit key="ground_block_edit" {...props} />
						{isSelected && (
							<InspectorAdvancedControls>
								<SelectControl
									key="ground_block_edit_select"
									label={__('Block container')}
									value={blockContainer}
									onChange={(value) => {
										setBlockContainerAttribute(value);
									}}
									__nextHasNoMarginBottom={true}
								>
									<option
										key="ground_block_edit_select_default"
										value="default"
									>
										Default
									</option>
									<option key="ground_block_edit_select_boxed" value="boxed">
										Boxed
									</option>
									<option
										key="ground_block_edit_select_fullscreen"
										value="fullscreen"
									>
										Fullscreen
									</option>
								</SelectControl>

								<ToggleControl
									key="ground_block_edit_fullbleed"
									label={__('Full bleed')}
									checked={!!fullbleed}
									onChange={() => setAttributes({ fullbleed: !fullbleed })}
									help={
										fullbleed
											? __('The block has no margin.')
											: __('The block has margin.')
									}
								/>
							</InspectorAdvancedControls>
						)}
					</Fragment>
				);
			};
		}, 'withAdvancedControls');

		function applyExtraClass(extraProps, blockType, attributes) {
			const { fullscreen, fullbleed, boxed } = attributes;

			//check if attribute exists for old Gutenberg version compatibility
			//add class only when fullscreen = true
			if (typeof fullscreen !== 'undefined' && fullscreen) {
				extraProps.className = classnames(
					extraProps.className,
					'is-fullscreen',
				);
			}

			if (typeof fullbleed !== 'undefined' && fullbleed) {
				extraProps.className = classnames(
					extraProps.className,
					'is-full-bleed',
				);
			}

			if (typeof boxed !== 'undefined' && boxed) {
				extraProps.className = classnames(extraProps.className, 'is-boxed');
			}

			return extraProps;
		}

		//add filters
		addFilter(
			'blocks.registerBlockType',
			'ground/custom-attributes',
			addAttributes,
		);
		addFilter(
			'editor.BlockEdit',
			'ground/custom-advanced-control',
			withAdvancedControls,
		);
		addFilter(
			'blocks.getSaveContent.extraProps',
			'ground/applyExtraClass',
			applyExtraClass,
		);
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
			if (
				typeof settings.attributes !== 'undefined' &&
				ALLOWED_BLOCKS.includes(settings.name)
			) {
				settings.attributes = Object.assign(settings.attributes, {
					sizeSmall: {
						type: 'string',
					},
					sizeMedium: {
						type: 'string',
					},
					sizeLarge: {
						type: 'string',
					},
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
												onChange={(newSize) =>
													setAttributes({ sizeSmall: newSize })
												}
											/>
										</fieldset>
									</PanelRow>

									<PanelRow>
										<fieldset>
											<SelectControl
												label="Medium"
												value={sizeMedium}
												options={optionsMedium}
												onChange={(newSize) =>
													setAttributes({ sizeMedium: newSize })
												}
											/>
										</fieldset>
									</PanelRow>

									<PanelRow>
										<fieldset>
											<SelectControl
												label="Large"
												value={sizeLarge}
												options={optionsLarge}
												onChange={(newSize) =>
													setAttributes({ sizeLarge: newSize })
												}
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
		wp.hooks.addFilter(
			'blocks.registerBlockType',
			'ground/spacer/custom-attributes',
			addAttributes,
		);
		addFilter(
			'editor.BlockEdit',
			'ground/spacer/custom-advanced-control',
			withAdvancedControls,
		);
		addFilter(
			'blocks.getSaveContent.extraProps',
			'ground/spacer/applyExtraClass',
			applyExtraClass,
		);
	}
}
