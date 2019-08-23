export default () => {

	wp.customize( 'page_titles', ( value ) => {
		value.bind( ( to ) => {
			if ( to ) {
				$( '#content > .entry-header' ).removeClass( 'display-none' );
			} else {
				$( '#content > .entry-header' ).addClass( 'display-none' );
			}
		} );
	} );

};
