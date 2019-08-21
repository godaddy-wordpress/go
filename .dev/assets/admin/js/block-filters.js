function addBlockClassNames( props, block ) {

	var contentBlocks = wp.data.select( 'core/editor' ).getBlocks(),
	    classes       = ( 'undefined' === typeof props.className ) ? '' : props.className;

	if ( ! contentBlocks.length ) {

		return props;

	}

	var first = contentBlocks[0],
	    last  = contentBlocks[ contentBlocks.length - 1 ];

	if (
		block.name === first.name &&
		first.attributes.content === props.value
	) {

		classes += ' is-first';

	}

	if (
		block.name === last.name &&
		last.attributes.content === props.value
	) {

		classes += ' is-last';

	}

	var uniqueClasses = [ ...new Set( classes.trim().split( ' ' ) ) ];

	return Object.assign( props, { className: uniqueClasses.join( ' ' ) } );

}

wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'maverick/block-class-names',
	addBlockClassNames
);
