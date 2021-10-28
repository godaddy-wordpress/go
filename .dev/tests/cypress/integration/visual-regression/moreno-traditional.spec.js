import { captureDocument, screenshotPathFromUrl, unslashit, showCoBlocksAnimatedObjects } from '../../helpers';

describe( 'VR Testing: moreno - traditional', () => {
    let pages = [];

    it( 'Loads frontpage', () => {
        let url = "https://go.test?wpnux_template_loader=1&template=moreno&style=traditional&lang=en_US";

        cy.visit( url );
        showCoBlocksAnimatedObjects();
        captureDocument( screenshotPathFromUrl( url ) );

        cy.get( '#header__navigation' ).then( $headerNavigation => {
            [ ...$headerNavigation.find( '.menu-item a' ) ].forEach( $navLink => {
                pages.push( $navLink.href );
            } );
        } );
    } );

    it( 'Loads additional pages', () => {
        pages.forEach( page => {
            cy.visit( page );
            showCoBlocksAnimatedObjects();
            captureDocument( screenshotPathFromUrl( page ) );
        } );
    } );

} );
