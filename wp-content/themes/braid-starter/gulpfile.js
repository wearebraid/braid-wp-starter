'use strict';

var proxy_url = 'local.braidwpstarter.com';  // REPLACE THIS WITH YOUR LOCAL DEV URL
var proxy_secure = false;     // SET PROXY TO USE HTTPS OR HTTP

// PUT ALL FONT FILES USED HERE TO BE COPIED INTO BUILD DIRECTORY
var fonts = [
  './node_modules/font-awesome/fonts/*',
];

var appJS = ['./lib/js/script.js'];

/* ----------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------- */
/* YOU SHOULDN'T NEED TO MODIFY ANYTHING BELOW HERE UNLESS YOU WANT TO ADD NEW FUNCTIONALITY */
/* ----------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------- */


var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserify = require('gulp-browserify'),
    browserSync = require('browser-sync'),
    cssnano = require('gulp-cssnano'),
    cleanCSS = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps'),
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish'),
    uglify = require('gulp-uglify'),
    babel = require('gulp-babel'),
    rename = require('gulp-rename'),
    plumber = require('gulp-plumber'),
    notify = require("gulp-notify"),
    concat = require('gulp-concat');


var onError = function (err) {
    console.log(err);
    this.emit('end');
};

 
// COMPILE THEME SASS FILE
gulp.task('sass', function () {
    return gulp.src('./lib/scss/style.scss')
        .pipe(sourcemaps.init())
        .pipe(plumber({
            errorHandler: onError
        }))
        .pipe(sass())
        .on('error', notify.onError({
            title: "SCSS compilation failed",
            message: "<%= error.message %>"
        }))
        .pipe(autoprefixer({
            browsers: ['> 1%', 'Safari >= 8'],
            cascade: false
        }))
        .pipe(cleanCSS({debug: true, advanced: false}, function(details) {
            console.log(details.name + ' size before minifying: ' + details.stats.originalSize);
            console.log(details.name + ' size after: ' + details.stats.minifiedSize);
        }))
        .pipe(rename({
            basename: "app",
            suffix: ".min",
            extname: ".css"
          }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./dist/css'))
        .pipe(notify({
            title: "Sass compiled successfully!",
            onLast: true,
            sound: true
        }))
});


// COPY ALL FONTS INTO FONT BUILD DIRECTORY
gulp.task('fonts', function () {
  return gulp.src(fonts)
    .pipe(gulp.dest('./dist/fonts/'));
});


// MINIFY THEME JS FILE
gulp.task('script', function() {
  return gulp.src(appJS)
    .pipe(plumber())
    .pipe(concat('app.min.js'))
    .pipe(sourcemaps.init())
    .pipe(browserify({
      insertGlobals : true,
      debug : false
    }))
    .pipe(gulp.dest('./dist/js/'))
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('./dist/js/'))
    .pipe(notify({
        title: "Scripts compiled successfully!",
        onLast: true,
        sound: true
    }))
});


// BROWSERSYNC AND WATCH
gulp.task('watch', function () {
  var files = [
    './dist/css/*.css', 
    './dist/js/*.js',
    '**/*.php',
    'images/**/*.{png,jpg,gif,svg,webp}',
  ];

  browserSync.init(files, { 
    https: proxy_secure,
    proxy: {
        target: proxy_url
    },
  });

  gulp.watch('lib/scss/**/*.scss', ['sass']);
  gulp.watch('lib/js/**/*.js', ['script']);
});


gulp.task('default', ['production','watch']);
gulp.task('production', ['fonts','script','sass']);
