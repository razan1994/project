<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Frontend\FrontendController;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

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
            Route::post('/contact-us', 'submitContactUs')->name('contact-us.submit');
            Route::get('/blogs', 'blogs')->name('blogs');
            Route::get('/blogs/{slug}', 'blogDetails')->name('blogs.details');
            Route::get('/faqs', 'faqs')->name('faqs');
            Route::get('/terms-and-conditions', 'termsAndConditions')->name('terms-and-conditions');
            Route::get('/privacy-policy', 'privacyPolicy')->name('privacy-policy');

                // Consultation Request
                Route::post('/consultation-request', 'submitConsultationRequest')->name('consultation-request.submit');

             // ================== Test Email ==================
    Route::get('/send-test-email', function () {
        $emailContent = (object)[
            'subject' => 'Hello from Aljeel',
            'desc_ar' => 'test message from Aljeel '
        ];
        Mail::to('rznjamal@gmail.com')->send(new TestEmail($emailContent, null));
        return 'Successfully sent';
    });
        });


    }
);

