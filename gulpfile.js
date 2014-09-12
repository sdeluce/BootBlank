var 	gulp = require('gulp'),
 	watch = require('gulp-watch'),
	plumber = require('gulp-plumber'),
	livereload = require('gulp-livereload'),
	sass = require('gulp-ruby-sass'),
	autoprefixer = require('gulp-autoprefixer'),
	clean = require('gulp-clean'),
	coffee = require('gulp-coffee'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	svgmin = require('gulp-svgmin');
	pngcrush = require('imagemin-pngcrush'),
	svg2png = require('gulp-svg2png'),
	filter      = require('gulp-filter'),
	browserSync = require("browser-sync"),
	notify = require("gulp-notify");


/*	Javascript
*******************************************/
gulp.task('coffee', function() {
	return gulp.src('assets/coffee/*.coffee')
		.pipe(plumber())
		.pipe(coffee({
			bare: true
		}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('assets/js'))
		.pipe(notify("Coffee: <%= file.relative %>!"));

});
gulp.task('js', ['coffee'], function() {
	return gulp.src(
		'assets/ext_libs/jquery/dist/jquery.js',
		'assets/ext_libs/conditionizr/src/conditionizr.js',
		'assets/ext_libs/modernizr/modernizr.js',
		'assets/ext_libs/jquery-placeholder/jquery.placeholder.js',
		'assets/ext_libs/jquery-cookie/jquery.cookie.js',
		'assets/js/cookie.js',
		'assets/js/script.js'
	)
		.pipe(plumber())
		.pipe(concat('script.min.js'))
		.pipe(plumber.stop())
		.pipe(gulp.dest('assets/js/'))
		.pipe(notify("JS: <%= file.relative %>!"));
});
gulp.task('uglify', ['js'], function() {
	gulp.src('assets/js/script.min.js')
		.pipe(plumber())
		.pipe(uglify())
		.pipe(plumber.stop())
		.pipe(gulp.dest('js'))
		.pipe(notify("Js min: <%= file.relative %>!"));
});

/*	Style
*******************************************/
gulp.task('sass', function() {
	gulp.src('assets/sass/*.sass')
		.pipe(plumber())
		.pipe(sass({
			lineNumbers: true,
			sourcemapPath: 'css/sass',
			style: 'nested'
		}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('css'));

});
gulp.task('css', ['sass'], function() {
	return gulp.src('assets/css/*.css')
		.pipe(plumber())
		.pipe(autoprefixer())
		.pipe(plumber.stop())
		.pipe(gulp.dest('css'));
});

/*	Images
*******************************************/
gulp.task('svg2png', function () {
	return gulp.src('assets/svg/*.svg')
		.pipe(svg2png())
		.pipe(gulp.dest('assets/img'));
});

gulp.task('svgmin', function () {
	return gulp.src('assets/svg/*.svg')
		.pipe(svgmin())
		.pipe(gulp.dest('assets/img'));
});

gulp.task('img', ['svgmin','svg2png'], function () {

	return gulp.src('assets/img/**.*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngcrush()],
			number: 4
		}))
		.pipe(gulp.dest('img'));

})

/*	Other
*******************************************/
gulp.task('clean', function() {
	return gulp.src("css/*.**")
		.pipe(plumber())
		.pipe(clean({
			force: true
		}))
		.pipe(plumber().stop())
})

/*	Watch
*******************************************/
gulp.task('watch', function() {
	var server = livereload();

	watch('assets/sass/*.sass', function(files) {
		return files.pipe(sass())
		.pipe(gulp.dest('css/'))
		.pipe(notify("Le fichier <%= file.relative %> à été généré !"))
	});
	gulp.watch('assets/coffee/*.coffee', ['coffee', 'uglify']);
	gulp.watch('assets/js/*.js', ['uglify']);

	gulp.watch(['*.php', 'css/*.css', 'js/*.js']).on('change', function(event){
		server.changed(event.path);
	})
})

////////////////////////////////////////////////////////////////////////////////
//////////
//////////     TACHES
//////////
////////////////////////////////////////////////////////////////////////////////
gulp.task('dev', ['img', 'uglify', 'sass'], function() {

})

gulp.task('default', ['dev', 'watch'], function() {

})

gulp.task('build', ['clean', 'js', 'img'], function() {

});