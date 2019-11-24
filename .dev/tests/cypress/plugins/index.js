// cypress/plugins/index.js

const fs         = require( 'fs' );
const rmdir      = require( 'rmdir' );
const PNG        = require( 'pngjs' ).PNG;
const pixelmatch = require( 'pixelmatch' );
const request    = require( 'request' );
const download   = require( 'image-downloader' );

module.exports = ( on, config ) => {
  on( 'after:screenshot', ( details ) => {
    const dir      = process.cwd() + '/.dev/tests/cypress/screenshots/' + ( ( details.name ).split( '/' ).slice( 0, -1 ).join( '/' ) );
    const newPath  = process.cwd() + '/.dev/tests/cypress/screenshots/' + details.name + '.png';

    if ( ! fs.existsSync( dir ) ) {
      fs.mkdirSync( dir );
    }

    return new Promise( ( resolve, reject ) => {
      fs.rename( details.path, newPath, ( err ) => {
        if ( err ) {
          return reject( err );
        }
        // because we renamed/moved the image, resolve with the new path so it is accurate in the test results
        resolve( { path: newPath } );
      } );

      // Remove the screenshots/visual-regression-tests/ directory
      rmdir( process.cwd() + '/.dev/tests/cypress/screenshots/visual-regression-tests/' );

      // If this is not one of the visual-regression-tests/templates tests or it is not 'compare' screenshot
      if ( details.specName.indexOf( 'visual-regression-tests/templates/' ) === -1 || details.name.indexOf( 'compare/' ) === -1 ) {
        return;
      }

      // Make the screenshots/diff directory if it does not yet exist
      if ( ! fs.existsSync( process.cwd() + '/.dev/tests/cypress/screenshots/diff' ) ) {
        fs.mkdirSync( process.cwd() + '/.dev/tests/cypress/screenshots/diff' );
      }

      var templateData = details.name.split( 'compare/' ).pop().split( '-' ),
          templateName = templateData[0], // eg: keynote
          snapshotType = templateData[1], // eg: iphone
          baseImageURL = 'https://raw.githubusercontent.com/EvanHerman/go-base-snapshots/master/snapshots/' + templateName + '-' + snapshotType + '.png';

      download.image( {
        'url': baseImageURL,
        'dest': '.dev/tests/cypress/screenshots/base/' + templateName + '-' + snapshotType + '.png'
      } )
      .then( ( { filename, image } ) => {
        // Run the visual regression tests on the images
        const baseImage         = PNG.sync.read( fs.readFileSync( filename ) );
        const compareImage      = PNG.sync.read( fs.readFileSync( newPath ) );
        const { width, height } = baseImage;
        const diff              = new PNG( { width, height } );

        var pixelErrors = pixelmatch( baseImage.data, compareImage.data, diff.data, width, height, { threshold: 0.1 } );

        if ( 0 < pixelErrors ) {
          fs.writeFileSync( newPath.replace( 'compare', 'diff' ), PNG.sync.write( diff ) );
          throw new Error( details.name + ' did not match its base image. There was a total of ' + pixelErrors + ' mismatched pixels.' );
        }
      } )
      .catch( ( err ) => console.error( err ) );
    } );
  } );
}
