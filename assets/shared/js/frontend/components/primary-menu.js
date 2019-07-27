/* global TenUp */
import '../vendor/responsive-nav';

/**
 * Hook up navigation.
 */
const init = () => {
	if ( TenUp ) {
		TenUp.navigation( {
			target: '#js-primary-menu',
			toggle: '#js-site-navigation__toggle'
		} );
	}
};


export default init;
