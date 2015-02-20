module.exports = {
  options: {
    separator: ';'
  },
  prod: {
    src: '<%= vars.jsFileList %>',
    dest: '../trunk/assets/js/editor.js'
  }
};
