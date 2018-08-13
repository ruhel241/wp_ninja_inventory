let mix = require('laravel-mix');

mix.setPublicPath('public');

mix.setResourceRoot('../');

// mix.

mix.js('src/js/wp_ninja_inventory.js', 'public/js/wp_ninja_inventory.js')
   .sass('src/css/style.scss', 'public/css/style.css');
   



