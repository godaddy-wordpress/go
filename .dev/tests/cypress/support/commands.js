Cypress.Commands.add( 'setResolution', ( size ) => {
  if ( Cypress._.isArray( size ) ) {
     cy.viewport( size[0], size[1] );
   } else {
    cy.viewport( size );
  }
} );
