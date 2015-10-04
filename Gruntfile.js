module.exports = function (grunt) {

    /**
     * time-grunt
     *
     * Display the elapsed execution time of grunt tasks
     *
     * @link https://www.npmjs.com/package/time-grunt
     */
    require('time-grunt')(grunt);

    // Project configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        /**
         * grunt-contrib-concat
         *
         * Concatenate files.
         *
         * Concatenates an array of js files set in /grunt/vars.js
         *
         * @link https://www.npmjs.com/package/grunt-contrib-concat
         */
        concat: {
            options: {
                separator: ';',
                stripBanners: true,
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                ' * <%= pkg.homepage %>\n' +
                ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                ' * Licensed GPLv2+' +
                ' */\n'
            },
            main: {
                src: [
                    'bower_components/slick-carousel/slick/slick.js',
                    'js/src/init.js'
                ],
                dest: 'js/device-mockups.js'
            },
            admin: {
                src: [
                    'js/src/editor.js'
                ],
                dest: 'admin/device-mockups.js'
            }
        },
        /**
         * grunt-contrib-jshint
         *
         * Validate files with JSHint.
         *
         * @link https://www.npmjs.com/package/grunt-contrib-jshint
         */
        jshint: {
            all: [
                'Gruntfile.js',
                'js/src/**/*.js'
            ]
        },
        /**
         * grunt-contrib-sass
         *
         * Compile Sass to CSS
         *
         * @link https://www.npmjs.com/package/grunt-contrib-sass
         */
        sass: {
            dist: {
                options: {
                    loadPath: [
                        'bower_components/bourbon/app/assets/stylesheets',
                        'bower_components/slick-carousel/slick'
                    ],
                    style: 'expanded',
                    sourcemap: 'none'
                },
                files: {
                    'admin/device-mockups.css': 'sass/device-mockups-admin.scss',
                    'css/device-mockups.css': 'sass/device-mockups.scss'
                }
            }
        },
        /**
         * grunt-contrib-copy
         *
         * Copy files and folders
         *
         * @link https://www.npmjs.com/package/grunt-contrib-copy
         */
        copy: {
            fonts: {
                expand: true,
                filter: 'isFile',
                flatten: true,
                src: [
                    'bower_components/slick-carousel/slick/fonts/*'
                ],
                dest: 'fonts/'
            },
            build: {
                expand: true,
                src: [
                    '**',
                    '!**/.*',
                    '!node_modules/**',
                    '!bower_components/**',
                    '!release/**',
                    '!sass/**',
                    '!js/src/**',
                    '!bower.json',
                    '!Gruntfile.js',
                    '!package.json'
                ],
                dest: 'release/device-mockups/'
            }
        },
        /**
         * grunt-wp-i18n
         *
         * Internationalize WordPress themes and plugins.
         *
         * @link https://www.npmjs.com/package/grunt-wp-i18n
         */
        makepot: {
            prod: {
                options: {
                    domainPath: '/languages/',
                    potFilename: 'device-mockups.pot',
                    type: 'wp-plugin'
                }
            }
        },
        /**
         * grunt-contrib-watch
         *
         * Run predefined tasks whenever watched file patterns are
         * added, changed or deleted.
         *
         * @link https://www.npmjs.com/package/grunt-contrib-watch
         */
        watch: {
            styles: {
                files: ['sass/*.scss'],
                tasks: ['css']
            }
        },
        /**
         * grunt-version-check
         *
         * Checks if your NPM or Bower dependencies are out of date.
         *
         * Run grunt versioncheck
         *
         * @link https://www.npmjs.com/package/grunt-version-check
         */
        versioncheck: {
            options: {
                skip: ['semver', 'npm', 'lodash'],
                hideUpToDate: false
            }
        },
        /**
         * grunt-notify
         *
         * Automatic desktop notifications for Grunt errors and warnings using
         * Growl for OS X or Windows, Mountain Lion and Mavericks Notification
         * Center, and Notify-Send.
         *
         * @link https://www.npmjs.com/package/grunt-notify
         */
        notify: {
            css: {
                options: {
                    title: 'Grunt, grunt!',
                    message: 'CSS is compiled.'
                }
            },
            js: {
                options: {
                    title: 'Grunt, grunt!',
                    message: 'JS is all good.'
                }
            },
            default: {
                options: {
                    title: 'Grunt, grunt!',
                    message: 'All tasks have completed with no errors.'
                }
            }
        }
    });
    /**
     * load-grunt-tasks
     *
     * Load multiple grunt tasks using globbing patterns
     *
     * This module will read the dependencies/devDependencies/peerDependencies
     * in your package.json and load grunt tasks that match the provided patterns.
     *
     * @link https://www.npmjs.com/package/load-grunt-tasks
     */
    require('load-grunt-tasks')(grunt);

    grunt.registerTask('css', ['sass', 'notify:css']);

    grunt.registerTask('js', ['jshint', 'concat', 'notify:js']);

    grunt.registerTask('default', ['copy', 'css', 'js', 'makepot', 'notify:default']);

    grunt.registerTask('build', ['default', 'copy:build']);

    grunt.util.linefeed = '\n';
};
