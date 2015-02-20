module.exports = {
  sass: {
    files: ['assets/sass/*.scss', 'assets/sass/**/*.scss'],
    tasks: ['styles', 'notify:sass']
  },
  js: {
    files: [
      '<%= vars.jsFileList %>',
      '<%= jshint.all %>'
    ],
    tasks: ['scripts', 'notify:js']
  },
  livereload: {
    options: {
      livereload: true
    },
    files: [
      'assets/css/main.css',
      'assets/js/scripts.js',
      'grunt/*',
      '*.php',
      '**/*.php'
    ]
  }
};
