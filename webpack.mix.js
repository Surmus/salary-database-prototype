let mix = require('laravel-mix');

mix
    .autoload({
        jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"]
    })
    .js('resources/assets/js/config.js', 'public/js/app.js')
    .extract([
        'jquery',
        'bootstrap-less',
        'angular',
        'angular-route',
        'angular-animate',
        'angular-sanitize',
        'angular-resource',
        'angular-translate',
        'angular-translate-loader-static-files',
        'amcharts3'
    ])
    .sourceMaps()
    .copyDirectory('resources/assets/partials', 'public/partials')
    .copyDirectory('resources/assets/translations', 'public/translations')
    .less('resources/assets/less/style.less', 'public/css');