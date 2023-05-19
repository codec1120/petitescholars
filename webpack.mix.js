const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .copy('resources/js/service-worker.js', 'public')
    .css('resources/css/pace.css','public/css')
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("@tailwindcss/jit"),
        require('autoprefixer'),
    ])
    .copyDirectory("resources/static", "public/static")
    .copyDirectory("resources/pdf_files", "public/pdf_files");
