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
   .sass('resources/sass/app.scss', 'public/css')
   //compila os temas dos templates
   .sass('resources/sass/temas/vali/main.scss','public/temas/vali/css')
   .sass('resources/sass/temas/atlantis/atlantis.scss','public/temas/atlantis/css')
   .sass('resources/sass/temas/adminlte3/AdminLTE.scss','public/temas/adminlte3/css')
   .less('resources/sass/temas/adminlte2418/less/AdminLTE.less','public/temas/adminlte2418/css')
   .less('resources/sass/temas/adminlte2418/less/skins/_all-skins.less','public/temas/adminlte2418/css/skins')
   .less('resources/sass/temas/adminlte2418/bootstrap-less/bootstrap.less','public/temas/adminlte2418/css/bootstrap');
