function setExtraPropsToBlockType(props, blockType, attributes) {
	if (blockType.name !== "core/paragraph") {
		return props;
	}

	const notDefined =
		typeof props.className === "undefined" || !props.className
			? true
			: false;

	if (blockType.name === "core/paragraph") {
		return Object.assign(props, {
			className: notDefined
				? "post__paragraph"
				: `post__paragraph ${props.className}`,
		});
	}

	return props;
}

/**
 * https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/#blocks-getsavecontent-extraprops
 */
wp.hooks.addFilter(
	"blocks.getSaveContent.extraProps",
	"ground/block-filters",
	setExtraPropsToBlockType
);
