module.exports = {
    /**
     * grunt-contrib-copy
     *
     * Copy files and folders
     *
     * @link https://www.npmjs.com/package/grunt-contrib-copy
     */
    build: {
        expand: true,
        src: [
            '**',
            '!**/.*',
            '!node_modules/**',
            '!bower_components/**',
            '!grunt/**',
            '!release/**',
            '!sass/**',
            '!**/*.css.map',
            '!js/src/**',
            '!bower.json',
            '!Gruntfile.js',
            '!package.json'
        ],
        dest: 'release/<%= package.name %>/'
    },
    fonts: {
        expand: true,
        filter: 'isFile',
        flatten: true,
        src: ['bower_components/slick-carousel/slick/fonts/*'],
        dest: 'fonts/'
    },
};
