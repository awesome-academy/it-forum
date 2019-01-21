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

mix.extract(['jquery', 'bootstrap']);

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
        'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
        'resources/css/admin/admin.css',
        'resources/css/admin/jquery-ui.min.css',
    ], 'public/css/admin.css');
    
mix.js(
    [
        'node_modules/@fortawesome/fontawesome-free/js/all.min.js',
        'resources/js/admin/admin.js',
        'resources/js/admin/chart.min.js',
        'resources/js/admin/jquery-ui.min.js',
    ], 'public/js/admin.js');
// custom js
mix.js('resources/js/post-detail.js', 'public/js/custom.js');
// notifications
mix.js('resources/js/notifications.js', 'public/js/notifications.js');
// Runcode page
mix.copy('resources/js/jquery-3.1.1.min.js', 'public/js/jquery.js');
mix.copy('resources/js/bootstrap.min.js', 'public/js/bootstrap.js');
mix.copyDirectory('node_modules/codemirror', 'public/plugins/codemirror');
mix.styles(
    [
        'resources/css/home/bootstrap.min.css',
        'resources/css/home/AdminLTE.min.css',
        'resources/css/home/codehtml.css',
    ], 'public/css/codehtml.css');
mix.styles('resources/css/home/codephp.css', 'public/css/codephp.css');
mix.styles('resources/css/home/code.css', 'public/css/code.css');
// ckeditor
mix.copyDirectory('node_modules/ckeditor', 'public/plugins/ckeditor');
mix.copyDirectory('node_modules/jquery-tageditor', 'public/plugins/jquery-tageditor');
mix.copy('resources/image/code_link.png', 'public/plugins/ckeditor/skins/moono-lisa/code_link.png');
mix.copy('resources/image/user', 'public/uploads/images/user');
mix.copyDirectory('resources/image/', 'public/images');

mix.sourceMaps();
