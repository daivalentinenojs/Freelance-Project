const mix = require('laravel-mix');
const config = require('./webpack.config');

mix.postCss('resources/css/app.css', 'public/css', []);
mix.postCss('resources/css/vid.css', 'public/css', []);
mix.scripts([
    'resources/assets/js/vendor/jquery-2.2.4.min.js',
    'resources/assets/js/glanz_library.js',
    'resources/assets/js/vendor/modernizr.min.js',
    'resources/assets/js/vendor/bootstrap.min.js',
    'resources/assets/js/glanz_script.js',
], 'public/js/app.js');

mix.scripts([
    'node_modules/video.js/dist/video.min.js',
    'node_modules/@videojs/http-streaming/dist/videojs-http-streaming.min.js',
    'node_modules/videojs-youtube/dist/Youtube.min.js',
], 'public/js/vid.js');

// mix.postCss('resources/css/game.css', 'public/css', []);
mix.copyDirectory('resources/assets/images', 'public/assets/images');
mix.sourceMaps();
mix.webpackConfig(config);
if (mix.inProduction()) {
    mix.version();
}

