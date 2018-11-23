 var path = require('path');
 var webpack = require('webpack');

 module.exports = {
     entry: path.resolve(__dirname, '/resources/assets/js/app.js'),
     output: {
         path: path.resolve(__dirname, 'dist'),
         filename: 'bundle.js',
		 publicPath: '/dist'
     },
	 module: {
		 rules: [
			{
				test: /\.js$/,
				use: {
					loader: "babel-loader",
					options: {
						presets: ["es2015"]
					}
				}
			},

		 ]
	},
     plugins: [
     	new webpack.ProvidePlugin({
			$: 'jquery',
            jQuery: 'jquery'
		})
	 ]
 };
