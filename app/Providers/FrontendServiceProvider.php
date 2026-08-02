<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\ProfilFakultas;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // View Composer untuk layout frontend dan halamannya
        View::composer(['layouts.frontend', 'frontend.*', 'errors.*'], function ($view) {
            
            // Pengaturan Website
            $settings = Cache::remember('global_settings', 3600, function () {
                $settingItems = Setting::all()->pluck('value', 'key')->toArray();
                return $settingItems;
            });

            // Profil Singkat
            $profil = Cache::remember('global_profil', 3600, function () {
                return ProfilFakultas::first();
            });

            // Menu Utama
            $menus = Cache::remember('global_menus', 3600, function () {
                return Menu::active()->ordered()->get();
            });

            $view->with('settings', $settings)
                 ->with('profil', $profil)
                 ->with('menus', $menus);
        });
    }
}
