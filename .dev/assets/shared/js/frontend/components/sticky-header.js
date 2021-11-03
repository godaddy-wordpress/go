const stickyHeader = () => {

	if ( ! jQuery( 'body.has-sticky-header' ).length || ! jQuery( 'body.admin-bar' ).length ) {

		return;

	}

	jQuery( window ).load( function() {
		goAdjustStickyHeader();
	} );

	jQuery( window ).on( 'resize', function() {
		goAdjustStickyHeader();
	} );

	function goAdjustStickyHeader() {

		let sticky = jQuery( '#site-header' ),
		    scroll = jQuery( window ).scrollTop();

		if ( window.innerWidth > 600 ) {

			jQuery( '#site-header' ).removeAttr( 'style' );

			return;

		}

		if ( scroll >= 42 ) {

			sticky.css( 'top', 0 );

			return;

		}

		let currentTop = sticky.css( 'top' ).replace( 'px', '' );

		sticky.css( 'top', ( scroll >= 42 ? ( currentTop - scroll ) : 0 ) + 'px' );

	}

}

export default stickyHeader;
