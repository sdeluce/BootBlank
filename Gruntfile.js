module.exports = function (grunt) {
	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		concurrent: {
			clean: {
				tasks: ['clean'],
				options: {
					logConcurrentOutput: true
				}
			},
			sass: {
				tasks: ['sass:dev'],
				options: {
					logConcurrentOutput: true
				}
			},
			js: {
				tasks: ['coffee', 'uglify', 'concat'],
				options: {
					logConcurrentOutput: true
				}
			},

			img: {
				tasks: ['multiresize', 'svg2png', 'imagemin', 'imagemin'],
				options: {
					logConcurrentOutput: true
				}
			},
			build: {
				tasks: ['clean', 'coffee', 'uglify', 'concat', 'multiresize', 'svg2png', 'svgmin', 'imagemin', 'sass:dist'],
				options: {
					logConcurrentOutput: true
				}
			}
		},
		coffee: {
			compile: {
				options: {
					jsbare: true
				},
				files: {
					'assets/js/script.js': 'assets/coffee/script.coffee',
					// 'assets/js/cookie.js': 'assets/coffee/cookie.coffee'
				}
			}
		},
		uglify: {
			dist: {
				files: {
					'js/script.min.js': ['assets/js/script.min.js'],
					'js/respond.min.js': ['assets/ext_libs/respond/src/respond.js'],
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
						'assets/ext_libs/jquery-placeholder/jquery.placeholder.js',
						'assets/ext_libs/jquery-cookie/jquery.cookie.js',
						'assets/js/cookie.js',
						'assets/js/script.js'
					],
				},
			},
		},
		clean: {
			css: ["css/*.*"]
		},
		compass: {
			dist: {
				options: {
					sassDir: 'assets/sass',
					cssDir: 'css',
					environment: 'production',
					outputStyle: 'compressed',
					httpPath: '/',
					imagesPath: 'img',
					javascriptsPath: 'js',
					//require: 'susy'
				}
			},
			dev: {
				options: {
					sassDir: 'assets/sass',
					cssDir: 'css',
					environment: 'development',
					debugInfo: true,
					outputStyle: 'nested',
					httpPath: '/',
					imagesPath: 'img',
					javascriptsPath: 'js',
					//require: 'susy'
				}
			}
		},
		sass: {
			dist: {
				options: {
					style: 'compressed',
					compass: true,
					sourcemap: 'none'
				},
				files: [{
					expand: true,
					cwd: 'assets/sass',
					src: ['*.scss'],
					dest: 'css',
					ext: '.css',

				}]
			},
			dev: {
				options: {
					style: 'expanded',
					compass: true,
					lineNumbers: true
				},
				files: [{
					expand: true,
					cwd: 'assets/sass',
					src: ['*.scss'],
					dest: 'css',
					ext: '.css',

				}]
			}
		},
		multiresize: {
			app: {
				src: 'assets/img/icon.png',
				dest: ['assets/img/icons/apple-touch-icon-57.png', 'assets/img/icons/apple-touch-icon-60.png', 'assets/img/icons/apple-touch-icon-72.png', 'assets/img/icons/apple-touch-icon-114.png','assets/img/icons/apple-touch-icon-120.png','assets/img/icons/apple-touch-icon-144.png','assets/img/icons/apple-touch-icon-152.png'],
				destSizes: ['57x57', '60x60', '72x72', '114x114', '120x120', '144x144', '152x152']
			},
			icons: {
				src: 'assets/img/favicon.png',
				dest: ['assets/img/icons/favicon-96.png', 'assets/img/icons/favicon-160.png', 'assets/img/icons/favicon-196.png'],
				destSizes: ['96x96', '160x160', '196x196']
			},
			favicons: {
				src: 'assets/img/favicon-32.png',
				dest: ['assets/img/icons/favicon-12.png', 'assets/img/icons/favicon-32.png'],
				destSizes: ['16x16', '32x32']
			},
			w8: {
				src: 'assets/img/w8.png',
				dest: ['assets/img/icons/mstile-144.png'],
				destSizes: ['144x144']
			}
		},
		svg2png: {
			all: {
				files: [
					// rasterize all SVG files in "img" and its subdirectories to "img/png"
					{ src: ['assets/svg/logo.svg'], dest: 'assets/img/' },
				]
			}
		},

		imagemin: {
			dynamic: {
				options: {
					optimizationLevel: 8
				},
				files: [{
					expand: true,
					cwd: 'assets/img/',
					src: ['**/*.{png,jpg,gif}'],
					dest: 'img/'
				},{
					expand: true,
					cwd: 'assets/img/icons/',
					src: ['**/*.{png,jpg,gif}'],
					dest: 'img/icons/'
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
				tasks: ['concat','uglify'],
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
				tasks: ['sass:dev'],
				options: {
					spawn: false,
					livereload: true
				}
			},
		}
	});
	grunt.registerTask('dev', ['coffee','concat','uglify','compass:dev','svg2png','multiresize','imagemin','svgmin']);
	//grunt.registerTask('build', ['clean','coffee','concat','uglify','compass:dist','svg2png','multiresize','imagemin','svgmin']);
	grunt.registerTask('build', ['concurrent:build']);

	// grunt.registerTask('default', ['dev', 'watch']);
	grunt.registerTask('default', ['concurrent:sass', 'concurrent:js', 'concurrent:img', 'watch']);

	grunt.registerTask('img', ['concurrent:img']);
	grunt.registerTask('style', ['concurrent:sass']);
	grunt.registerTask('js', ['concurrent:js']);
	grunt.registerTask('icon', ['multiresize']);
}