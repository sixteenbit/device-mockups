module.exports = {
    'default': [
        'copy:fonts',
        'styles',
        'scripts',
        'makepot',
        'notify:default'
    ],
    'styles': [
        'sass',
        'postcss:dev',
        'notify:styles'
    ],
    'scripts': [
        'jshint',
        'concat',
        'notify:scripts'
    ],
    'build': [
        'clean',
        'sass',
        'postcss:build',
        'scripts',
        'copy:build',
        'compress'
    ]
};
