module.exports = {
    /**
     * grunt-contrib-concat
     *
     * Concatenate files.
     *
     * Concatenates an array of js files set in /grunt/vars.js
     *
     * @link https://www.npmjs.com/package/grunt-contrib-concat
     */
    options: {
        separator: ';',
        stripBanners: true,
        banner: '/** <%= package.title %> - v<%= package.version %>\n' +
        ' * <%= package.homepage %>\n' +
        ' * Copyright (c) <%= grunt.template.today("yyyy") %>;\n' +
        ' * Licensed GPLv2+\n' +
        ' */\n'
    },
    main: {
        src: [
            'bower_components/slick-carousel/slick/slick.js',
            'js/src/_init.js'
        ],
        dest: 'js/device-mockups.js'
    },
    admin: {
        src: [
            'js/src/_editor.js'
        ],
        dest: 'admin/device-mockups.js'
    }
};