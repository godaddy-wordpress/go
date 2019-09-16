/* global module, require */

const merge = require( 'webpack-merge' );
const common = require( './webpack.common.js' );
const BrowserSyncPlugin = require( 'browser-sync-webpack-plugin' );
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
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
