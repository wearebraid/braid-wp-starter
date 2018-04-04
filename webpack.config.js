const webpack = require('webpack')
let path = require('path')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const autoprefixer = require('autoprefixer')

const localUrl = 'http://local.braidwpstarter.com/'

function resolve (dir) {
  return path.join(__dirname, '..', dir)
}

const webpackData = {
  entry: {
    main: './lib/js/app.js'
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: process.argv.includes('-p') ? '[name].[chunkhash].js' : '[name].js',
    chunkFilename: process.argv.includes('-p') ? '[id].[chunkhash].js' : '[id].js',
		publicPath: '/app/themes/southern-eagle/dist/'
  },
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
      '@': resolve('src')
    }
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: ExtractTextPlugin.extract({
          use: [
            {loader: 'css-loader', options: { sourceMap: true, autoprefixer: true }},
            {loader: 'postcss-loader', options: { sourceMap: true }},
            {loader: 'sass-loader', options: { sourceMap: true }}
          ],
          fallback: 'style-loader'
        })
      },
      {
        test: /\.(png|jpg|gif|svg|eot|ttf|woff|woff2)$/,
        loader: 'url-loader',
        options: {
          limit: 1000
        }
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          loaders: {
            'scss': 'vue-style-loader!css-loader!sass-loader',
            'sass': 'vue-style-loader!css-loader!sass-loader?indentedSyntax'
          }
        }
      },
      {
        test: /\.js$/,
        loader: 'babel-loader',
        include: ['lib/js'],
        exclude: /(node_modules|bower_components)/
      }
    ]
  },
  plugins: [
    new CleanWebpackPlugin('./dist', {
      root: __dirname,
      verbose: true,
      dry: false
    }),
    function () {
      this.plugin('done', stats => {
        require('fs').writeFileSync(
          path.join(__dirname, './dist/manifest.json'),
          JSON.stringify(stats.toJson().entrypoints.main.assets)
        )
      })
    },
    new ExtractTextPlugin('build.css'),
    new webpack.DefinePlugin({
      'process.env': {
        'NODE_ENV': process.argv.includes('-p') ? `'production'` : `'development'`
      }
    }),
    new webpack.LoaderOptionsPlugin({
      minimize: process.argv.includes('-p'),
      options: {
        postcss: [autoprefixer]       
      }
    }),
    new webpack.HashedModuleIdsPlugin(),
    new webpack.optimize.CommonsChunkPlugin({
      name: 'vendor',
      minChunks: function (module, count) {
        return (
          module.resource &&
          /\.js$/.test(module.resource) &&
          module.resource.indexOf(
            path.join(__dirname, 'node_modules')
          ) === 0
        )
      }
    }),
    new webpack.optimize.CommonsChunkPlugin({
      name: 'manifest',
      chunks: ['vendor']
    }),
  ],
  devtool: 'inline-source-map'
}

if (process.env === 'production') {
  webpackData.plugins.push(
    new UglifyJSPlugin({
      sourceMap: true,
      uglifyOptions: { ecma: 8 },
    })
  )
} else {
  webpackData.plugins.push(
    new BrowserSyncPlugin({
      host: 'localhost',
      proxy: localUrl,
      files: [
        {
          match: [
            '**/*.php'
          ],
          fn: function(event, file) {
            if (event === "change") {
              const bs = require('browser-sync').get('bs-webpack-plugin');
              bs.reload();
            }
          }
        }
      ]
    },
    {
      injectCss: true
    })
  )
}

module.exports = webpackData
