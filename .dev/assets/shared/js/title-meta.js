import domReady from '@wordpress/dom-ready';

(function($) {

	domReady( function() {

		const selectors = '#content > .entry-header, body.page article .entry-header, body.woocommerce .entry-header';

		$( 'body' ).removeClass( 'has-page-titles' );
		$( selectors ).addClass( 'display-none' );

	});

})(jQuery); 
