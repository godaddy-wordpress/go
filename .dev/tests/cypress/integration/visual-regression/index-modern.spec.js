import { captureDocument, screenshotPathFromUrl, unslashit } from '../../helpers';

describe( 'VR Testing: index - modern', () => {
    let pages = [];

    it( 'Loads frontpage', () => {
        let url = "https://wpnux.godaddy.com/v2/?template=index&style=modern&lang=en_US".replace(
            unslashit( 'https://wpnux.godaddy.com/v2/' ),
            unslashit( Cypress.env( 'templateGalleryEndpoint' ) )
        ).replace(
            'en_US',
            Cypress.env( 'templateLang' )
        );

        cy.visit( url );
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
            captureDocument( screenshotPathFromUrl( page ) );
        } );
    } );

} );
