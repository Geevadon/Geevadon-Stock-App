<?php

namespace App\Providers;

use App\User;
use App\Product;
use App\Observers\UserObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

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
        // Set timezone to whole the projetc
        date_default_timezone_set('Europe/Paris');

        // Observers registrations
        User::observe (UserObserver::class);
        Product::observe (ProductObserver::class);
    }
}
