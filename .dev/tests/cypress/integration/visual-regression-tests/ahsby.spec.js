import { getTemplateSlug } from './helpers.js';

var templateSlug = getTemplateSlug(),
    templateName = templateSlug.charAt( 0 ).toUpperCase() + templateSlug.slice( 1 );

describe( 'Test the ' + templateName + ' template for visual regressions.', () => {
  it( 'Confirm the ' + templateName + ' template has no visual regressions.', () => {
    cy.visit( 'https://wpnux.godaddy.com/v2/?template=' + getTemplateSlug() );
    cy.wait( 3000 ); // wait for CoBlocks gallery layouts

    cy.viewport( 'macbook-15' ); // 1440x900
    cy.screenshot( 'compare/' + getTemplateSlug() + '-desktop' );

    cy.viewport( 'ipad-mini' ); // 768x1024
    cy.screenshot( 'compare/' + getTemplateSlug() + '-ipad' );

    cy.viewport( 'iphone-xr' ); // 414x896
    cy.screenshot( 'compare/' + getTemplateSlug() + '-iphone' );
  } );
} );
