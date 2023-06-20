<?php

namespace App\Providers;

use App\View\Components\InputPassword;
use App\View\Components\ValidationErrors;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
        
        Blade::component('input-password', InputPassword::class);
        Blade::component('validation-errors', ValidationErrors::class);
    }
}
