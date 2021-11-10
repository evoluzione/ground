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
}
