const $ = jQuery; // eslint-disable-line

export default () => {

	wp.customize( 'page_titles', ( value ) => {
		const selectors = '#content > .entry-header, body.page article .entry-header, body.woocommerce .entry-header';
		value.bind( ( to ) => {
			if ( to ) {
				$( 'body' ).addClass( 'has-page-titles' );
				$( selectors ).removeClass( 'display-none' );

			} else {
				$( 'body' ).removeClass( 'has-page-titles' );
				$( selectors ).addClass( 'display-none' );

			}
		} );
	} );

};
