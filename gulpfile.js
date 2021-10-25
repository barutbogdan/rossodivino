const elixir = require('laravel-elixir');

require('laravel-elixir-vue');
require('laravel-elixir-clean');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {

    // web section
    mix.sass('app.scss', 'resources/css/base.css')
       .sass('layouts/web/pages/homepage.scss', 'resources/css/pages/homepage.css')
       //.sass('layouts/web/pages/ambasador.scss', 'resources/css/pages/ambasador.css')
       //.sass('layouts/web/pages/showroom.scss', 'resources/css/pages/showroom.css')
       //.sass('layouts/web/pages/services-equipe.scss', 'resources/css/pages/services-equipe.css')
//       .sass('layouts/web/pages/register.scss', 'resources/css/pages/register.css')
//       .sass('layouts/web/pages/forgot.scss', 'resources/css/pages/forgot.css')
//       .sass('layouts/web/pages/reset_password.scss', 'resources/css/pages/reset_password.css')
       // .sass('layouts/web/pages/contact.scss', 'resources/css/pages/contact.css')
//       .sass('layouts/web/pages/login.scss', 'resources/css/pages/login.css')
       //.sass('layouts/web/pages/pages.scss', 'resources/css/pages/pages.css')
       //.sass('layouts/web/pages/about.scss', 'resources/css/pages/about.css')
       //.sass('layouts/web/pages/realisations.scss', 'resources/css/pages/realisations.css')
       //.sass('layouts/web/pages/service.scss', 'resources/css/pages/service.css')
//       .sass('layouts/web/pages/projects.scss', 'resources/css/pages/projects.css')
//       .sass('layouts/web/pages/project.scss', 'resources/css/pages/project.css')
       // .sass('layouts/web/pages/articles.scss', 'resources/css/pages/articles.css')
       // .sass('layouts/web/pages/article.scss', 'resources/css/pages/article.css')
       //.sass('layouts/web/pages/services.scss', 'resources/css/pages/services.css')
       //.sass('layouts/web/pages/404.scss', 'resources/css/pages/404.css')
       .styles(['base.css'], 'public/css/base.css', 'resources/css')
       .styles(['homepage.css'], 'public/css/pages/homepage.css', 'resources/css/pages')
       //.styles(['ambasador.css'], 'public/css/pages/ambasador.css', 'resources/css/pages')
       //.styles(['showroom.css'], 'public/css/pages/showroom.css', 'resources/css/pages')
       //.styles(['services-equipe.css'], 'public/css/pages/services-equipe.css', 'resources/css/pages')
//       .styles(['register.css'], 'public/css/pages/register.css', 'resources/css/pages')
//       .styles(['forgot.css'], 'public/css/pages/forgot.css', 'resources/css/pages')
//       .styles(['reset_password.css'], 'public/css/pages/reset_password.css', 'resources/css/pages')
       // .styles(['contact.css'], 'public/css/pages/contact.css', 'resources/css/pages')
//       .styles(['login.css'], 'public/css/pages/login.css', 'resources/css/pages')
       //.styles(['pages.css'], 'public/css/pages/pages.css', 'resources/css/pages')
       //.styles(['about.css'], 'public/css/pages/about.css', 'resources/css/pages')
       //.styles(['realisations.css'], 'public/css/pages/realisations.css', 'resources/css/pages')
       //.styles(['service.css'], 'public/css/pages/service.css', 'resources/css/pages')
//       .styles(['projects.css'], 'public/css/pages/projects.css', 'resources/css/pages')
//       .styles(['project.css'], 'public/css/pages/project.css', 'resources/css/pages')
       // .styles(['articles.css'], 'public/css/pages/articles.css', 'resources/css/pages')
       // .styles(['article.css'], 'public/css/pages/article.css', 'resources/css/pages')
       //.styles(['services.css'], 'public/css/pages/services.css', 'resources/css/pages')
       //.styles(['404.css'], 'public/css/pages/404.css', 'resources/css/pages')

       .webpack('app.js', 'resources/js/app.js')
//       .webpack('pages/home.js', 'resources/js/pages/home.js')
//       .webpack('pages/ambasador.js', 'resources/js/pages/ambasador.js')
//       .webpack('pages/about.js', 'resources/js/pages/about.js')
       //.webpack('pages/service.js', 'resources/js/pages/service.js')
       //.webpack('pages/realisations.js', 'resources/js/pages/realisations.js')
//       .webpack('pages/register.js', 'resources/js/pages/register.js')
       //.webpack('pages/contact.js', 'resources/js/pages/contact.js')
//       .webpack('pages/login.js', 'resources/js/pages/login.js')
    //    .webpack('pages/projects.js', 'resources/js/pages/projects.js')
    //    .webpack('pages/project.js', 'resources/js/pages/project.js')
    //    .webpack('pages/articles.js', 'resources/js/pages/articles.js')
    //    .webpack('pages/article.js', 'resources/js/pages/article.js')
        //.webpack('pages/showroom.js', 'resources/js/pages/showroom.js')
        //.webpack('pages/services-equipe.js', 'resources/js/pages/services-equipe.js')

//       .webpack('pages/404.js', 'resources/js/pages/404.js')

       .scripts(['app.js'], 'public/js/app.js', 'resources/js')
//       .scripts(['home.js'], 'public/js/pages/home.js', 'resources/js/pages')
//       .scripts(['ambasador.js'], 'public/js/pages/ambasador.js', 'resources/js/pages')
       //.scripts(['showroom.js'], 'public/js/pages/showroom.js', 'resources/js/pages')
       //.scripts(['services-equipe.js'], 'public/js/pages/services-equipe.js', 'resources/js/pages')
       //.scripts(['service.js'], 'public/js/pages/service.js', 'resources/js/pages')
//       .scripts(['about.js'], 'public/js/pages/about.js', 'resources/js/pages')
       //.scripts(['realisations.js'], 'public/js/pages/realisations.js', 'resources/js/pages')
//       .scripts(['register.js'], 'public/js/pages/register.js', 'resources/js/pages')
       //.scripts(['contact.js'], 'public/js/pages/contact.js', 'resources/js/pages')
    //    .scripts(['projects.js'], 'public/js/pages/projects.js', 'resources/js/pages')
    //    .scripts(['project.js'], 'public/js/pages/project.js', 'resources/js/pages')
//       .scripts(['login.js'], 'public/js/pages/login.js', 'resources/js/pages')
       //.scripts(['articles.js'], 'public/js/pages/articles.js', 'resources/js/pages')
       //.scripts(['article.js'], 'public/js/pages/article.js', 'resources/js/pages')
//       .scripts(['404.js'], 'public/js/pages/404.js', 'resources/js/pages');
       // .version(['public/css/base.css', 'public/css/pages/homepage.css', 'public/js/app.js']);

     mix.copy('resources/assets/img', 'public/img');
//     mix.copy('resources/assets/packages', 'public/packages');
     mix.copy('resources/assets/fonts', 'public/fonts');
//     mix.copy('node_modules/sweetalert2/dist/', 'public/packages/sweetalert2');

       // .version(['public/css/base.css', 'public/js/app.js']);
});
