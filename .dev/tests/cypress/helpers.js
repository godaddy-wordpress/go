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
        // Scroll to the bottom to get lazy loaded images loading fully
        cy.window().then( cyWindow => scrollToBottom( { remoteWindow: cyWindow } ) );

        // Wait for any animations to finish for those we're unable to prevent right now.
        cy.wait( 1500 );

        cy.viewport( viewport.width, viewport.height );

        // Take the full-page screenshot
        cy.matchImageSnapshot( `${path}/${viewport.label}`, {
          customDiffConfig: { threshold: 0.5 }
        } );
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

/**
 * Login to our test WordPress site
 */
export function loginToSite() {
  cy.visit( Cypress.env( 'localTestURL' ) + '/wp-admin/' )
    .then( ( window ) => {
      if ( window.location.pathname === '/wp-login.php' ) {
      // WordPress has a wp_attempt_focus() function that fires 200ms after the wp-login.php page loads.
      // We need to wait a short time before trying to login.
        cy.wait( 250 );

        cy.get( '#user_login' ).type( Cypress.env( 'wpUsername' ) );
        cy.get( '#user_pass' ).type( Cypress.env( 'wpPassword' ) );
        cy.get( '#wp-submit' ).click();
      }
    } );

  cy.get( 'body' ).should( 'have.class', 'wp-admin' );
}

/**
 * Upload helper object. Contains image fixture spec and uploader function.
 * `helpers.upload.newLogo` Function uploads the new logo.
 * `helpers.upload.spec` Object containing image spec.
 */
export const upload = {
  /**
   * Upload image to input element and trigger replace image flow.
   *
   * @param {string} blockName The name of the block that is replace target
   *                           imageReplaceFlow works with CoBlocks Galleries: Carousel, Collage, Masonry, Offset, Stacked.
   */
  newLogo: () => {
    cy.get( '#customize-control-custom_logo' ).should( 'exist' );

    const imagePath = `../fixtures/images/150x150.png`;

    /* eslint-disable */
    cy.fixture( imagePath ).then( ( fileContent ) => {
      cy.get( '[class^="moxie"] [type="file"]' )
        .attachFile( { fileContent, filePath: imagePath, mimeType: 'image/png' }, { force: true } );
    } );
    /* eslint-enable */
  },

  spec: {
    fileName: '150x150.png',
    imageBase: '150x150',
    pathToFixtures: '../.dev/tests/cypress/fixtures/images/',
  },
};
