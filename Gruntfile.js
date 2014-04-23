module.exports = function (grunt) {
	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		coffee: {
			compile: {
				files: {
					'assets/js/script.js': 'assets/coffee/script.coffee'
				}
			}
		},
		concat: {
			basic_and_extras: {
				files: {
					'assets/js/script.min.js': [
						'assets/ext_libs/jquery/dist/jquery.js',
						'assets/ext_libs/conditionizr/src/conditionizr.js',
						'assets/ext_libs/modernizr/modernizr.js',
						'assets/ext_libs/bootstrap-sass/js/carousel.js',
						'assets/ext_libs/bootstrap-sass/js/transition.js',
						'assets/js/script.js'
					],
				},
			},
		},
		uglify: {
			dist: {
				files: {
					'js/script.min.js': ['assets/js/script.min.js']
				}
			}
		},
		compass: {
			dist: {
				options: {
					config: 'config.rb'
				}
			}
		},
		favicons: {
			options: {
				trueColor: true,
				precomposed: true,
				appleTouchBackgroundColor: "#292f33",
				coast: true,
				windowsTile: true,
				tileBlackWhite: true,
				tileColor: "#292f33",
				html: 'assets/icons/icons.html',
				HTMLPrefix: '%url%/img/icons/'
			},
			icons: {
				src: 'assets/img/favicon.png',
				dest: 'img/icons'
			}
		},
		svg2png: {
			all: {
				// specify files in array format with multiple src-dest mapping
				files: [
					// rasterize all SVG files in "img" and its subdirectories to "img/png"
					{ src: ['assets/svg/logo.svg'], dest: 'assets/img/' },
				]
			}
		},

		imagemin: {
			dynamic: {
				files: [{
					expand: true,
					cwd: 'assets/img/',
					src: ['**/*.{png,jpg,gif}'],
					dest: 'img/'
				}]
			}
		},

		svgmin: {
			dist: {
				files: [{
					expand: true,
					cwd: 'assets/svg/',
					src: ['**/*.svg'],
					dest: 'img/',
					ext: '.svg'
				}]
			}
		},

		watch: {
			php: {
				files: ['**.php'],
				options: {
					spawn: false,
					livereload: true
				}
			},
			js: {
				files: ['assets/js/*.js','assets/**/*.js','!assets/js/*.min.js'],
				tasks: ['uglify'],
				options: {
					spawn: false,
					livereload: true
				}
			},
			coffee: {
				files: ['assets/coffee/*.coffee'],
				tasks: ['coffee','concat','uglify'],
				options: {
					spawn: false,
					livereload: true
				}
			},
			scss: {
				files: ['assets/sass/*.scss','assets/**/*.scss'],
				tasks: ['compass'],
				options: {
					spawn: false,
					livereload: true
				}
			},
		}
	});
	grunt.registerTask('default', ['coffee','concat','uglify','compass','svg2png','favicons','imagemin','svgmin']);

	grunt.registerTask('img', ['svg2png','imagemin','svgmin']);
	grunt.registerTask('style', ['compass']);
	grunt.registerTask('js', ['coffee','concat','uglify']);
	grunt.registerTask('icon', ['favicons']);
}