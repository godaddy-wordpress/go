( function( $ ) {

	wp.domReady( function() {

		const $pageTitleMetabox = $( '#resource_external_link_metabox' );
		console.log( 'this is running' );

		wp.data.subscribe( function () {

			// var postFormat = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'format' );

			// if ( 'link' !== postFormat ) {

			// 	$resourceExternalLinkMetabox.hide();

			// 	return;

			

			$pageTitleMetabox.show();

		} );

	} );

} )( jQuery );