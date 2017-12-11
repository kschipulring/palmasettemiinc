//webpack.config.js
var path = require('path');
var nodeModulesPath = path.resolve(__dirname, 'node_modules');

var webpack = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
//const compiler = webpack(config);

var extractPlugin = new ExtractTextPlugin({
	filename: '../style.css',
	publicPath: './'
});


/*
//so we can use the app object or whatever for the friendly plugin below
var express = require("express");

var app = express();

var FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');

app.use(require('webpack-dev-middleware')(compiler, {
	quiet: true,
	publicPath: path.resolve(__dirname, 'js')
	//publicPath: config.output.publicPath,
}));

*/


module.exports = {
	entry: './js/serenti.js',
	output: {
		path: path.resolve(__dirname, 'js'),
		filename: 'bundle.js'
	},
	devtool: 'inline-source-map',
	module: {
		rules: [
			{
				test: /\.jsx?$/,
				use: [
					{
						loader: 'babel-loader',
						options: {
							presets: ['es2015']
						}
					}
				],
				'exclude': [/node_modules/,nodeModulesPath]
			},
			
			{
				test: /\.css$/,
				exclude: /node_modules/,
				use: extractPlugin.extract({
					use: ['css-loader']
				})
			},

			{
				test: /\.scss$/,
				use: extractPlugin.extract({
					use: ['css-loader', 'sass-loader']
				})
			}
		]
	},
	plugins: [
		extractPlugin,
		//new FriendlyErrorsWebpackPlugin()
	]
	//watch: true
};