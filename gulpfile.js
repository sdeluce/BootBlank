var 	gulp = require('gulp'),
	watch = require('gulp-watch'),
	plumber = require('gulp-plumber'),
	livereload = require('gulp-livereload'),
	// sass = require('gulp-ruby-sass'),
	compass = require('gulp-compass'),
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
	notify = require("gulp-notify"),
	minifyCSS = require('gulp-minify-css');
	useref = require('gulp-useref'),
	rename = require("gulp-rename"),
	imageResize = require('gulp-image-resize'),
	zip = require('gulp-zip');

var jsFilter = filter('js/*.js');
var cssFilter = filter('css/*.css');

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
// gulp.task('sass', function() {
// 	return gulp.src('assets/sass/*.sass')
// 		.pipe(plumber())
// 		.pipe(sass({
// 			lineNumbers: true,
// 			sourcemapPath: 'css/sass',
// 			style: 'nested'
// 		}))
// 		.pipe(plumber.stop())
// 		.pipe(gulp.dest('css'));
// });

gulp.task('compass', function() {
	return gulp.src('assets/sass/*.sass')
		.pipe(plumber())
		.pipe(compass({
			css: 'css',
			sass: 'assets/sass',
			image: 'img',
			style: 'nested',
			sourcemap: true
		}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('css'));
});

gulp.task('css', ['compass'], function() {
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
		.pipe(gulp.dest('assets/svg/img'));
});

gulp.task('svgmin', function () {
	return gulp.src('assets/svg/*.svg')
		.pipe(svgmin())
		.pipe(gulp.dest('img/svg'));
});

gulp.task('img', ['svgmin','svg2png'], function () {

	return gulp.src('assets/img/**/*')
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
gulp.task('cleancss', function() {
	return gulp.src("css/**/*")
		.pipe(clean({
			force: true
		}));
})

gulp.task('cleanimg', function() {
	return gulp.src("img/**/*")
		.pipe(clean({
			force: true
		}));
})

gulp.task('cleandist', function() {
	return gulp.src("dist")
		.pipe(clean({
			force: true
		}));
})

gulp.task('clean', ['cleandist', 'cleanimg', 'cleancss'],function() {
	gulp.src("css/**/*")
		.pipe(clean({
			force: true
		}));

	gulp.src("bootblank.zip")
		.pipe(clean({
			force: true
		}));

	return gulp.src("img/**/*")
		.pipe(clean({
			force: true
		}));
})

gulp.task('cleandist', function() {
	return gulp.src("dist")
		.pipe(clean({
			force: true
		}));
})

/*	Watch
*******************************************/
gulp.task('watch', function() {
	var server = livereload();

	watch('assets/sass/*.sass', function(files) {
		return files.pipe(compass({
			css: 'css',
			sass: 'assets/sass',
			image: 'img',
			style: 'nested',
			sourcemap: true
		}))
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
gulp.task('favicons',  function() {
	gulp.src("assets/img/rawico/favico-32.png")
		.pipe(imageResize({ width : 32 }))
		.pipe(rename({
			dirname: "",
			basename: "favicon",
			prefix: "",
			suffix: "-32",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 16 }))
		.pipe(rename({
			dirname: "",
			basename: "favicon",
			prefix: "",
			suffix: "-16",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))

	gulp.src("assets/img/rawico/favico.png")
		.pipe(imageResize({ width : 196 }))
		.pipe(rename({
			dirname: "",
			basename: "favicon",
			prefix: "",
			suffix: "-196",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 160 }))
		.pipe(rename({
			dirname: "",
			basename: "favicon",
			prefix: "",
			suffix: "-160",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 96 }))
		.pipe(rename({
			dirname: "",
			basename: "favicon",
			prefix: "",
			suffix: "-96",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))

	gulp.src("assets/img/rawico/winico.png")
		.pipe(imageResize({ width : 144 }))
		.pipe(rename({
			dirname: "",
			basename: "msie",
			prefix: "",
			suffix: "-144",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))

	gulp.src("assets/img/rawico/touchico.png")
		.pipe(imageResize({ width : 152 }))
		.pipe(rename({
			dirname: "",
			basename: "touch",
			prefix: "",
			suffix: "-152",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 144 }))
		.pipe(rename({
			dirname: "",
			basename: "touch",
			prefix: "",
			suffix: "-144",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 120 }))
		.pipe(rename({
			dirname: "",
			basename: "touch",
			prefix: "",
			suffix: "-120",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 114 }))
		.pipe(rename({
			dirname: "",
			basename: "touch",
			prefix: "",
			suffix: "-114",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 76 }))
		.pipe(rename({
			dirname: "",
			basename: "touch",
			prefix: "",
			suffix: "-76",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 72 }))
		.pipe(rename({
			dirname: "",
			basename: "touch",
			prefix: "",
			suffix: "-72",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 60 }))
		.pipe(rename({
			dirname: "",
			basename: "touch",
			prefix: "",
			suffix: "-60",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
		.pipe(imageResize({ width : 57 }))
		.pipe(rename({
			dirname: "",
			basename: "touch",
			prefix: "",
			suffix: "-57",
			extname: ".png"
	    	}))
		.pipe(gulp.dest('assets/img/icones/'))
})

gulp.task('default', ['img', 'uglify', 'compass', 'watch'], function() {

})

gulp.task('build', ['clean', 'uglify', 'img'], function() {

	return gulp.src('assets/sass/*.sass')
		pipe(compass({
			css: 'css',
			sass: 'assets/sass',
			image: 'img',
			style: 'compressed',
			sourcemap: false
		}))
		.pipe(gulp.dest('css'));

})

gulp.task('copy', function(){

	var assets = useref.assets();
	var filesToMove = [
		'./*.php',
		'./style.css',
		'./.bowerrc',
		'./bower.json',
		'./css/**/*.*',
		'./js/**/*.*',
		'./languages/*.*',
		'./fonts/**/*.*',
		'./package.json',
		'./gulpfile.js',
		'./assets/coffee/*.*',
		'./assets/functions/*.*',
		'./assets/icons/*.*',
		'./assets/img/*.*',
		'./assets/js/*.*',
		'./assets/sass/*.*'
	];

	return gulp.src(filesToMove, { base: './' })
		.pipe(gulp.dest('dist'));

})
gulp.task('zip', ['clean', 'build', 'copy'], function() {
	return gulp.src('dist/**/*')
		.pipe(zip('bootblank.zip'))
		.pipe(gulp.dest(''))
		.pipe(notify("Archive Zip : <%= file.relative %>!"));

})
gulp.task('dist', ['zip' ,'cleandist'], function() {



});