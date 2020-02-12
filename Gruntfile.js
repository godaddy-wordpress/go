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
						from: /'GO_VERSION',(\s*)'[\w.+-]+'/,
						to: "'GO_VERSION',$1'<%= pkg.version %>'"
					},
					{
						from: /'[\w.+-]+',(\s*)GO_VERSION/,
						to: "'<%= pkg.version %>',$1GO_VERSION"
					}
				],
				src: [ '*.php', '**/*.php', '.dev/tests/php/test-functions.php' ]
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
			},
			readme: {
				overwrite: true,
				replacements: [
					{
						from: /Stable tag:(\s*)[\w.+-]+/,
						to: 'Stable tag:$1<%= pkg.version %>'
					}
				],
				src: [ 'readme.txt' ]
			},
			readme_md: {
				overwrite: true,
				replacements: [
					{
						from: /goVersion=&message=v[\w.+-]+&/,
						to: 'goVersion=&message=v<%= pkg.version %>&'
					}
				],
				src: [ 'readme.md' ]
			}
		}

	} );

	require( 'matchdep' ).filterDev( 'grunt-*' ).forEach( grunt.loadNpmTasks );

	grunt.registerTask( 'default', [ 'version' ] );
	grunt.registerTask( 'version', [ 'replace' ] );
	grunt.registerTask( 'check',   [ 'devUpdate' ] );

};
