
/**
 * Capture and compare the fullpage snapshots.
 *
 * @param {string} path The path to store the snapshot.
 */
export function captureDocument( path = '' ) {
    // Disable scroll-behavior as it prevents reliable full-page screenshots.
    cy.get('html').invoke('css', 'scroll-behavior', 'auto');

    [
        { label: 'go-huge', width: 1440, height: 1080 },
        { label: 'go-large', width: 960, height: 1080 },
        { label: 'go-medium', width: 782, height: 1080 },
        { label: 'go-small', width: 600, height: 1080 },

    ].forEach( viewport => {
        cy.viewport( viewport.width, viewport.height );
        cy.matchImageSnapshot( `${path}/${viewport.label}` );
    } );
}

/**
 * Create a folder structure for visual regression snapshots based on the WPNUX API template's preview url.
 *
 * @param {string} url WPNUX API template preview url.
 */
export function screenshotPathFromUrl( url ) {
    const urlSlashIt = url.replace( Cypress.env( 'templateGalleryEndpoint' ).replace(/\/$/, '/'), '' );
    const urlParts = new URL( urlSlashIt );

    return [
        urlParts.searchParams.get( 'lang' ),
        urlParts.searchParams.get( 'template' ),
        urlParts.searchParams.get( 'style' ),
        Cypress.browser.name,
        unslashit( urlParts.pathname ) || 'frontpage',
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