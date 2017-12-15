//webpack.config.js
var path = require('path');
var nodeModulesPath = path.resolve(__dirname, 'node_modules');

var webpack = require('webpack');

//this is major, it creates the new files and places their respective content types in them.  By default, WebPack usuaully outputs inline.
const ExtractTextPlugin = require("extract-text-webpack-plugin");
//const compiler = webpack(config);

//minify the final javascript
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

//file handling
var fs = require('fs');


//part of the hack to have a correct relative path css final file, alone with relative paths
const cssOutPreFinalName = "style.prefinal.css";
const cssOutFinalName = "style.dist.css";

const cssOutPreFinalPath = "./" + cssOutPreFinalName;
const cssOutFinalPath = "./" + cssOutFinalName;

//this does the actual work of generating the preFinal file
var extractPlugin = new ExtractTextPlugin({
	filename: '../' + cssOutPreFinalName,
	publicPath: './'
});

//default settting for whether build or buildprod.  If it is buildprod, then css and javascript will be minified/uglified
var ENV = "build";

//get the way this was launched, dev vs prod.  **NOTE:** Will only occur if launched from an NPM run-script.
if( process.env.hasOwnProperty("npm_lifecycle_event") ){
	ENV = process.env.npm_lifecycle_event;
}

const isProd = ( ENV.indexOf("prod") > -1 )? true : false;

console.log('env is:', ENV);


//determine whether this is in watch mode
const isTheWatcher = process.argv.find(v => v.includes('--watch'));

//a cleanup hack to deal with webpack -> sass-loader tantrums with certain paths that passes under its radar
var karlsRelativePathHack = function(){
	require.extensions['.css'] = function (module, filename) {
		module.exports = fs.readFileSync(filename, 'utf8');
	};

	if (fs.existsSync(cssOutPreFinalPath)) {
		var cssPreFinalContent = require(cssOutPreFinalPath);

		//the pattern we wish to search for, then replace in the css file
		var pattern = "/wp-content/themes/serenti";
		var re = new RegExp(pattern, "g");

		//create a new version of the css content with a more absolute path.
		var cssContentCorrected = cssPreFinalContent.replace( re, "." );

		//write the new content to the file.
		fs.writeFile(cssOutFinalPath, cssContentCorrected, function(err) {
			if(err) {
				return console.log(err);
			}

			console.log("The file was saved!");

			//get rid of the temp file, if it exists.
			//if (fs.existsSync(cssOutPreFinalPath)) {
				fs.unlink( cssOutPreFinalPath );
			//}

			//terminate the process
			if( typeof(isTheWatcher) !== "string" ){
				//process.exit(0);
			}
		});
	}
} //end function karlsRelativePathHack

//file watcher for the prefinal css file.  Only used if webpack is in '--watch' mode.
var krpFSwatch = function(){
	if (fs.existsSync(cssOutPreFinalPath)) {
		fs.watchFile(cssOutPreFinalPath, function(eventType, filename) {

			//execute above function
			karlsRelativePathHack();
		});
	}// end if (fs.existsSync(cssOutPreFinalPath))
}

//master function for the hack, executed as a member of the exports plugins array, in all webpack scenarios.
var krpIntWait = function(){
	var intw = arguments.length <= 0 || arguments[0] === undefined ? 500 : arguments[0];

	var intervalChecker = setInterval(function(){ 
		if (fs.existsSync(cssOutPreFinalPath)) {
			if( typeof(isTheWatcher) === "string" ){
				krpFSwatch();
			}else{
				karlsRelativePathHack();
			}

			clearInterval(intervalChecker);
		}

	}, intw);
}

//uglifyJs is used for production builds
var pluginOptions = isProd === true ? [extractPlugin, new UglifyJsPlugin(), krpIntWait] : [extractPlugin, krpIntWait];


module.exports = {
	entry: './js/src/serenti.js',
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
					use: [{ loader: 'css-loader', options: { minimize: isProd }}]
				})
			},

			{
				test: /\.scss$/,
				use: extractPlugin.extract({
					use: [{ loader: 'css-loader', options: { minimize: isProd }}, 'sass-loader']
				})
			}
		]
	},
	plugins: pluginOptions
	//watch: true
};