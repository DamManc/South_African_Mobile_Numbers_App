const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass("resources/assets/sass/home.scss", "css")
    .sass("resources/assets/sass/result.scss", "css")
    .sass("resources/assets/sass/test.scss", "css");

mix.js("resources/assets/js/pages/home.js", "js")
    .js("resources/assets/js/pages/test.js", "js")
    .js("resources/assets/js/pages/result.js", "js");

