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
            Route::get(__('routes.home'), 'index')->name('home');
            Route::get(__('routes.about_us'), 'aboutUs')->name('about-us');
            Route::get(__('routes.services'), 'services')->name('services');
            Route::get(__('routes.services') . '/{slug}', 'serviceDetails')->name('services.details');
            Route::get(__('routes.design_build_project'), 'designBuildProject')->name('design-build-project');
            Route::get(__('routes.contact_us'), 'contactUs')->name('contact-us');
            Route::post(__('routes.contact_us'), 'submitContactUs')->name('contact-us.submit');
            Route::get(__('routes.blogs'), 'blogs')->name('blogs');
            Route::get(__('routes.blogs') . '/{slug}', 'blogDetails')->name('blogs.details');
            Route::get(__('routes.faqs'), 'faqs')->name('faqs');
            Route::get(__('routes.terms_and_conditions'), 'termsAndConditions')->name('terms-and-conditions');
            Route::get(__('routes.privacy_policy'), 'privacyPolicy')->name('privacy-policy');
            Route::get(__('routes.gallery'), 'gallery')->name('gallery');

                // Consultation Request
                Route::post(__('routes.consultation_request'), 'submitConsultationRequest')->name('consultation-request.submit');

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

