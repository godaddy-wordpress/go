let scrollToBottom = require( 'scroll-to-bottomjs' );

/**
 * Capture and compare the fullpage snapshots.
 *
 * @param {string} path The path to store the snapshot.
 */
export function captureDocument( path = '' ) {
    // Disable scroll-behavior as it prevents reliable full-page screenshots.
    cy.get( 'html' ).invoke( 'css', 'scroll-behavior', 'auto' );

    [
        { label: 'go-1080', width: 1920, height: 1080 }
        // { label: 'go-huge', width: 1440, height: 1080 },
        // { label: 'go-large', width: 960, height: 1080 },
        // { label: 'go-medium', width: 782, height: 1080 },
        // { label: 'go-small', width: 600, height: 1080 },

    ].forEach( viewport => {
        // cy.viewport( viewport.width, viewport.height );

        // Scroll to the bottom to get lazy loaded images loading fully
        cy.window().then( cyWindow => scrollToBottom( { remoteWindow: cyWindow } ) );

        // Wait for any animations to finish for those we're unable to prevent right now.
        cy.wait( 1500 );

        // Take the full-page screenshot
        cy.matchImageSnapshot( `${path}/${viewport.label}` );
    } );
}

/**
 * Create a folder structure for visual regression snapshots based on the WPNUX API template's preview url.
 *
 * @param {string} url WPNUX API template preview url.
 */
export function screenshotPathFromUrl( url ) {
    const urlParts = new URL( url );
    const envEndpointParts = new URL( Cypress.env( 'localTestURL' ) );

    return [
        Cypress.env( 'templateLang' ),
        Cypress.browser.name,
        unslashit( urlParts.pathname.replace( envEndpointParts.pathname, '' ).replace( 'v2/', '' ) ) || 'frontpage',
    ].join( '/' );
}

/**
 * Strip all leading and trailing slashes from a path.
 *
 * @param {string} path Path to strip slashes from.
 */
export function unslashit( path ) {
    return path.replace( /(^[\/]+|[\/]+$)/, '' );
}

/**
 * Display animated objects on the page
 */
export function showCoBlocksAnimatedObjects() {
  // Scroll to each animated object on the page,
  // then scroll back to the top for the screenshot
  cy.get( 'body' ).then( ( body ) => {
    if ( body.find( '.coblocks-animate' ).length > 0 ) {
      cy.get( '.coblocks-animate' ).then( ( $el ) => {
        $el.removeClass( 'coblocks-animate' );
      } );
    }
  } );
}
