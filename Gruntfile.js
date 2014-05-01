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
          noLineComments: true
        }
      }
    },

    // CSS minification + Add banner for WordPress
    cssmin: {
      add_banner: {
        files: {
          'assets/css/device-mockups.css': ['assets/css/device-mockups.css']
        }
      }
    },

		autoprefixer: {
			options: {
				browsers: ['last 2 version', 'ie 9']
			},
			dist: {
				src: 'assets/css/device-mockups.css',
				dest: 'assets/css/device-mockups.css'
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
      }
    }

	});

	// register task
  grunt.registerTask('stylesheets', [
    'compass',
    'autoprefixer',
    'cssmin'
  ]);

  grunt.registerTask('default', [
    'stylesheets',
    'watch'
  ]);

};