/*global module:false*/
module.exports = function(grunt) {

  grunt.configs = require('load-grunt-config')(grunt);

  require('load-grunt-tasks')(grunt);
  require('time-grunt')(grunt);

};
