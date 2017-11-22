//webpack.config.js
var path = require('path');
var nodeModulesPath = path.resolve(__dirname, 'node_modules');

var webpack = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

var extractPlugin = new ExtractTextPlugin({
	filename: '../style.css',
	publicPath: './'
});

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
		extractPlugin
	]
	//watch: true
};