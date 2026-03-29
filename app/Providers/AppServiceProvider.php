<?php

namespace App\Providers;

use App\Models\ContactUs;
use App\Models\Service;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Mcamara\LaravelLocalization\Traits\LoadsTranslatedCachedRoutes;


class AppServiceProvider extends ServiceProvider
{
    use LoadsTranslatedCachedRoutes;
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->composeFrontendContactData();
       RouteServiceProvider::loadCachedRoutesUsing(fn () => $this->loadCachedRoutes());
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null
        );
    }

    /**
     * Share contact data with frontend layout partials.
     */
    protected function composeFrontendContactData(): void
    {
        View::composer(['frontend.layout.app', 'frontend.layout.partials.header', 'frontend.layout.partials.footer'], function ($view) {
            $view->with('contact', ContactUs::query()->first());
            $view->with('services', Service::query()->where('status', 1)->latest('id')->limit(5)->get());
        });
    }
}
