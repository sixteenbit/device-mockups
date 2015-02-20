module.exports = {
  'default': ['dev'],
  'styles': [
    'sass',
    'autoprefixer',
    'csscomb'
  ],
  'scripts': [
    'copy',
    'jshint',
    'concat'
  ],
  'dev': [
    'styles',
    'scripts',
    'notify:dev'
  ],
  'prod': [
    'dev',
    'cssmin',
    'uglify',
    // 'imagemin',
    // 'makepot',
    'notify:prod'
  ]
};
