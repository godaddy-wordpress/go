/**
 * External dependencies
 */
const path = require( 'path' );
const WebpackBar = require( 'webpackbar' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const CopyWebpackPlugin = require( 'copy-webpack-plugin' );
const TerserPlugin = require( 'terser-webpack-plugin' );

/**
 * Internal dependencies
 */
const isProduction = process.env.NODE_ENV === 'production';
try {
	var localEnv = require( './local.json' ).devURL;
} catch ( err ) {
	// Fallback if it does not
	var localEnv = 'https://coblocks.test';
}

let entry = {
	// Styles
	'css/style-shared': path.resolve( process.cwd(), 'src/sass/shared', 'shared.scss' ),
	'css/style-shared-editor': path.resolve( process.cwd(), 'src/sass/shared', 'shared-editor.scss' ),

	// Design styles
	'css/design-styles/style-modern': path.resolve( process.cwd(), 'src/sass/design-styles/modern/sass', 'style-modern.scss' ),
	'css/design-styles/style-modern-editor': path.resolve( process.cwd(), 'src/sass/design-styles/modern/sass', 'style-modern-editor.scss' ),

	'css/design-styles/style-traditional': path.resolve( process.cwd(), 'src/sass/design-styles/traditional/sass', 'style-traditional.scss' ),
	'css/design-styles/style-traditional-editor': path.resolve( process.cwd(), 'src/sass/design-styles/traditional/sass', 'style-traditional-editor.scss' ),

	'css/design-styles/style-trendy': path.resolve( process.cwd(), 'src/sass/design-styles/trendy/sass', 'style-trendy.scss' ),
	'css/design-styles/style-trendy-editor': path.resolve( process.cwd(), 'src/sass/design-styles/trendy/sass', 'style-trendy-editor.scss' ),

	'css/design-styles/style-welcoming': path.resolve( process.cwd(), 'src/sass/design-styles/welcoming/sass', 'style-welcoming.scss' ),
	'css/design-styles/style-welcoming-editor': path.resolve( process.cwd(), 'src/sass/design-styles/welcoming/sass', 'style-welcoming-editor.scss' ),

	'css/design-styles/style-playful': path.resolve( process.cwd(), 'src/sass/design-styles/playful/sass', 'style-playful.scss' ),
	'css/design-styles/style-playful-editor': path.resolve( process.cwd(), 'src/sass/design-styles/playful/sass', 'style-playful-editor.scss' ),

	// Customizer styles
	'css/customize/style-customize': path.resolve( process.cwd(), 'src/sass/customize', 'style-customize.scss' ),

	// Frontend scripts
	'js/frontend': path.resolve( process.cwd(), 'src/js/frontend', 'frontend.js' ),

	// Customizer scripts
	'js/customize/customize-controls': path.resolve( process.cwd(), 'src/js/customize', 'customize-controls.js' ),
	'js/customize/customize-preview': path.resolve( process.cwd(), 'src/js/customize', 'customize-preview.js' ),

	// Editor scripts
	'js/editor/block-filters': path.resolve( process.cwd(), 'src/js/editor', 'block-filters.js' ),
};

if ( isProduction ) {
	entry = {
	        ...entry,
	        // Styles
		'css/style-shared.min': path.resolve( process.cwd(), 'src/sass/shared', 'shared.scss' ),
		'css/style-shared-editor.min': path.resolve( process.cwd(), 'src/sass/shared', 'shared-editor.scss' ),

		// Design styles
		'css/design-styles/style-modern.min': path.resolve( process.cwd(), 'src/sass/design-styles/modern/sass', 'style-modern.scss' ),
		'css/design-styles/style-modern-editor.min': path.resolve( process.cwd(), 'src/sass/design-styles/modern/sass', 'style-modern-editor.scss' ),

		'css/design-styles/style-traditional.min': path.resolve( process.cwd(), 'src/sass/design-styles/traditional/sass', 'style-traditional.scss' ),
		'css/design-styles/style-traditional-editor.min': path.resolve( process.cwd(), 'src/sass/design-styles/traditional/sass', 'style-traditional-editor.scss' ),

		'css/design-styles/style-trendy.min': path.resolve( process.cwd(), 'src/sass/design-styles/trendy/sass', 'style-trendy.scss' ),
		'css/design-styles/style-trendy-editor.min': path.resolve( process.cwd(), 'src/sass/design-styles/trendy/sass', 'style-trendy-editor.scss' ),

		'css/design-styles/style-welcoming.min': path.resolve( process.cwd(), 'src/sass/design-styles/welcoming/sass', 'style-welcoming.scss' ),
		'css/design-styles/style-welcoming-editor.min': path.resolve( process.cwd(), 'src/sass/design-styles/welcoming/sass', 'style-welcoming-editor.scss' ),

		'css/design-styles/style-playful.min': path.resolve( process.cwd(), 'src/sass/design-styles/playful/sass', 'style-playful.scss' ),
		'css/design-styles/style-playful-editor.min': path.resolve( process.cwd(), 'src/sass/design-styles/playful/sass', 'style-playful-editor.scss' ),

		// Customizer styles
		'css/customize/style-customize.min': path.resolve( process.cwd(), 'src/sass/customize', 'style-customize.scss' ),

		// Frontend scripts
		'js/frontend.min': path.resolve( process.cwd(), 'src/js/frontend', 'frontend.js' ),

		// Customizer scripts
		'js/admin/customize-controls.min': path.resolve( process.cwd(), 'src/js/customize', 'customize-controls.js' ),
		'js/admin/customize-preview.min': path.resolve( process.cwd(), 'src/js/customize', 'customize-preview.js' ),

		// Editor scripts
		'js/editor/block-filters.min': path.resolve( process.cwd(), 'src/js/editor', 'block-filters.js' ),
	};
}

module.exports = {
	...defaultConfig,

	entry,

	optimization: {
		minimize: isProduction ? true : false,
		minimizer: [
			new TerserPlugin({
				cache: true,
				parallel: true,
				sourceMap: false,
				include: /\/dist/,
				terserOptions: {
					parse: {
						ecma: 8
					},
					compress: {
						ecma: 5,
						warnings: false,
						comparisons: false,
						inline: 2
					},
					output: {
						ecma: 5,
						comments: false
					},
					ie8: false
				}
			}),
		],
	},

	plugins: [
		...defaultConfig.plugins,

		new WebpackBar( {
			name: isProduction ? 'Building Go...' : 'Starting Go...',
			color: '#08757a',
		}),

		new BrowserSyncPlugin(
			{
				host: 'localhost',
				port: 3000,
				proxy: localEnv,
				open: true,
				files: [
					'**/*.php',
					'dist/js/**/*.js',
					'dist/css/**/*.css',
					// 'dist/images/**/*.{jpg,jpeg,png,gif,svg}'
				]
			},
			{
				injectCss: true,
				reload: false,
			}
		),

		// copyWebpackConfig: {
		// 	from: '.dev/src/**/*.{jpg,jpeg,png,gif,svg}',
		// 	to: 'images/[path][name].[ext]',
		// 	transformPath: ( targetPath ) => {
		// 		return 'images/' + targetPath.replace( /(\/assets\/|images\/)/g, '' );
		// 	},
		// },

		new CopyWebpackPlugin( [
			{
				from: 'src/**/**/**/*.{jpg,jpeg,png,gif,svg}',
				to: 'images/[path][name].[ext]',
				transformPath( targetPath ) {
					return 'images/' + targetPath.replace( /(\/|sass)/g, '' );
				},
			}
		] ),
	],
};
