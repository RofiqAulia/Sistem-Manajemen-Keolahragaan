<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\AuthorizationService;


class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // $this->app->singleton('authorization', function ($app) {
        //     return new AuthorizationService();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // View::composer('*', function ($view) {
        //     $view->with('activeMenu', 'news');
        // });
    }
}
