/* global module, require */

module.exports = function( grunt ) {

	'use strict';

	var pkg = grunt.file.readJSON( 'package.json' );

	grunt.initConfig( {

		pkg: pkg,

		devUpdate: {
			packages: {
				options: {
					packageJson: null,
					packages: {
						devDependencies: true,
						dependencies: false
					},
					reportOnlyPkgs: [],
					reportUpdated: false,
					semver: true,
					updateType: 'force'
				}
			}
		},

		replace: {
			php: {
				overwrite: true,
				replacements: [
					{
						from: /@deprecated(\s+)NEXT/g,
						to: '@deprecated$1<%= pkg.version %>'
					},
					{
						from: /@since(\s+)NEXT/g,
						to: '@since$1<%= pkg.version %>'
					},
					{
						from: /@NEXT/g,
						to: '<%= pkg.version %>'
					},
					{
						from: /'MAVERICK_VERSION',(\s*)'[\w.+-]+'/,
						to: "'MAVERICK_VERSION',$1'<%= pkg.version %>'"
					}
				],
				src: [ '*.php', '**/*.php' ]
			},
			style_css: {
				overwrite: true,
				replacements: [
					{
						from: /Version:(\s*)[\w.+-]+/,
						to: 'Version:$1<%= pkg.version %>'
					}
				],
				src: [ 'style.css' ]
			}
		},

		makepot: {
			target: {
				options: {
					domainPath: 'languages/',
					include: [ '.+\.php' ],
					exclude: [ '.dev/', 'build/', 'temp/', 'node_modules/', 'vendor/' ],
					potComments: 'Copyright (c) {year} GoDaddy Operating Company, LLC. All Rights Reserved.',
					potHeaders: {
						'x-poedit-keywordslist': true
					},
					processPot: function( pot, options ) {
						pot.headers['report-msgid-bugs-to'] = pkg.repository.url;
						return pot;
					},
					type: 'wp-theme',
					updatePoFiles: true
				}
			}
		},

		potomo: {
			files: {
				expand: true,
				cwd: 'languages/',
				src: [ '*.po' ],
				dest: 'languages/',
				ext: '.mo',
				updatePoFiles: true,
				rename: function( dest, src ) {
					return dest + src.replace( pkg.name + '-', '' );
				}
			}
		}

	} );

	require( 'matchdep' ).filterDev( 'grunt-*' ).forEach( grunt.loadNpmTasks );

	grunt.registerTask( 'default',    [ 'replace' ] );
	grunt.registerTask( 'version',    [ 'replace' ] );
	grunt.registerTask( 'check',      [ 'devUpdate' ] );
	grunt.registerTask( 'update-pot', [ 'makepot' ] );
	grunt.registerTask( 'update-mo',  [ 'potomo' ] );
	grunt.registerTask( 'l10n',  [ 'update-pot', 'update-mo' ] );

};
