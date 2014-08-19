module.exports = function (grunt) {
	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		coffee: {
			compile: {
				options: {
					jsbare: true
				},
				files: {
					'assets/js/script.js': 'assets/coffee/script.coffee'
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
						'assets/js/script.js'
					],
				},
			},
		},
		clean: {
			css: ["css/*.css"]
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
					javascriptsPath: 'js'
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
					javascriptsPath: 'js'
				}
			}
		},
		// favicons: {
		// 	options: {
		// 		trueColor: true,
		// 		precomposed: true,
		// 		appleTouchBackgroundColor: "#e2b2c2",
		// 		coast: true,
		// 		windowsTile: true,
		// 		tileBlackWhite: false,
		// 		tileColor: "auto",
		// 		html: 'assets/icons/icons.html',
		// 		HTMLPrefix: "%url%/img/icons/"
		// 	},
		// 	icons: {
		// 		src: 'assets/img/favicon.png',
		// 		dest: 'assets/img/icons'
		// 	}
		// },
		multiresize: {
			iOS: {
				src: 'orig/Icon-512.png',
				dest: ['Icon.png', 'Icon@2x.png', 'Icon-72.png', 'Icon-72@2x.png'],
				destSizes: ['57x57', '114x114', '72x72', '144x144']
			},
			Android: {
				src: 'orig/Icon-Android-512.png',
				dest: ['Icon-ldpi.png', 'Icon-mdpi.png', 'Icon-hdpi.png', 'Icon-xhdpi.png'],
				destSizes: ['36x36', '48x48', '72x72', '96x96']
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
					optimizationLevel: 7
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
				tasks: ['compass:dev'],
				options: {
					spawn: false,
					livereload: true
				}
			},
		}
	});
	grunt.registerTask('dev', ['clean','coffee','concat','uglify','compass:dev','svg2png','multiresize','imagemin','svgmin']);
	grunt.registerTask('build', ['clean','coffee','concat','uglify','compass:dist','svg2png','multiresize','imagemin','svgmin']);

	grunt.registerTask('default', ['dev', 'watch']);

	grunt.registerTask('img', ['svg2png','imagemin','svgmin']);
	grunt.registerTask('style', ['clean','compass:dist']);
	grunt.registerTask('js', ['coffee','concat','uglify']);
	grunt.registerTask('icon', ['multiresize']);
}