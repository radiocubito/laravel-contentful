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

mix.ts('resources/js/wordful.js', 'resources/dist/js/app.js')
    .postCss('resources/css/wordful.css', 'resources/dist/css/app.css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);
