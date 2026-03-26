<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 1. GLOBAL SCHOOL NAME
        View::composer('*', function ($view) {
            $view->with('school', 'University Of Mindanao');
        });

        // 2. CUSTOM DIRECTIVES
        Blade::directive('upper', function ($expression) {
            return "<?php echo strtoupper($expression); ?>";
        });

        Blade::directive('lower', function ($expression) {
            return "<?php echo strtolower($expression); ?>";
        });
    }
}