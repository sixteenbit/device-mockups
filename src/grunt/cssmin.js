module.exports = {
  assets: {
    keepSpecialComments: 0,
    expand: true,
    cwd: '../trunk/assets/css/',
    src: ['*.css', '!*.min.css'],
    dest: '../trunk/assets/css/',
    ext: '.min.css'
  }
};
