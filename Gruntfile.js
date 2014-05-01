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
            'bower_components/bourbon/dist',
            'bower_components/neat/app/assets/stylesheets'
          ]
        }
      }
    },

    // CSS minification + Add banner for WordPress
    cssmin: {
      add_banner: {
        files: {
          'assets/css/dm-style.css': ['assets/css/dm-style.css']
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