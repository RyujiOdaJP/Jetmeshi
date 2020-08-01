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

mix
    // .js('resources/js/app.js', 'public/js')
    // .js('resources/js/myscript.js', 'public/js')
    // .js('resources/js/bootstrap.js', 'public/js')
    // .js('resources/js/jquery-3.5.1.min.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/bootstrap-Offcanvas.scss', 'public/css')
    .sass('resources/sass/error-page.scss', 'public/css')
    ;

