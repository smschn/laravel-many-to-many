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
    .js('resources/js/front.js', 'public/js') // aggiungo il file <front.js> a quelli da compilare (perché contiene codice in Vue): il file compilato si troverà in <\public\js> con lo stesso nome, ma in js plain.
    .sass('resources/sass/app.scss', 'public/css');