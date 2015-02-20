module.exports = {
  prod: {
    files: {
      '../trunk/assets/js/editor.min.js': '<%= vars.jsFileList %>'
    }
  }
};
