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
   .sass('resources/sass/app.scss', 'public/css');

mix.styles(
    [
        'resources/css/home/stacks.css',
        'resources/css/home/clc.min.css',
        'resources/css/home/primary-unified.css',
        'resources/css/home/secondary-unified.css',
        'resources/css/home/adminLTE.css',
        'resources/css/home/custom.css'
    ], 'public/css/template.css');

mix.styles(
    [
        'resources/css/admin/admin.css',
        'resources/css/admin/fontawesome.css',
        'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
    ], 'public/css/admin.css');
    
mix.js(
    [
        'resources/js/admin/admin.js',
        'node_modules/@fortawesome/fontawesome-free/js/all.min.js',
    ], 'public/js/admin.js');
// ckeditor
mix.js('resources/js/post-detail.js', 'public/js/custom.js');
mix.copyDirectory('node_modules/ckeditor', 'public/plugins/ckeditor');

// mix.extract(['jquery', 'bootstrap', 'fontawesome']);

mix.sourceMaps();
