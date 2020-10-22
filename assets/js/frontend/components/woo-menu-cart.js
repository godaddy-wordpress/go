let menuObject   = document.getElementById( 'header__cart-toggle' );
let siteOverlay  = document.getElementById( 'site-overlay' );
let sideNav      = document.getElementById( 'site-nav--cart' );
let sideNavClose = document.getElementById( 'site-close-handle' );

const wooMenuCart = () => {
	if (
		null === menuObject ||
		null === siteOverlay ||
		null === sideNavClose
	) {
		return;
	}

	document.body.classList.add( 'has-woo-cart-slideout' );

	menuObject.addEventListener( 'click',  function( event ) {
		event.preventDefault();
		toggleSideNavVisibility();
	} );

	siteOverlay.addEventListener( 'click', toggleSideNavVisibility );
	sideNavClose.addEventListener( 'click', toggleSideNavVisibility );
};

const toggleSideNavVisibility = ( event ) => {
	sideNav.classList.toggle( 'active' );
	siteOverlay.classList.toggle( 'active' );
	document.body.classList.toggle( 'sidebar-move' );
};

export default wooMenuCart;
