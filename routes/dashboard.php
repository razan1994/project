<?php

use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\ContactUsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\FeatureController;
use App\Http\Controllers\Dashboard\MissionController;
use App\Http\Controllers\Dashboard\PageDesignController;
use App\Http\Controllers\Dashboard\PrivacyPolicyController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SlidersController;
use App\Http\Controllers\Dashboard\SupportTicketController;
use App\Http\Controllers\Dashboard\TermsAndConditionController;
use App\Http\Controllers\Dashboard\ValuesController;
use App\Http\Controllers\Dashboard\VisionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

// Dashboard Routes
// ---------------------

// Login route
// --------------------------------

Route::middleware('guest')->group(function () {
    // Route::get('login', Login::class)->name('login');
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('register', function () {
        return redirect()->route('login');
    })->name('register');
});

Route::get('/', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Dashboard Routes
// ==============================================================================
Route::name('dashboard.')
    ->middleware('auth')
    ->group(function () {


        // Support Tickets Routes :
        // ------------------------------------------
        Route::resource('support-tickets', SupportTicketController::class)->only(['index', 'destroy']);


        // About Us Routes :
        // ------------------------------------------
        Route::controller(AboutController::class)
            ->name('aboutUs.')
            ->prefix('about-us')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit', 'edit')->name('edit');
                Route::patch('/', 'update')->name('update');
            });

        // Our Vision Routes :
        // ------------------------------------------
        Route::controller(VisionController::class)
            ->name('Vision.')
            ->prefix('vision')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit', 'edit')->name('edit');
                Route::patch('/', 'update')->name('update');
            });

        // Our Mission Routes :
        // ------------------------------------------
        Route::controller(MissionController::class)
            ->name('Mission.')
            ->prefix('mission')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit', 'edit')->name('edit');
                Route::patch('/', 'update')->name('update');
            });


        // Our Values Routes :
        // ------------------------------------------
        Route::controller(ValuesController::class)
            ->name('Values.')
            ->prefix('values')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit', 'edit')->name('edit');
                Route::patch('/', 'update')->name('update');
            });


        // Features Routes :
        // ------------------------------------------
        Route::controller(FeatureController::class)
            ->name('feature.')
            ->prefix('feature')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit', 'edit')->name('edit');
                Route::patch('/', 'update')->name('update');
            });


        // Contact Us Routes :
        Route::controller(ContactUsController::class)
            ->name('contactUs.')
            ->prefix('contact-us')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit', 'edit')->name('edit');
                Route::patch('/', 'update')->name('update');
                Route::get('/contact-requests', 'contactUsRequests')->name('contact-us-requests');
            });

        // Services Routes :
        // ------------------------------------------
        Route::controller(ServiceController::class)
            ->name('Services.')
            ->prefix('services')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::get('/create', 'create')->name('create');
                Route::get('/service/{id}/gallery', 'gallery')->name('gallery');
            });

        // Sliders Routes :
        Route::controller(SlidersController::class)
            ->name('sliders.')
            ->prefix('sliders')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/edit/{id}', 'edit')->name('edit');
            });

        // Page Design Routes :
        Route::controller(PageDesignController::class)
            ->name('pageDesign.')
            ->prefix('page-design')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit', 'edit')->name('edit');
                Route::patch('/update', 'update')->name('update');
            });

        // Terms and Conditions Routes :
        // ------------------------------------------
        Route::controller(TermsAndConditionController::class)
            ->name('termsAndConditions.')
            ->prefix('terms-and-conditions')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit', 'edit')->name('edit');
                Route::patch('/', 'update')->name('update');
            });

        // Privacy Policy Routes :
        // ------------------------------------------
        Route::controller(PrivacyPolicyController::class)
            ->name('privacyPolicy.')
            ->prefix('privacy-policy')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit', 'edit')->name('edit');
                Route::patch('/', 'update')->name('update');
            });

        // Faq Routes :
        // ------------------------------------------
        Route::controller(FaqController::class)
            ->name('faq.')
            ->prefix('faq')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::get('/create', 'create')->name('create');
            });

        // Blogs Routes :
        // ------------------------------------------
        Route::controller(BlogController::class)
            ->name('blogs.')
            ->prefix('blogs')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::get('/create', 'create')->name('create');
            });





        Route::get('logout', function () {
            Auth::logout();
            return redirect()->route('home');
        })
            ->name('logout');
    });
