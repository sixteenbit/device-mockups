module.exports = {
    /**
     * grunt-contrib-watch
     *
     * Run predefined tasks whenever watched file patterns are
     * added, changed or deleted.
     *
     * @link https://www.npmjs.com/package/grunt-contrib-watch
     */
    styles: {
        files: ['sass/*.scss'],
        tasks: ['css']
    }
};