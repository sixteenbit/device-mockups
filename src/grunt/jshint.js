module.exports = {
  options: {
    bitwise: true,
    browser: true,
    curly: true,
    eqeqeq: true,
    eqnull: true,
    esnext: true,
    immed: true,
    jquery: true,
    latedef: true,
    newcap: true,
    noarg: true,
    node: true,
    strict: false,
    trailing: true,
    undef: true,
    globals: {
      jQuery: true,
      alert: true,
      wp: false,
      tinymce: false
    }
  },
  all: [
    'Gruntfile.js',
    '../trunk/assets/js/*.js',
    '!../trunk/assets/js/scripts.js',
    '!../trunk/assets/**/*.min.*',
    '!../trunk/assets/**/flexslider.*'
  ]
};
