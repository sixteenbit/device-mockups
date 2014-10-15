'use strict';
module.exports = function(grunt) {

	// load all grunt tasks matching the `grunt-*` pattern
	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		config: {
			bower: 	 			'bower_components',
			sass: 	 			'scss',
			assets: 		 	'assets',

			cssbanner: '/*\n'+
								'Plugin Name: <%= pkg.plugin.name %>\n'+
								'Plugin URI: <%= pkg.plugin.uri %>\n'+
								'Author: <%= pkg.author.name %>\n'+
								'Author URI: <%= pkg.author.uri %>\n'+
								'Version: <%= pkg.version %>\n'+
								'License: GNU General Public License v2.0\n'+
								'License URI: http://www.gnu.org/licenses/gpl-2.0.html\n'+
						'*/\n',

			jsbanner:  '/*\n' +
								 ' * <%= pkg.plugin.name %> v<%= pkg.version %> (<%= pkg.plugin.uri %>)\n' +
								 ' * Copyright <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>\n' +
								 '*/\n'
		},
    jshint: {
      options: {
        "bitwise": true,
        "browser": true,
        "curly": true,
        "eqeqeq": true,
        "eqnull": true,
        "esnext": true,
        "immed": true,
        "jquery": true,
        "latedef": true,
        "newcap": true,
        "noarg": true,
        "node": true,
        "strict": false,
        "trailing": true,
        "undef": true,
        "globals": {
          "jQuery": true,
          "alert": true,
          "tinymce": false
        }
      },
      all: [
        'Gruntfile.js',
        '<%= config.assets %>/js/*.js',
        '!<%= config.assets %>/**/*.min.*'
      ]
    },
		sass: {
      options: {
        style: 'compact',
        includePaths: ['<%= config.bower %>/bourbon/dist']
      },
			dev: {
				files: {
					'<%= config.assets %>/css/dm-style.css': 'scss/dm-style.scss'
				}
			}
		},
		autoprefixer: {
			options: {
				browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
			},
			dev: {
				src: '<%= config.assets %>/css/dm-style.css',
				dest: '<%= config.assets %>/css/dm-style.css'
			}
		},
		cssmin: {
			dist: {
				files: {
					'<%= config.assets %>/css/dm-style.min.css': ['<%= config.assets %>/css/dm-style.css']
				}
			}
		},
		uglify: {
			min: {
				files: {
					"<%= config.assets %>/js/editor.min.js": ["<%= config.assets %>/js/editor.js"],
          "<%= config.assets %>/js/jquery.flexslider.min.js": ["<%= config.bower %>/flexslider/jquery.flexslider.js"]
				}
			}
		},
		usebanner: {
			css: {
				options: {
					position: 'top',
					banner: '<%= config.cssbanner %>'
				},
				files: {
					src: [
						'<%= config.assets %>/css/dm-style.css',
						'<%= config.assets %>/css/dm-style.min.css'
					]
				}
			},
			js: {
				options: {
					position: 'top',
					banner: '<%= config.jsbanner %>'
				},
				files: {
					src: [
						'<%= config.assets %>/js/*.js'
					]
				}
			}
		},
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
		watch: {
			options: {
				livereload: false
			},
			grunt: {
				files: ['Gruntfile.js'],
				tasks: ['stylesheets','scripts','usebanner']
			},
			markup: {
				files: ["../*.php"],
			},
			compass: {
				files: ['scss/**/*'],
				tasks: ['stylesheets','scripts','usebanner']
			},
			js: {
				files: ['js/**/*'],
				tasks: ['stylesheets','scripts','usebanner']
			}
		}
	});

	// register task
	grunt.registerTask('stylesheets', [
    'jshint',
		'sass',
		'autoprefixer',
		'cssmin'
	]);

	// register task
	grunt.registerTask('scripts', [
    'jshint',
		'uglify'
	]);

	grunt.registerTask('default', [
		'stylesheets',
		'scripts',
		'usebanner',
		'watch'
	]);

};
