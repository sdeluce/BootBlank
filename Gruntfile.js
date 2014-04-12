module.exports = function (grunt) {
	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		// uglify: {
		// 	options: {
		// 		compress: {
		// 			// drop_console: true
		// 		}
		// 	},
		// 	my_target: {
		// 		files: {
		// 			// 'dest/output.min.js': ['src/input.js']
		// 		}
		// 	}
		// },

		compass: {
			dist: {
				options: {
					config: 'config.rb'
				}
			}
		},

		svg2png: {
			all: {
				// specify files in array format with multiple src-dest mapping
				files: [
					// rasterize all SVG files in "img" and its subdirectories to "img/png"
					{ src: ['assets/svg/**.svg'], dest: 'assets/img/' },
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
				files: ['assets/js/*.js','!assets/js/*.min.js'],
				tasks: ['concat'],
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
	grunt.registerTask('default', ['compass','svg2png','imagemin','svgmin']);
}