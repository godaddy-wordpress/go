import domReady from '@wordpress/dom-ready';

import { withSelect, withDispatch } from '@wordpress/data';


(function() {

	domReady( function() {

		// const mapSelectToProps = function( select ) {

		// 	return {
		// 		metaFieldValue: select( 'core/editor' )
		// 			.getEditedPostAttribute( 'meta' ),
		// 	}
		// }
	
		// const mapDispatchToProps = function( dispatch ) {
		// 	return {
		// 		setMetaFieldValue: function( value ) {
		// 			dispatch( 'core/editor' ).editPost(
		// 				{ meta: { sidebar_plugin_meta_block_field: value } }
		// 			);
		// 		}
		// 	}
		// }
	
	
		// const metaBox = document.getElementById('page-title-checkbox');

		// !! metaBox && metaBox.addEventListener('change',function(e){
			// const { checked } = e.target;
			// const selectors = '#content > .entry-header, body.page article .entry-header, body.woocommerce .entry-header';

			// if ( checked ) {
			// 	$( 'body' ).addClass( 'has-page-titles' );
			// 	$( selectors ).removeClass( 'display-none' );

			// } else {
			// 	$( 'body' ).removeClass( 'has-page-titles' );
			// 	$( selectors ).addClass( 'display-none' );

			// }
			// console.log(document.querySelectorAll(selectors));
		// });
	});

})(); 
