const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .webpackConfig({
      module: {
        rules: [
          {
            test: /\.js$/,
            use: ['babel-loader'], // Gunakan 'use' bukan 'loaders'
          }
        ]
      }
   })
   .sourceMaps();
