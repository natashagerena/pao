const mix = require('laravel-mix');
require('dotenv').config();

// JS
mix.combine([
    'src/js/libs/*.js',
    'src/js/main.js'
], 'assets/js/main.js');

// Sass
mix.sass('src/styles/main.scss', 'assets/css').options({
    processCssUrls: false
});

// BrowserSync
if (process.env.PROXY_URL) {
    mix.browserSync({
        proxy: process.env.PROXY_URL,
        ui: false,
        ghostMode: false,
        files: [
            './assets/**/*',
            './views/*.twig',
            './**/*.php',
        ]
    });
}

// Disable notifications
mix.disableNotifications();
