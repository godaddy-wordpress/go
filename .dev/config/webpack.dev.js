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
		new RtlCssPlugin( { filename: 'css/[name]-rtl.css' } ),
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

// Minify both the standard .css file and the -rtl.css files when running `npm run watch`
if ( 'development' === process.env.NODE_ENV ) {
	module.exports.plugins.push(
		new MiniCssExtractPlugin( {
			filename: 'css/[name].min.css',
			chunkFilename: '[id].css',
		} ),
		new MiniCssExtractPlugin( {
			filename: 'css/[name]-rtl.min.css',
			chunkFilename: '[id].css',
		} ),
	);
}
