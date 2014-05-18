'use strict';
module.exports = function(grunt) {

	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

		// Compass
    compass: {
      dist: {
        options: {
          sassDir: 'scss',
          cssDir: 'assets/css',
          imagesDir: 'assets/img',
          javascriptsDir: 'assets/js',
          fontsDir: 'assets/fonts',
          outputStyle: 'nested',
          relativeAssets: true,
          noLineComments: true,
          importPath: [
            'bower_components/bourbon/dist'
          ]
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
                      'Author URI: http://byjust.in\n'+
                  '*/\n'
        },
        files: {
          'assets/css/dm-style.min.css': ['assets/css/dm-style.css']
        }
      }
    },

		autoprefixer: {
			options: {
				browsers: ['last 2 version', 'ie 9']
			},
			dist: {
				src: 'assets/css/dm-style.css',
				dest: 'assets/css/dm-style.css'
			}
		},

    // Uglify
    uglify: {
      min: {
        files: {
          "assets/js/editor.min.js": ["src/js/editor.js"]
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
					cwd: 'assets/img/',
					src: '**/*.{png,jpg,gif}',
					dest: 'assets/img/'
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
        files: ['src/**/*'],
        tasks: ['scripts']
      }
    }

	});

	// register task
  grunt.registerTask('stylesheets', [
    'compass',
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