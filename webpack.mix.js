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
<<<<<<< HEAD

mix.copy('resources/js/admin-app.js','public/js/admin-app.js');
mix.sass('resources/sass/admin.scss','public/css');
mix.sass('resources/sass/login.scss','public/css');
=======
mix.copy('resources/js/admin-app.js','public/js/admin-app.js');
mix.sass('resourece/sass/admin.scss','public/css');
mix.sass('resourece/sass/login.scss','public/css');

>>>>>>> 9553ea7c8a9764e100e73a76e6717a52d5084616
