module.exports = {
    /**
     * grunt-sass
     *
     * Compile Sass to CSS using node-sass
     *
     * @link https://www.npmjs.com/package/grunt-sass
     */
    dist: {
        options: {
            // @link https://make.wordpress.org/core/handbook/best-practices/coding-standards/css/
            indentedSyntax: true,
            indentType: 'tab',
            indentWidth: '1',
            sourceMap: true,
            includePaths: [
                'bower_components/bourbon/app/assets/stylesheets',
                'bower_components/slick-carousel/slick'
            ],
            outputStyle: 'expanded'
        },
        files: {
            'admin/device-mockups.css': 'sass/device-mockups-admin.scss',
            'css/device-mockups.css': 'sass/device-mockups.scss'
        }
    }
};