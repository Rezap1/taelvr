<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        \App\Models\Setting::observe(\App\Observers\SettingObserver::class);
        \App\Models\Menu::observe(\App\Observers\MenuObserver::class);
        \App\Models\ProfilFakultas::observe(\App\Observers\ProfilFakultasObserver::class);
        \App\Models\Banner::observe(\App\Observers\BannerObserver::class);

        if (str_contains(config('app.url'), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
