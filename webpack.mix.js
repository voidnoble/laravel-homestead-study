const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .scripts([
        '../node_modules/google-code-prettify/src/run_prettify.js',
        '../node_modules/select2/dist/js/select2.js',
        '../node_modules/dropzone/dist/dropzone.js',
    ], 'public/js/app.js')
    .styles([
        '../node_modules/dropzone/dist/dropzone.css',
    ], 'public/js/app.css')
   .sass('resources/sass/app.scss', 'public/css');
