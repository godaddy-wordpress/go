import { captureDocument, screenshotPathFromUrl, unslashit, showCoBlocksAnimatedObjects } from '../../helpers';

describe( 'VR Testing: miller - welcoming', () => {
    let pages = [];

    it( 'Loads frontpage', () => {
        let url = "http://go.test/?wpnux_template_loader=1&template=miller&style=welcoming&lang=en_US";

        cy.visit( url );
        showCoBlocksAnimatedObjects();
        cy.wait( 30000 );

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
            cy.wait( 30000 );
        } );
    } );

} );
