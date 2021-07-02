<?php

use Illuminate\Support\Facades\Route;
use App\Packages\Localization\Facades\Localization;
use App\Packages\Sluggable\Routing\Facades\Sluggable;

Route::group([
    'prefix'     => Localization::getRoutePrefix(),
    'middleware' => [
        /* 'allow.development.ips', */
        'localization.default_locale_url_segment_redirect',
        'localization.session_redirect',
    ],
], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('search', 'Page\SearchController@index')->name('search.index');
    Route::get('sitemap.xml', 'Page\SitemapController@index');
    
    Route::post('/devis', 'Page\DevisController@store')->name('devis.store');
    Route::post('/fr/contact', 'Page\ContactController@store')->name('contact.store');
    Route::post('/careers', 'Page\CareersController@store')->name('careers.store');
    Route::post('/newsletter', 'Page\NewsletterController@store')->name('newsletter.store');
    Route::post('/request-service', 'Page\RequestServiceController@store')->name('request_service.store');
    Route::post('/request-appointment', 'Page\RequestAppointmentController@store')->name('request_appointment.store');


    Route::get('{slug}', function ($slug) {

        if (false !== $controllerBag = Sluggable::dispatch(['slug' => $slug])) {
            return App::make($controllerBag->controller())->callAction(
                $controllerBag->method(),
                $controllerBag->arguments()
            );
        }

        abort(404);

    })->where('slug', '.+');
});
