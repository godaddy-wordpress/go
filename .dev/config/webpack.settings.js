/* global module */

// Webpack settings exports.
module.exports = {
	entries: {
		// JS files.
		'frontend': './.dev/assets/shared/js/frontend/frontend.js',

		// admin js
		'admin/customize-controls': './.dev/assets/admin/js/customize-controls.js',
		'admin/customize-preview': './.dev/assets/admin/js/customize-preview.js',
		'admin/block-filters': './.dev/assets/admin/js/block-filters.js',

		// admin css
		'admin/style-customize': './.dev/assets/admin/css/style-customize.css',

		// CSS files.
		'style-editor': './.dev/assets/shared/css/style-editor.css',
		'style-shared': './.dev/assets/shared/css/style-shared.css',

		// CSS Design Styles
		'design-styles/style-modern': './.dev/assets/design-styles/modern/css/style-modern.css',
		'design-styles/style-modern-editor': './.dev/assets/design-styles/modern/css/style-modern-editor.css',
		'design-styles/style-traditional': './.dev/assets/design-styles/traditional/css/style-traditional.css',
		'design-styles/style-traditional-editor': './.dev/assets/design-styles/traditional/css/style-traditional-editor.css',
		'design-styles/style-trendy': './.dev/assets/design-styles/trendy/css/style-trendy.css',
		'design-styles/style-trendy-editor': './.dev/assets/design-styles/trendy/css/style-trendy-editor.css',
		// 'design-styles/welcoming': './.dev/assets/design-styles/welcoming/css/welcoming.css',
		// 'design-styles/welcoming-editor': './.dev/assets/design-styles/welcoming/css/editor-style.css',
		// 'design-styles/play': './.dev/assets/design-styles/play/css/play.css',
		// 'design-styles/play-editor': './.dev/assets/design-styles/play/css/editor-style.css',
	},
	paths: {
		src: {
			base: './.dev/assets/',
			sharedBase: './.dev/assets/shared/',
			sharedCss: './.dev/assets/shared/css/',
			sharedJs: './.dev/assets/shared/js/',
			adminCss: './.dev/assets/admin/css',
			modernBase: './.dev/assets/design-styles/modern/',
			modernCss: './.dev/assets/design-styles/modern/css/',
			traditionalBase: './.dev/assets/design-styles/traditional/',
			traditionalCss: './.dev/assets/design-styles/traditional/css/',
			trendyBase: './.dev/assets/design-styles/trendy/',
			trendyCss: './.dev/assets/design-styles/trendy/css/',
			// welcomingBase: '/.dev/assets/design-styles/welcoming/',
			// welcomingCss: './.dev/assets/design-styles/welcoming/css/',
			// playBase: './.dev/assets/design-styles/play/',
			// playCss: './.dev/assets/design-styles/play/css/'
		},
		dist: {
			base: './dist/',
			clean: ['./images', './css', './js']
		},
	},
	stats: {
		// Copied from `'minimal'`.
		all: false,
		errors: true,
		maxModules: 0,
		modules: true,
		warnings: true,
		// Our additional options.
		assets: true,
		errorDetails: true,
		excludeAssets: /\.(jpe?g|png|gif|svg|woff|woff2|ttf)$/i,
		moduleTrace: true,
		performance: true
	},
	copyWebpackConfig: {
		from: '.dev/assets/**/*.{jpg,jpeg,png,gif,svg}',
		to: 'images/[path][name].[ext]',
		transformPath: ( targetPath ) => {
			return 'images/' + targetPath.replace( /(\.dev\/assets\/|images\/|shared\/)/g, '' );
		},
	},
	BrowserSyncConfig: {
		host: 'localhost',
		port: 3000,
		proxy: 'http://maverick.test',
		open: true,
		files: [
			'**/*.php',
			'dist/js/**/*.js',
			'dist/css/**/*.css',
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
