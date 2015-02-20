module.exports = {
  options: {
    sourceMap: true,
    imagePath: '../img',
    includePaths: [
      'bower_components/bourbon/app/assets/stylesheets'
    ]
  },
  dev: {
    files: {
      '../trunk/assets/css/device-mockups.css': ['scss/device-mockups.scss'],
      '../trunk/assets/css/flexslider.css': ['scss/flexslider.scss']
    }
  }
};
