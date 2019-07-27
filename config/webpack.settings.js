/* global module */

// Webpack settings exports.
module.exports = {
	entries: {
		// JS files.
		'frontend': './assets/shared/js/frontend/frontend.js',

		// admin js
		'admin/customize-controls': './assets/admin/js/customize-controls.js',
		'admin/customize-preview': './assets/admin/js/customize-preview.js',

		// admin css
		'admin/customize-controls-styles': './assets/admin/css/customize-controls.css',

		// CSS files.
		'editor-style': './assets/shared/css/editor-style.css',
		'shared-style': './assets/shared/css/shared-style.css',

		// CSS Design Styles
		'design-styles/modern': './assets/design-styles/modern/css/modern.css',
		'design-styles/modern-editor': './assets/design-styles/modern/css/editor-style.css',
		'design-styles/traditional': './assets/design-styles/traditional/css/traditional.css',
		'design-styles/traditional-editor': './assets/design-styles/traditional/css/editor-style.css',
		'design-styles/trendy-shop': './assets/design-styles/trendy-shop/css/trendy-shop.css',
		'design-styles/trendy-shop-editor': './assets/design-styles/trendy-shop/css/editor-style.css',
		'design-styles/welcoming': './assets/design-styles/welcoming/css/welcoming.css',
		'design-styles/welcoming-editor': './assets/design-styles/welcoming/css/editor-style.css',
		'design-styles/play': './assets/design-styles/play/css/play.css',
		'design-styles/play-editor': './assets/design-styles/play/css/editor-style.css',
	},
	filename: {
		js: 'js/[name].js',
		css: 'css/[name].css'
	},
	paths: {
		src: {
			base: './assets/',
			sharedBase: './assets/shared/',
			sharedCss: './assets/shared/css/',
			sharedJs: './assets/shared/js/',
			adminCss: './assets/admin/css',
			modernBase: './assets/design-styles/modern/',
			modernCss: './assets/design-styles/modern/css/',
			traditionalBase: './assets/design-styles/traditional/',
			traditionalCss: './assets/design-styles/traditional/css/',
			trendyShopBase: './assets/design-styles/trendy-shop/',
			trendyShopCss: './assets/design-styles/trendy-shop/css/',
			welcomingBase: '/assets/design-styles/welcoming/',
			welcomingCss: './assets/design-styles/welcoming/css/',
			playBase: './assets/design-styles/play/',
			playCss: './assets/design-styles/play/css/'
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
		from: '**/*.{jpg,jpeg,png,gif,svg,eot,ttf,woff,woff2}',
		to: '[path][name].[ext]'
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
			'dist/svg/**/*.svg',
			'dist/images/**/*.{jpg,jpeg,png,gif}',
			'dist/fonts/**/*.{eot,ttf,woff,woff2,svg}'
		]
	},
	performance: {
		maxAssetSize: 100000
	},
	manifestConfig: {
		basePath: ''
	},
};
