/**
 * setExtraPropsToBlockType
 */
// function setExtraPropsToBlockType(props, blockType, attributes) {
// 	const notDefined = typeof props.className === 'undefined' || !props.className ? true : false;

// 	if (blockType.name === 'core/list') {
// 		return Object.assign(props, { class: notDefined ? 'post__list' : `post__list ${props.className}` });
// 	}

// 	return props;
// }

/**
 * https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#blocks-getsavecontent-extraprops
 */
// wp.hooks.addFilter('blocks.getSaveContent.extraProps', 'ground/block-filters', setExtraPropsToBlockType);
