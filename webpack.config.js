const webpack = require('webpack')
let path = require('path')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const autoprefixer = require('autoprefixer')

const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

const localUrl = 'http://local.braidwpstarter.com/'
const publicPath = '/wp-content/themes/braid-wp-starter/'

function resolve (dir) {
  return path.join(__dirname, '..', dir)
}

const webpackData = {
  entry: ['es6-promise/auto', './lib/js/app.js'],
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].[chunkhash].js',
    chunkFilename: '[id].[chunkhash].js',
		publicPath: publicPath
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
            'scss': [
              'vue-style-loader',
              'css-loader',
              'sass-loader',
              {
                loader: 'sass-resources-loader',
                options: {
                  resources: [
                    './lib/scss/utilities/_variables.scss',
                    './lib/scss/utilities/_custom-mixins.scss'
                  ]
                },
              }
            ],
            'sass': [
              'vue-style-loader',
              'css-loader',
              {
                loader: 'sass-loader',
                options: {
                  indentedSyntax: true
                }
              },
              {
                loader: 'sass-resources-loader',
                options: {
                  resources: [
                    './lib/scss/utilities/_variables.scss',
                    './lib/scss/utilities/_custom-mixins.scss'
                  ]
                },
              }
            ]
          }
        }
      },
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader'
      }
    ]
  },
  plugins: [
    new BundleAnalyzerPlugin(),
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
    new BrowserSyncPlugin(
      {
        host: 'localhost',
        proxy: localUrl,
        files: [
          {
            match: ['**/*.php'],
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
      }
    )
  ],
  devtool: 'inline-source-map'
}

module.exports = webpackData
