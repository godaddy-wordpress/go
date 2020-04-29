wp.domReady( function() {
	jQuery( '.block-editor' ).append( GoBlockFilters.inlineStyles );

	if ( GoBlockFilters.hidePageTitle ) {
		jQuery( '.block-editor .editor-post-title__input' ).css( { opacity: 0.5 } );
	}

	jQuery( '#hide-page-title-checkbox' ).on( 'change', function() {
		if ( jQuery( this ).is( ':checked' ) ) {
			jQuery( '.block-editor .editor-post-title__input' ).css( { opacity: 0.5 } );
			return;
		}
		jQuery( '.block-editor .editor-post-title__input' ).css( { opacity: 1 } );
	} );
} );
