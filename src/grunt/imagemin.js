module.exports = {
  prod: {
    files: [{
      progressive: true,
      expand: true,
      cwd: '../trunk/assets/',
      src: ['**/*.{png,jpg,gif}'],
      dest: '../trunk/assets/'
    }]
  }
};
