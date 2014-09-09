var 	gulp = require('gulp'),
	livereload = require('gulp-livereload'),
	sass = require('gulp-ruby-sass'),
	clean = require('gulp-clean'),
	coffee = require('gulp-coffee'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	pngcrush = require('imagemin-pngcrush'),
	svg2png = require('gulp-svg2png');


gulp.task('coffee', function() {
	return gulp.src('assets/coffee/*.coffee')
		.pipe(coffee({
			bare: true
		}))
		.pipe(gulp.dest('assets/js'));

});

gulp.task('sass', function() {

	return gulp.src('assets/sass/*.sass')
		.pipe(sass({
			lineNumbers: true,
			sourcemapPath: 'css/sass',
			style: 'nested'
		}))
		.pipe(gulp.dest('css'));

});

gulp.task('svg2png', function () {
	return gulp.src('assets/svg/*.svg')
		.pipe(svg2png())
		.pipe(gulp.dest('assets/img/svg'));
});

gulp.task('img', ['svg2png'], function () {

	return gulp.src('assets/img/*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngcrush()],
			number: 4
		}))
		.pipe(gulp.dest('img'));

	return gulp.src('assets/img/icons/*')
		.pipe(imagemin({
			progressive: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [pngcrush()],
			number: 4
		}))
		.pipe(gulp.dest('img/icons'))

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
		.pipe(concat('script.min.js'))
		.pipe(gulp.dest('assets/js/'));
});
gulp.task('uglify', ['js'], function() {
	gulp.src('assets/js/script.min.js')
		.pipe(uglify())
		.pipe(gulp.dest('js'));
});

gulp.task('dev', ['uglify', 'sass', 'img'], function() {

})

gulp.task('watch', function() {
	watch('assets/sass/*.sass', function(files) {
		return files.pipe(gulp.dest('css/'));
	});
})

gulp.task('default', ['dev'], function() {
	var server = livereload();

	gulp.watch('assets/coffee/*.coffee', ['coffee', 'uglify']);
	gulp.watch('assets/js/*.js', ['uglify']);
	gulp.watch('assets/sass/*.sass', ['sass']);

	gulp.watch(['*.php', 'css/*.css', 'js/*.js']).on('change', function(event){
		server.changed(event.path);
	})
})

gulp.task('clean', function() {
	return gulp.src("css/*.**")
		.pipe(clean({
			force: true
		}));
});

gulp.task('build', ['clean', 'js', 'img'], function() {
	gulp.src('assets/sass/*.sass')
		.pipe(sass({
			lineNumbers: true,
			sourcemapPath: 'css/sass',
			style: 'nested'
		}))
		.pipe(gulp.dest('css'));
});