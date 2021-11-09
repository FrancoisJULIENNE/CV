// GULP PACKAGES
// Most packages are lazy loaded
var gulp = require('gulp'),
	gutil = require('gulp-util'),
	browserSync = require('browser-sync').create(),
	filter = require('gulp-filter'),
	plugin = require('gulp-load-plugins')();

var ftp = require('vinyl-ftp');

// GULP VARIABLES
// Modify these variables to match your project needs

// Set local URL if using Browser-Sync
const LOCAL_URL = 'http://localhost/francoisjulienne/www/';

// Set path to Foundation files
const NODE_MODULES = 'node_modules/';

const SOURCE = {
	// Place custom JS here, files will be concantonated, minified if ran with --production
	scripts: [
		// Lets grab plugins scripts
		// 'node_modules/what-input/dist/what-input.js',

		// Place custom JS here, files will be concantonated, minified if ran with --production
		'assets/scripts/**/*.js',
	],

	// Scss files will be concantonated, minified if ran with --production
	styles: 'assets/styles/scss/**/*.scss',

	// Images placed here will be optimized
	images: 'assets/images/**/*',

	php: '**/*.php'
};

const ASSETS = {
	styles: 'assets/styles/',
	scripts: 'js/',
	images: 'assets/images/',
	all: 'assets/'
};

const JSHINT_CONFIG = {
	"node": true,
	"globals": {
		"document": true,
		"jQuery": true
	}
};

// GULP FUNCTIONS

gulp.task('deploy', function () {

	var conn = ftp.create({
		host: 'ftp.cluster028.hosting.ovh.net',
		user: 'francoishq',
		password: 'RksAR3mxEUru',
		parallel: 10,
		log: gutil.log
	});

	var globs = [
		'assets/**',
		'css/**',
		'js/**',
		'fonts/**',
		'functions/**',
		'functions.php'
	];

	// using base = '.' will transfer everything to /public_html correctly
	// turn off buffering in gulp.src for best performance

	return gulp.src(globs, { base: '.', buffer: false })
		.pipe(conn.newer('/')) // only upload newer files
		.pipe(conn.dest('/www/wp-content/themes/divi-child-theme'));

});

// JSHint, concat, and minify JavaScript
gulp.task('scripts', function () {

	// Use a custom filter so we only lint custom JS
	const CUSTOMFILTER = filter(ASSETS.scripts + 'js/**/*.js', { restore: true });

	return gulp.src(SOURCE.scripts)
		.pipe(plugin.plumber(function (error) {
			gutil.log(gutil.colors.red(error.message));
			this.emit('end');
		}))
		.pipe(plugin.sourcemaps.init())
		.pipe(plugin.babel({
			presets: ["@babel/preset-env"],
			compact: true,
			ignore: ['what-input.js']
		}))
		//.pipe(CUSTOMFILTER)
		.pipe(plugin.jshint(JSHINT_CONFIG))
		.pipe(plugin.jshint.reporter('jshint-stylish'))
		//.pipe(CUSTOMFILTER.restore)
		.pipe(plugin.concat('scripts.js'))
		.pipe(plugin.uglify())
		.pipe(plugin.sourcemaps.write('.')) // Creates sourcemap for minified JS
		.pipe(gulp.dest(ASSETS.scripts))
});
// Compile Sass, Autoprefix and minify
gulp.task('styles', function () {
	return gulp.src(SOURCE.styles)
		.pipe(plugin.plumber(function (error) {
			gutil.log(gutil.colors.red(error.message));
			this.emit('end');
		}))
		.pipe(plugin.sourcemaps.init())
		.pipe(plugin.sass())
		.pipe(plugin.autoprefixer())
		//.pipe(plugin.cssnano())
		.pipe(plugin.sourcemaps.write('.'))
		.pipe(gulp.dest(ASSETS.styles))
		.pipe(browserSync.reload({
			stream: true
		}));
});

// Optimize images, move into assets directory
gulp.task('images', function () {
	return gulp.src(SOURCE.images)
		.pipe(plugin.imagemin())
		.pipe(gulp.dest(ASSETS.images))
});

// Generate pot file
gulp.task('translate', function () {
	return gulp.src(SOURCE.php)
		.pipe(plugin.wpPot({
			domain: 'divi_child',
			package: 'Divi Child Project'
		}))
		.pipe(gulp.dest('file.pot'));
});

// Browser-Sync watch files and inject changes
gulp.task('browsersync', function () {

	// Watch these files
	var files = [
		SOURCE.php,
	];

	browserSync.init(files, {
		proxy: LOCAL_URL,
	});

	gulp.watch(SOURCE.styles, gulp.parallel('styles'));
	gulp.watch(SOURCE.scripts, gulp.parallel('scripts')).on('change', browserSync.reload);
	gulp.watch(SOURCE.images, gulp.parallel('images'));

});

// Watch files for changes (without Browser-Sync)
gulp.task('watch', function () {

	// Watch .scss files
	gulp.watch(SOURCE.styles, gulp.parallel('styles'));

	// Watch scripts files
	gulp.watch(SOURCE.scripts, gulp.parallel('scripts'));

	// Watch images files
	gulp.watch(SOURCE.images, gulp.parallel('images'));

});

// Run styles, scripts and images
gulp.task('default', gulp.parallel('styles', 'scripts', 'images'));
