/**
 * Attempts to retrieve the template slug from the current spec file being run
 * eg: keynote.spec.js => keynote
 */
export function getTemplateSlug() {
  var specFile  = Cypress.spec['name'],
      fileBase  = ( specFile.split( '/' ).pop().replace( '.spec.js', '' ) );
  return fileBase;
}
