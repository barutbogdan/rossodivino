<?php

use Illuminate\Routing\Router;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('admin.prefix'),
    'namespace' => Admin::controllerNamespace(),
    'middleware' => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // Content
    $router->resource('content/team', TeamController::class);
    $router->resource('content/tags', PageTagsController::class);
    $router->resource('content/pages', PageController::class);
    $router->resource('content/pages.images', PagesImagesController::class);
    $router->resource('content/slides', SlidesController::class);
    $router->resource('content/articles', ArticlesController::class);
    $router->resource('content/articles-category', ArticlesCategoryController::class);
    $router->resource('content/services', ServicesController::class);
    $router->resource('content/partners', PartnersController::class);
    $router->resource('content/projects', ProjectsController::class);
    $router->resource('content/positions', PositionsController::class);
    $router->resource('content/questions', QuestionsController::class);
    $router->resource('content/translations', TranslationController::class);
    $router->resource('content/testimonials', TestimonialsController::class);
    $router->resource('content/realisations', RealisationsController::class);
    $router->resource('content/realisations-category', RealisationsCategoryController::class);
    $router->resource('content/realisations.images', RealisationsImagesController::class);
    $router->resource('content/team-category', TeamCategoryController::class);
    $router->resource('content/projects.images', ProjectsImagesController::class);
    $router->resource('content/projects-category', ProjectsCategoryController::class);
    $router->resource('content/services-category', ServicesCategoryController::class);
    $router->resource('content/positions-category', PositionsCategoryController::class);

    // Admin
    $router->resource('auth/settings', SettingController::class);
    $router->resource('auth/email-templates', EmailTemplateController::class);

    $router->get('auth/translations_clear', 'TranslationController@clearCache');
});
