var gulp = require('gulp');
var less = require('gulp-less');
var css_min = require('gulp-minify-css');
var concat = require('gulp-concat');
var js_min = require('gulp-uglify');
var gzip = require('gulp-gzip');
var phpunit = require('gulp-phpunit');
var imagemin = require('gulp-imagemin');

var components = 'bower_components/';
var assets = 'assets/';
var destination = 'public/';

var bootstrap = components + 'bootstrap/';
var bootswatch = components + 'bootswatch/flatly/';
var jquery = components + 'jquery/dist/jquery.js';
var summernote = components + 'summernote/dist/';
var fontawesome = components + 'fontawesome/';
var datetimepicker = components + 'eonasdan-bootstrap-datetimepicker/';
var moment = components + 'moment/min/';
var dropzone = components + "dropzone/downloads/";

var paths = {
    bootswatch : bootswatch + 'bootstrap.min.css',
    less: [
        //bootswatch + 'bootstrap.min.css',
        fontawesome + 'css/font-awesome.min.css',
        summernote + 'summernote.css',
        'assets/less/style.less'
    ],
    datetimepicker_css : datetimepicker + 'build/css/bootstrap-datetimepicker.min.css',
    datetimepicker_js : [
        moment + 'moment.min.js',
        datetimepicker + 'build/js/bootstrap-datetimepicker.min.js'
    ],
    dropzone_css : dropzone + "css/dropzone.css",
    dropzone_js : dropzone + "dropzone.min.js",
    dropzone_img : dropzone + "images/*",
    js: [
        jquery,
        bootstrap + 'js/transition.js',
        bootstrap + 'js/alert.js',
        bootstrap + 'js/modal.js',
        bootstrap + 'js/dropdown.js',
        bootstrap + 'js/scrollspy.js',
        bootstrap + 'js/tab.js',
        bootstrap + 'js/tooltip.js',
        bootstrap + 'js/popover.js',
        bootstrap + 'js/button.js',
        bootstrap + 'js/collapse.js',
        bootstrap + 'js/carousel.js',
        bootstrap + 'js/affix.js',
        summernote + 'summernote.min.js',
        assets + 'js/pageblok.js'
    ],
    images: assets + 'img/**/*',
    fonts: [
        bootstrap + 'fonts/*',
        fontawesome + 'fonts/*'
    ],
    phpunit: {
        runner: './vendor/bin/phpunit',
        config: './phpunit.xml',
        tests: './tests/src/Pageblok/**/*.php'
    }
};

gulp.task('bootswatch', function() {
    return gulp.src(paths.bootswatch)
        .pipe(gulp.dest(destination + 'css'))
        .pipe(gzip({threshold: true, gzipOptions: {level: 9}}))
        .pipe(gulp.dest(destination + 'css'));
});

gulp.task('less', function() {
    return gulp.src(paths.less)
        .pipe(concat('style.less'))
        .pipe(less({
            paths: ['assets/less']
        }))
        .pipe(css_min())
        .pipe(gulp.dest(destination + 'css'))
        .pipe(gzip({threshold: true, gzipOptions: {level: 9}}))
        .pipe(gulp.dest(destination + 'css'));
});

gulp.task('js', function() {
    return gulp.src(paths.js)
        .pipe(concat('pageblok.min.js'))
        .pipe(js_min())
        .pipe(gulp.dest(destination + 'js'))
        .pipe(gzip({threshold: true, gzipOptions: {level: 9}}))
        .pipe(gulp.dest(destination + 'js'));
});

gulp.task('datetimepicker-css', function() {
    return gulp.src(paths.datetimepicker_css)
        .pipe(gulp.dest(destination + 'css'));
});

gulp.task('datetimepicker-js', function() {
    return gulp.src(paths.datetimepicker_js)
        .pipe(gulp.dest(destination + 'js'));
});

gulp.task('dropzone-css', function() {
    return gulp.src(paths.dropzone_css)
        .pipe(concat('dropzone.min.css'))
        .pipe(css_min())
        .pipe(gulp.dest(destination + 'css'))
        .pipe(gzip({threshold: true, gzipOptions: {level: 9}}))
        .pipe(gulp.dest(destination + 'css'));
});

gulp.task('dropzone-js', function() {
    return gulp.src(paths.dropzone_js)
        .pipe(concat('dropzone.min.js'))
        .pipe(gulp.dest(destination + 'js'))
        .pipe(gzip({threshold: true, gzipOptions: {level: 9}}))
        .pipe(gulp.dest(destination + 'js'));
});

gulp.task('dropzone-img', function() {
    return gulp.src(paths.dropzone_img)
        .pipe(imagemin({optimizationLevel: 5, progressive: true, interlaced: true }))
        .pipe(gulp.dest(destination + 'img'));
});

// Copy all static images
gulp.task('images', function() {
    return gulp.src(paths.images)
        .pipe(imagemin({optimizationLevel: 5, progressive: true, interlaced: true }))
        .pipe(gulp.dest(destination + 'img'));
});

gulp.task('fonts', function() {
    return gulp.src(paths.fonts)
        .pipe(gulp.dest(destination + 'fonts'));
});

gulp.task('watch', function() {
    gulp.watch(paths.less, ['less']);
    gulp.watch(assets + 'less/app/**/*.less', ['less']);
    gulp.watch(paths.js, ['js']);
    gulp.watch(paths.fonts, ['fonts']);
});

gulp.task('phpunit', function() {
    var options = {
        debug: false,
        configurationFile: paths.phpunit.config
    };

    return gulp.src(paths.phpunit.tests)
        .pipe(phpunit(paths.phpunit.runner, options));
});

gulp.task('default',
    [
        'bootswatch',
        'less',
        'js',
        'fonts',
        'images',
        'datetimepicker-css',
        'datetimepicker-js'
    ]
);

gulp.task('css',
    [ 'less' ]
);