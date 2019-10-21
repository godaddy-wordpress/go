let menuObject   = document.getElementById( 'menu-item-go-woo-slideout' );
let siteOverlay  = document.getElementById( 'site-overlay' );
let sideNav      = document.getElementById( 'site-nav--cart' );
let sideNavClose = document.getElementById( 'site-close-handle' );

const wooMenuCart = () => {
	document.body.classList.add( 'has-woo-cart-slideout' );

	menuObject.addEventListener( 'mouseenter', function() {
		menuObject.classList.remove( 'hover-out' );
		menuObject.classList.add( 'hover-in' );
	} );

	menuObject.addEventListener( 'mouseleave', function() {
		menuObject.classList.remove( 'hover-in' );
		menuObject.classList.add( 'hover-out' );
	} );

	menuObject.addEventListener( 'click', function( event ) {
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
