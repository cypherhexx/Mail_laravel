let mix = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css').version();

// mix.js('resources/assets/js/site.js', 'public/sitejs')
//    .sass('resources/assets/sass/site.scss', 'public/sitecss').version();

// mix.copy('resources/assets/site', 'public/assets/site');     
// mix.copy('resources/assets/files', 'public/files');     
// mix.copy('resources/assets/css/icons/icomoon/fonts', 'public/fonts');
// mix.copy('resources/assets/css/languages/languages.png', 'public/build/img/languages.png')     

       

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css').version();

mix.js('resources/assets/newassets/frontend.js', 'public/frontend')
   .sass('resources/assets/newassets/frontend.scss', 'public/frontend').version();

// mix.copy('resources/assets/site', 'public/assets/site');     
mix.copy('resources/assets/files', 'public/files');     
mix.copy('resources/assets/css/icons/icomoon/fonts', 'public/fonts');
mix.copy('resources/assets/css/languages/languages.png', 'public/build/img/languages.png')     

       
