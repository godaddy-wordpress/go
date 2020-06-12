/* global TenUp */
import '../vendor/responsive-nav';

/**
 * Hook up navigation.
 */
const init = () => {
	if ( TenUp ) {
		TenUp.navigation( {
			target: '#header__navigation',
			toggle: '#nav-toggle',
			// eslint-disable-next-line
			sub_menu_open: goFrontend.openMenuOnHover ? 'hover' : 'click'
		} );
	}

	document.addEventListener( 'keydown', lockMenuFocus );
};

/**
 * Lock tabbing to the main navigation only.
 */
function lockMenuFocus( evt ) {
	var e = event || evt; // for cross-browser compatibility
	var charCode = e.which || e.keyCode;

	if ( charCode !== 9 || ! jQuery( 'body' ).hasClass( 'menu-is-open' ) ) {
		return;
	}

	var $element       = jQuery( ':focus' ),
	    mainMenuLength = jQuery( 'ul.primary-menu' ).children().length,
	    currentIndex   = jQuery( $element ).closest( 'li' ).index(),
	    isShiftTab     = ( event.shiftKey && event.keyCode == 9 );

	if ( $element.closest( 'ul' ).hasClass( 'sub-menu' ) ) {
		return;
	}

	currentIndex = isShiftTab ? currentIndex - 1 : currentIndex + 1;

	if ( $element.attr( 'id' ) === 'nav-toggle' ) {
		if ( isShiftTab ) {
			return;
		}
		setTimeout( function() {
			jQuery( 'ul.primary-menu li:first-child a' )[0].focus();
		}, 10 );
	}

	// Menu link
	if ( $element.parents( 'ul.primary-menu' ).length > 0 ) {
		if ( ( currentIndex < 0 && isShiftTab ) || ( currentIndex === mainMenuLength ) ) {
			setTimeout( function() {
				jQuery( '#nav-toggle' ).focus();
			}, 10 );
		}
	}
};

export default init;
