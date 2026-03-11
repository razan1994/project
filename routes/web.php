<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Frontend\FrontendController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::controller(FrontendController::class)->group(function () {
            Route::get('/', 'index')->name('home');
            Route::get('/about-us', 'aboutUs')->name('about-us');
            Route::get('/services', 'services')->name('services');
            Route::get('/services/{slug}', 'serviceDetails')->name('services.details');
            Route::get('/design-build-project', 'designBuildProject')->name('design-build-project');
            Route::get('/contact-us', 'contactUs')->name('contact-us');
            Route::get('/faqs', 'faqs')->name('faqs');
            Route::get('/terms-and-conditions', 'termsAndConditions')->name('terms-and-conditions');
            Route::get('/privacy-policy', 'privacyPolicy')->name('privacy-policy');
        });


    }
);

