<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                $view->with('siteSettings', SiteSetting::allCached());
            } catch (\Throwable) {
                $view->with('siteSettings', []);
            }
        });
    }
}
