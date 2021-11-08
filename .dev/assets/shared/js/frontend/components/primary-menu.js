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
 *
 * @param {event} e
 */
function lockMenuFocus( e ) {
	if ( [ 'Space', 'Enter', 'Tab' ].includes[ e.code ] || ! document.querySelector( 'body' ).classList.contains( 'menu-is-open' ) ) {
		return;
	}

	const element = document.querySelector( ':focus' );
	const isShiftTab = ( e.shiftKey && e.code === 'Tab' );

	if ( element.getAttribute( 'id' ) === 'nav-toggle' ) {
		if ( isShiftTab ) {
			return;
		}
		setTimeout( function() {
			document.querySelectorAll( 'ul.primary-menu li:first-child a' )[ 0 ].focus();
		}, 10 );
	}
}

export default init;
