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
        
mix.js([
        'resources/js/app.js',
        'resources/js/logout.js',
        'resources/js/courses.js',
        'resources/js/changeimg.js',
        'resources/js/option.js',
        'resources/js/datatable.js',
        'resources/js/addsubject.js',
        'resources/js/checkconfirm.js',
        'resources/js/ajax.js',
        'resources/js/calendarevent.js',
        'resources/js/chart-area-demo.js',
   ], 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
