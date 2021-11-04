import debounce from './utility/debounce';
import primaryMenu from './components/primary-menu.js';
import searchToggle from './components/search-toggle.js';
import wooMenuCart from './components/woo-menu-cart.js';

primaryMenu();
searchToggle();
wooMenuCart();

document.addEventListener( 'DOMContentLoaded', function() {
	const hasSelectiveRefresh = (
		'undefined' !== typeof wp &&
		wp.customize &&
		wp.customize.selectiveRefresh &&
		wp.customize.navMenusPreview.NavMenuInstancePartial
	);

	// partial-content-rendered might render multiple times for some reason, let's make sure to debouce this.
	const init = debounce( () => {
		// we need to remove this before calling primary menu again.
		document.body.classList.remove( 'has-offscreen-nav' );

		primaryMenu();
		searchToggle();
	}, 1000 );

	if ( hasSelectiveRefresh ) {
		wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
			const changedHeaderVariation = (
				placement &&
				'null' !== placement.container[ 0 ].parentNode &&
				'header_variation' === placement.partial.id
			);

			if ( changedHeaderVariation ) {
				init();
			}
		} );
	}
} );
