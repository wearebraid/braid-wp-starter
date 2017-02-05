// gulp packages
var gulp = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var clean = require('gulp-clean');
var cleanCSS = require('gulp-clean-css');
var concat = require('gulp-concat');
var concatCss = require('gulp-concat-css');
var livereload = require('gulp-livereload');
var notify = require("gulp-notify");
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var watch = require('gulp-watch');




// ----
// gulp utilities
// ----

// on error function for plumber
var onError = function (err) {
    console.log(err);
    this.emit('end');
};



// Livereload
gulp.task('reload', function () {
    livereload({
        start: true,
        reloadPage: ''
    });
});




// remove all files from the dist folder
gulp.task('clean', function () {
    return gulp.src('./dist/**/*', {read: false})
        .pipe(clean());
});




// build
gulp.task('build', ['js', 'css']);




// watch task
gulp.task('watch', ['reload'], function () {
    livereload.listen();
    gulp.watch('./lib/scss/**/*.scss', ['css']);
    gulp.watch('./lib/js/*.js', ['js']);
});




// default task (run with "gulp" command)
gulp.task('default', ['build', 'watch']);



// ----
// gulp javascript section
// ----

// app.js files -- where almost all JS files should go
var appJS = [
    './lib/js/vendor/jquery.lazyload.min.js',
    // './lib/js/vendor/smoothscroll.js',
    // './lib/js/vendor/owl.carousel.min.js',
    './js/skip-link-focus-fix.js',
    './lib/js/script.js'
];


// modular JS processing tasks so we can run the same functions whether head or app js
function processJS(js, concatName) {
    return gulp.src(js)
        .pipe(plumber())
        .pipe(concat(concatName))
        .pipe(gulp.dest('./dist/'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/'))
        .pipe(livereload())
        .pipe(notify({
            title: "JS task complete",
            message: concatName + " generated and minified",
            onLast: true,
            sound: true
        }
    ));
}


// executes all js tasks
gulp.task('js', ['js-app']);



// body JS -- all the rest of the JS that goes right above the closing </body> tag.
gulp.task('js-app', function () {
    return processJS(appJS, 'app.js');
});





// ----
// gulp CSS section
// ----

var globalCss = [
    './node_modules/tachyons/css/tachyons.css',
    './lib/scss/**/*.scss',
];



// alias for "sass" task
gulp.task('css', ['sass']);



// modular CSS processing fimctopm so we can run multiple tasks through
function processCss(css, concatName) {
    return gulp.src(css)
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
        .pipe(concatCss(concatName))
        .pipe(gulp.dest('./dist'))
        .pipe(cleanCSS({debug: true, advanced: false}, function(details) {
            console.log(details.name + ' size before minifying: ' + details.stats.originalSize);
            console.log(details.name + ' size after: ' + details.stats.minifiedSize);
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./dist'))
        .pipe(notify({
            title: "sass task complete",
            message: concatName + " generated",
            onLast: true,
            sound: true
        }))
        .pipe(livereload());
}



// scss compile
gulp.task('sass', function () {
    return processCss(globalCss, 'app.css');
});