/* global module, require */

const merge = require( 'webpack-merge' );
const common = require( './webpack.common.js' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const OptimizeCssAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' );
const RtlCssPlugin = require( 'rtlcss-webpack-plugin' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const settings = require( './webpack.settings.js' );

module.exports = merge( common, {
	mode: 'development',
	devtool: 'inline-cheap-module-source-map',
	plugins: [
		new BrowserSyncPlugin(
			{
				host: settings.BrowserSyncConfig.host,
				port: settings.BrowserSyncConfig.port,
				proxy: settings.BrowserSyncConfig.proxy,
				open: settings.BrowserSyncConfig.open,
				files: settings.BrowserSyncConfig.files,
			},
			{
				injectCss: true,
				reload: false,
			}
		),
		new OptimizeCssAssetsPlugin( {
			assetNameRegExp: /\.*\.css$/g,
			cssProcessor: require( 'cssnano' ),
			cssProcessorPluginOptions: {
				preset: [ 'default' ],
			},
			canPrint: true
		} ),
	],
} );

if ( 'development' === process.env.NODE_ENV ) {

	let flags = [];

	if ( undefined !== process.argv[5] ) {

		flags = process.argv[5].replace( '--', '' ).split( ',' );

	}

	// Generate the RTL files when running `npm run start` and a --rtl flag is set
	if ( flags.includes( 'rtl' ) ) {
		module.exports.plugins.push(
			new RtlCssPlugin( { filename: 'css/[name]-rtl.css' } ),
		);

		if ( flags.includes( 'min' ) ) {
			module.exports.plugins.push(
				new MiniCssExtractPlugin( {
					filename: 'css/[name]-rtl.min.css',
					chunkFilename: '[id].css',
				} ),
			);
		}
	}

	// Minify both the standard .css file and the -rtl.css files when running `npm run start` and a --min flag is set
	if ( flags.includes( 'min' ) ) {
		module.exports.plugins.push(
			new MiniCssExtractPlugin( {
				filename: 'css/[name].min.css',
				chunkFilename: '[id].css',
			} ),
		);
	}
}
