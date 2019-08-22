var blouckIteration = 0;

function incrementBlockIteration( reset ) {
	if ( reset ) {
		blouckIteration = 0;
		return blouckIteration;
	}
	return blouckIteration++;
}

function addBlockClassNames( props, block ) {

	var contentBlocks = wp.data.select( 'core/block-editor' ).getBlocks(),
	    classes       = ( 'undefined' === typeof props.className ) ? '' : props.className;

	if ( ! contentBlocks.length ) {

		return props;

	}

	var blockNumber = incrementBlockIteration( false );

	classes = classes.trim().split( ' ' );

	var firstIndex = classes.indexOf( 'is-first' );

	if ( firstIndex > -1 ) {

		classes.splice( firstIndex, 1 );

	}

	var lastIndex = classes.indexOf( 'is-last' );

	if ( lastIndex > -1 ) {

		classes.splice( lastIndex, 1 );

	}

	if ( blockNumber === 0 ) {

		classes.push( 'is-first' );

	}

	if ( blockNumber === ( contentBlocks.length - 1 ) ) {

		classes.push( 'is-last' );

		// Reset Increment Count
		incrementBlockIteration( true );

	}

	var uniqueClasses = [ ...new Set( classes ) ];

	return Object.assign( props, { className: uniqueClasses.join( ' ' ) } );

}

wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'maverick/block-class-names',
	addBlockClassNames
);

wp.domReady( function() {
	$( '.block-editor' ).append( MaverickBlockFilters.inlineStyles );
} );
