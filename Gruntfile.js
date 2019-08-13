/* global module, require */

module.exports = function( grunt ) {

	'use strict';

	var pkg = grunt.file.readJSON( 'package.json' );

	grunt.initConfig( {

		pkg: pkg,

		clean: {
			options: {
				force: true
			},
			docs: [ '.dev/docs/sphinx/src/documentation/' ]
		},

		copy: {
			docs_html: {
				expand: true,
				cwd: '.dev/docs/sphinx/src/documentation/',
				src: [ '**/*' ],
				dest: '.dev/docs/build/html/documentation/'
			},
			docs_landing: {
				expand: true,
				cwd: '.dev/docs/sphinx/src/build/html/',
				src: [ '**/*.html' ],
				dest: '.dev/docs/build/html/'
			},
			readme: {
				expand: true,
				dot: true,
				cwd: '.',
				dest: '.dev/docs/sphinx/src/',
				src: [ 'readme.md' ],
				rename: function( dest, src ) {
					return dest + src.replace( 'readme', 'intro' );
				}
			}
		},

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

		imagemin: {
			options: {
				optimizationLevel: 3
			},
			assets: {
				expand: true,
				cwd: 'assets/images/',
				src: [ '**/*.{gif,jpeg,jpg,png,svg}' ],
				dest: 'assets/images/'
			},
			screenshot: {
				files: {
					'screenshot.png': 'screenshot.png'
				}
			}
		},

		replace: {
			charset: {
				overwrite: true,
				replacements: [
					{
						from: /^@charset "UTF-8";\n/,
						to: ''
					}
				],
				src: [ 'style*.css' ]
			},
			docs: {
				overwrite: true,
				replacements: [
					{
						from: /Primer Theme v[\w.+-]+/m,
						to: 'Primer Theme v' + pkg.version
					}
				],
				src: [
					'.dev/docs/apigen/godaddy/**/*.latte',
					'.dev/docs/sphinx/godaddy/**/*.html'
				]
			},
			docs_version: {
				overwrite: true,
				replacements: [
					{
						from: /activeVersion: \'[\w.+-]+\'/m,
						to: 'activeVersion: \'' + pkg.version + '\''
					}
				],
				src: [
					'.dev/docs/apigen/godaddy/config.neon'
				]
			},
			intro: {
				overwrite: true,
				replacements: [
					{
						from: /^\[!\[(.|\r|\n)*## Description ##/m, // Badges cause errors in the sphinx build process
						to: '## Description ##'
					},
					{
						from: /  $/gm,
						to: '<br />'
					}
				],
				src: [ '.dev/docs/sphinx/src/intro.md' ]
			},
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
						from: /'PRIMER_VERSION',(\s*)'[\w.+-]+'/,
						to: "'PRIMER_VERSION',$1'<%= pkg.version %>'"
					}
				],
				src: [ '*.php', 'inc/**/*.php', 'templates/**/*.php' ]
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
			sass: {
				overwrite: true,
				replacements: [
					{
						from: /Version:(\s*)[\w.+-]+/,
						to: 'Version:$1<%= pkg.version %>'
					}
				],
				src: [ '.dev/sass/**/*.scss' ]
			}
		}

	} );

	require( 'matchdep' ).filterDev( 'grunt-*' ).forEach( grunt.loadNpmTasks );

	grunt.registerTask( 'default', [ 'replace:charset', 'imagemin' ] );
	grunt.registerTask( 'check',   [ 'devUpdate' ] );
	grunt.registerTask( 'version', [ 'replace', 'default', 'clean' ] );

};
