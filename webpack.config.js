const path = require('path');
const webpack = require('webpack');
module.exports = {
    context: path.resolve(__dirname, './resources/src/js'),
    entry: {
        app: ['./alo.js', './blo.js'],
    },

    output: {
        path: path.resolve(__dirname, './public/js'),
        filename: 'app.bundle.js',
    },
};

