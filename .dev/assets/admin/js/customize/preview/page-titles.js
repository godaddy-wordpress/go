export default () => {

	wp.customize( 'page_titles', ( value ) => {
		const selectors = '#content > .entry-header, body.page article .entry-header';
		value.bind( ( to ) => {
			if ( to ) {
				$( selectors ).removeClass( 'display-none' );
			} else {
				$( selectors ).addClass( 'display-none' );
			}
		} );
	} );

};
