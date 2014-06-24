'use strict';
module.exports = function(grunt) {

	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

		config: {
			version: 			'1.1.7',
			bower: 	 			'bower_components',
			sass: 	 			'src/scss',
			assets: 		 	'assets',
			src: 		 			'src'
		},

		sass: {                              // Task
			dist: {                            // Target
				options: {                       // Target options
					style: 'nested',
					loadPath: [
						'<%= config.bower %>/bourbon/dist'
					]
				},
				files: {
					'<%= config.assets %>/css/dm-style.css': '<%= config.sass %>/dm-style.scss'
				}
			}
		},

		// CSS minification + Add banner for WordPress
		cssmin: {
			add_banner: {
				options: {
					banner: '/*\n'+
											'Plugin Name: Device Mockups\n'+
											'Plugin URI: https://wordpress.org/plugins/device-mockups/\n'+
											'Author: Justin Peacock\n'+
											'Author URI: http://byjust.in/\n'+
											'Version: <%= config.version %>\n'+
									'*/\n'
				},
				files: {
					'<%= config.assets %>/css/dm-style.min.css': ['<%= config.assets %>/css/dm-style.css']
				}
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 version', 'ie 9']
			},
			dist: {
				src: '<%= config.assets %>/css/dm-style.css',
				dest: '<%= config.assets %>/css/dm-style.css'
			}
		},

		// Uglify
		uglify: {
			min: {
				files: {
					"<%= config.assets %>/js/editor.min.js": ["<%= config.src %>/js/editor.js"]
				}
			}
		},

		// image optimization
		imagemin: {
			img: {
				options: {
					optimizationLevel: 7,
					progressive: true
				},
				files: [{
					expand: true,
					cwd: '<%= config.assets %>/img/',
					src: '**/*.{png,jpg,gif}',
					dest: '<%= config.assets %>/img/'
				}]
			}
		},

		// Watch for file changes
		watch: {
			options: {
				livereload: true
			},
			grunt: {
				files: ['Gruntfile.js'],
				tasks: ['stylesheets']
			},
			markup: {
				files: ["*.php"],
			},
			compass: {
				files: ['scss/**/*'],
				tasks: ['stylesheets']
			},
			js: {
				files: ['<%= config.src %>/**/*'],
				tasks: ['scripts']
			}
		}

	});

	// register task
	grunt.registerTask('stylesheets', [
		'sass',
		'autoprefixer',
		'cssmin'
	]);

	// register task
	grunt.registerTask('scripts', [
		'uglify'
	]);

	grunt.registerTask('default', [
		'stylesheets',
		'scripts',
		'watch'
	]);

};