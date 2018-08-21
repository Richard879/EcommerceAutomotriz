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

mix.styles([
<<<<<<< HEAD
    'resources/assets/template/vendor/bootstrap/css/bootstrap.css',
    'resources/assets/template/vendor/font-awesome/css/font-awesome.css',
    'resources/assets/template/css/fontdin.css',
    'resources/assets/template/css/toastr.css',
    'resources/assets/template/css/style.default.css',
    'resources/assets/template/css/custom.css',
    'resources/assets/template/css/simple-line-icons.min.css',
    'resources/assets/template/css/styleprogress.css'
], 'public/css/plantilla.css')
.scripts([
	'resources/assets/template/vendor/jquery/jquery.min.js',
	'resources/assets/template/vendor/popper.js/umd/popper.min.js',
	'resources/assets/template/vendor/jquery.cookie/jquery.cookie.js',
	//'resources/assets/template/vendor/chart.js/Chart.min.js',
	'resources/assets/template/vendor/jquery-validation/jquery.validate.min.js',
	'resources/assets/template/js/front.js',
    //'resources/assets/template/js/charts-home.js',
    //'resources/assets/template/js/charts-custom.js',
    'resources/assets/template/js/activemenu.js',
    'resources/assets/template/js/toastr.js',
    'resources/assets/template/js/sweetalert2.js',
    'resources/assets/template/js/moment.min.js',
], 'public/js/plantilla.js')
.js('resources/assets/js/app.js', 'public/js/app.js')
/*.copyDirectory([
	'resources/assets/template/fonts',
], 'public/fonts')*/;
=======
        'resources/assets/template/vendor/bootstrap/css/bootstrap.css',
        'resources/assets/template/vendor/font-awesome/css/font-awesome.css',
        'resources/assets/template/css/fontdin.css',
        'resources/assets/template/css/toastr.css',
        'resources/assets/template/css/style.default.css',
        'resources/assets/template/css/custom.css',
        'resources/assets/template/css/simple-line-icons.min.css',
    ], 'public/css/plantilla.css')
    .scripts([
        'resources/assets/template/vendor/jquery/jquery.min.js',
        'resources/assets/template/vendor/popper.js/umd/popper.min.js',
        'resources/assets/template/vendor/jquery.cookie/jquery.cookie.js',
        //'resources/assets/template/vendor/chart.js/Chart.min.js',
        'resources/assets/template/vendor/jquery-validation/jquery.validate.min.js',
        'resources/assets/template/js/front.js',
        //'resources/assets/template/js/charts-home.js',
        //'resources/assets/template/js/charts-custom.js',
        'resources/assets/template/js/activemenu.js',
        'resources/assets/template/js/toastr.js',
        'resources/assets/template/js/sweetalert2.js',
    ], 'public/js/plantilla.js')
    .js('resources/assets/js/app.js', 'public/js/app.js')
    .copyDirectory([
        'resources/assets/template/fonts',
    ], 'public/fonts');
>>>>>>> 597c17d730310d676ad9330c44689e34db6c0cb5

// mix.browserSync('http://localhost:8080/saisacsys/public');