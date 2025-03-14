<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UtilsHelperProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        require_once app_path('Services/Utils.php');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
