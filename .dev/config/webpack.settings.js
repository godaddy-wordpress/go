/* global module */

// Webpack settings exports.
module.exports = {
	entries: {
		// Styles
		'style-shared-editor': './src/sass/shared/shared-editor.scss',
		'style-shared': './src/sass/shared/shared.scss',

		// Design styles
		'design-styles/style-modern': './src/sass/design-styles/modern/sass/style-modern.scss',
		'design-styles/style-modern-editor': './src/sass/design-styles/modern/sass/style-modern-editor.scss',

		'design-styles/style-traditional': './src/sass/design-styles/traditional/sass/style-traditional.scss',
		'design-styles/style-traditional-editor': './src/sass/design-styles/traditional/sass/style-traditional-editor.scss',

		'design-styles/style-trendy': './src/sass/design-styles/trendy/sass/style-trendy.scss',
		'design-styles/style-trendy-editor': './src/sass/design-styles/trendy/sass/style-trendy-editor.scss',

		'design-styles/style-welcoming': './src/sass/design-styles/welcoming/sass/style-welcoming.scss',
		'design-styles/style-welcoming-editor': './src/sass/design-styles/welcoming/sass/style-welcoming-editor.scss',

		'design-styles/style-playful': './src/sass/design-styles/playful/sass/style-playful.scss',
		'design-styles/style-playful-editor': './src/sass/design-styles/playful/sass/style-playful-editor.scss',

		// Customizer styles
		'admin/style-customize': './src/sass/customize/style-customize.scss',

		// JS.
		'js/frontend/frontend': './src/js/frontend/frontend.js',

		// Admin JS.
		'js/customize/customize-controls': './src/js/customize/customize-controls.js',
		'js/customize/customize-preview': './src/js/customize/customize-preview.js',
		'js/editor/block-filters': './src/js/editor/block-filters.js',
	},
	paths: {
		src: {
			base: './src/',
			sharedBase: './src/sass/shared/',
			sharedCss: './src/sass/shared/',
			adminCss: './src/sass/customize/',

			modernBase: './src/sass/design-styles/modern/',
			modernCss: './src/sass/design-styles/modern/sass/',

			traditionalBase: './src/sass/design-styles/traditional/',
			traditionalCss: './src/sass/design-styles/traditional/sass/',

			trendyBase: './src/sass/design-styles/trendy/',
			trendyCss: './src/sass/design-styles/trendy/sass/',

			welcomingBase: '/src/sass/design-styles/welcoming/',
			welcomingCss: './src/sass/design-styles/welcoming/sass/',

			playfulBase: './src/sass/design-styles/playful/',
			playfulCss: './src/sass/design-styles/playful/sass/'
		},
		dist: {
			base: './dist/',
			clean: ['./images', './css', './js']
		},
	},
	stats: {
		all: false,
		errors: true,
		maxModules: 0,
		modules: true,
		warnings: true,
		assets: true,
		errorDetails: true,
		excludeAssets: /\.(jpe?g|png|gif|svg|woff|woff2|ttf)$/i,
		moduleTrace: true,
		performance: true
	},
	copyWebpackConfig: {
		from: 'src/assets/**/*.{jpg,jpeg,png,gif,svg}',
		to: 'images/[path][name].[ext]',
		transformPath: ( targetPath ) => {
			return 'images/' + targetPath.replace( /(\src\/assets\/|images\/|shared\/)/g, '' );
		},
	},
	BrowserSyncConfig: {
		host: 'localhost',
		port: 3000,
		open: true,
		files: [
			'**/*.php',
			'dist/js/**/*.js',
			'dist/css/**/*.scss',
			'dist/images/**/*.{jpg,jpeg,png,gif,svg}'
		]
	},
	performance: {
		maxAssetSize: 100000
	},
	manifestConfig: {
		basePath: ''
	},
};
