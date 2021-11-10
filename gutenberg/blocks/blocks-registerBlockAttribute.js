import classnames from 'classnames';

/**
 * Reference: https://jeffreycarandang.com/extending-gutenberg-core-blocks-with-custom-attributes-and-controls/
 */

const { __ } = wp.i18n;
const { addFilter } = wp.hooks;
const { Fragment } = wp.element;
const { InspectorAdvancedControls } = wp.editor;
const { createHigherOrderComponent } = wp.compose;
const { ToggleControl } = wp.components;

export default class BlocksRegisterBlockAttribute {
	registerFullWidth() {
		const classToAdd = 'full-width';

		//restrict to specific block names
		const allowedBlocks = ['core/paragraph', 'core/heading'];

		function addAttributes(settings) {
			//check if object exists for old Gutenberg version compatibility
			//add allowedBlocks restriction
			if (typeof settings.attributes !== 'undefined' && allowedBlocks.includes(settings.name)) {
				settings.attributes = Object.assign(settings.attributes, {
					fullWidth: {
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

				const { fullWidth } = attributes;

				return (
					<Fragment>
						<BlockEdit {...props} />
						{isSelected && allowedBlocks.includes(name) && (
							<InspectorAdvancedControls>
								<ToggleControl
									label={__('Full width')}
									checked={!!fullWidth}
									onChange={() => setAttributes({ fullWidth: !fullWidth })}
									help={!!fullWidth ? __('The block is fullwidth.') : __('The block is boxed.')}
								/>
							</InspectorAdvancedControls>
						)}
					</Fragment>
				);
			};
		}, 'withAdvancedControls');

		function applyExtraClass(extraProps, blockType, attributes) {
			const { fullWidth } = attributes;

			//check if attribute exists for old Gutenberg version compatibility
			//add class only when fullWidth = true
			//add allowedBlocks restriction
			if (typeof fullWidth !== 'undefined' && fullWidth && allowedBlocks.includes(blockType.name)) {
				extraProps.className = classnames(extraProps.className, classToAdd);
			}

			return extraProps;
		}

		//add filters
		wp.hooks.addFilter('blocks.registerBlockType', 'ground/custom-attributes', addAttributes);
		addFilter('editor.BlockEdit', 'ground/custom-advanced-control', withAdvancedControls);
		addFilter('blocks.getSaveContent.extraProps', 'ground/applyExtraClass', applyExtraClass);
	}
}
