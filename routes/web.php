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
            Route::get(LaravelLocalization::transRoute('routes.home'), 'index')->name('home');
            Route::get(LaravelLocalization::transRoute('routes.about_us'), 'aboutUs')->name('about-us');
            Route::get(LaravelLocalization::transRoute('routes.services'), 'services')->name('services');
            Route::get(LaravelLocalization::transRoute('routes.services') . '/{slug}', 'serviceDetails')->name('services.details');
            Route::get(LaravelLocalization::transRoute('routes.projects'), 'projects')->name('projects');
            Route::get(LaravelLocalization::transRoute('routes.projects') . '/{slug}', 'projectDetails')->name('projects.details');
            Route::get(LaravelLocalization::transRoute('routes.design_build_project'), 'designBuildProject')->name('design-build-project');
            Route::get(LaravelLocalization::transRoute('routes.contact_us'), 'contactUs')->name('contact-us');
            Route::post(LaravelLocalization::transRoute('routes.contact_us'), 'submitContactUs')->name('contact-us.submit');
            Route::get(LaravelLocalization::transRoute('routes.blogs'), 'blogs')->name('blogs');
            Route::get(LaravelLocalization::transRoute('routes.blogs') . '/{slug}', 'blogDetails')->name('blogs.details');
            Route::get(LaravelLocalization::transRoute('routes.faqs'), 'faqs')->name('faqs');
            Route::get(LaravelLocalization::transRoute('routes.terms_and_conditions'), 'termsAndConditions')->name('terms-and-conditions');
            Route::get(LaravelLocalization::transRoute('routes.privacy_policy'), 'privacyPolicy')->name('privacy-policy');
            Route::get(LaravelLocalization::transRoute('routes.gallery'), 'gallery')->name('gallery');

                // Consultation Request
                Route::post(LaravelLocalization::transRoute('routes.consultation_request'), 'submitConsultationRequest')->name('consultation-request.submit');

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

