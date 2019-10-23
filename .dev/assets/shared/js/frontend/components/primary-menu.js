/* global TenUp */
import '../vendor/responsive-nav';

/**
 * Hook up navigation.
 */
const init = () => {
	if ( TenUp ) {
		TenUp.navigation( {
			target: '#header__navigation',
			toggle: '#js-nav-toggle',
			// eslint-disable-next-line
			sub_menu_open: 'click'
		} );
	}
};


export default init;
