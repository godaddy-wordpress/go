/* global module */

// Webpack settings exports.
module.exports = {
	entries: {
		// JS.
		'frontend': './.dev/assets/shared/js/frontend/frontend.js',

		// CSS.
		'style-editor': './.dev/assets/shared/css/style-editor.css',
		'style-shared': './.dev/assets/shared/css/style-shared.css',

		// Design Style CSS.
		'design-styles/style-modern': './.dev/assets/design-styles/modern/css/style-modern.css',
		'design-styles/style-modern-editor': './.dev/assets/design-styles/modern/css/style-modern-editor.css',
		'design-styles/style-traditional': './.dev/assets/design-styles/traditional/css/style-traditional.css',
		'design-styles/style-traditional-editor': './.dev/assets/design-styles/traditional/css/style-traditional-editor.css',
		'design-styles/style-trendy': './.dev/assets/design-styles/trendy/css/style-trendy.css',
		'design-styles/style-trendy-editor': './.dev/assets/design-styles/trendy/css/style-trendy-editor.css',
		'design-styles/style-welcoming': './.dev/assets/design-styles/welcoming/css/style-welcoming.css',
		'design-styles/style-welcoming-editor': './.dev/assets/design-styles/welcoming/css/style-welcoming-editor.css',
		'design-styles/style-playful': './.dev/assets/design-styles/playful/css/style-playful.css',
		'design-styles/style-playful-editor': './.dev/assets/design-styles/playful/css/style-playful-editor.css',

		// Admin JS.
		'admin/customize-controls': './.dev/assets/admin/js/customize-controls.js',
		'admin/customize-preview': './.dev/assets/admin/js/customize-preview.js',
		'admin/block-filters': './.dev/assets/admin/js/block-filters.js',

		// Admin CSS.
		'admin/style-customize': './.dev/assets/admin/css/style-customize.css',
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
			welcomingBase: '/.dev/assets/design-styles/welcoming/',
			welcomingCss: './.dev/assets/design-styles/welcoming/css/',
			playfulBase: './.dev/assets/design-styles/playful/',
			playfulCss: './.dev/assets/design-styles/playful/css/'
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
		from: '.dev/assets/**/*.{jpg,jpeg,png,gif,svg}',
		to: 'images/[path][name].[ext]',
		transformPath: ( targetPath ) => {
			return 'images/' + targetPath.replace( /(\.dev\/assets\/|images\/|shared\/)/g, '' );
		},
	},
	BrowserSyncConfig: {
		host: 'localhost',
		port: 3000,
		proxy: 'https://go.test',
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
