const menuObject = document.getElementById( 'header__cart-toggle' );
const siteOverlay = document.getElementById( 'site-overlay' );
const sideNav = document.getElementById( 'site-nav--cart' );
const sideNavClose = document.getElementById( 'site-close-handle' );

const wooMenuCart = () => {
	if (
		null === menuObject ||
		null === siteOverlay ||
		null === sideNavClose
	) {
		return;
	}

	document.body.classList.add( 'has-woo-cart-slideout' );

	menuObject.addEventListener( 'click', function( event ) {
		event.preventDefault();
		toggleSideNavVisibility();
	} );

	siteOverlay.addEventListener( 'click', toggleSideNavVisibility );
	sideNavClose.addEventListener( 'click', toggleSideNavVisibility );
};

const toggleSideNavVisibility = () => {
	sideNav.classList.toggle( 'active' );
	siteOverlay.classList.toggle( 'active' );
	document.body.classList.toggle( 'sidebar-move' );
};

export default wooMenuCart;
