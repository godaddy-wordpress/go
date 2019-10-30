import cssVars from 'css-vars-ponyfill';
import primaryMenu from './components/primary-menu.js';
import searchToggle from './components/search-toggle.js';
import wooMenuCart from './components/woo-menu-cart.js';
import _debouce from 'lodash/debounce'; // we need an alias for debounce otherwise it conflicts with customizer

primaryMenu();
searchToggle();
wooMenuCart();
cssVars();

document.addEventListener( 'DOMContentLoaded', function() {
	const hasSelectiveRefresh = (
		'undefined' !== typeof wp &&
		wp.customize &&
		wp.customize.selectiveRefresh &&
		wp.customize.navMenusPreview.NavMenuInstancePartial
	);

	// partial-content-rendered might render multiple times for some reason, let's make sure to debouce this.
	const init = _debouce( () => {
		// we need to remove this before calling primary menu again.
		document.body.classList.remove( 'has-offscreen-nav' );

		primaryMenu();
		searchToggle();
	}, 1000 );

	if ( hasSelectiveRefresh ) {
		wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function ( placement ) {
			const changedHeaderVariation = (
				placement &&
				'null' !== placement.container[0].parentNode &&
				'header_variation' === placement.partial.id
			);

			if ( changedHeaderVariation ) {
				init();
			}
		} );
	}
} );
