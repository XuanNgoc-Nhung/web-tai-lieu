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
    .js('resources/js/admin-chuong-trinh-dao-tao.js', 'public/js/admin-chuong-trinh-dao-tao.js')
    .js('resources/js/admin-quan-ly-mon-hoc.js', 'public/js/admin-quan-ly-mon-hoc.js')
    .options({
        processCssUrls: false
    })
