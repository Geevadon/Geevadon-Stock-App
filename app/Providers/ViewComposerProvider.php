<?php

namespace App\Providers;

use App\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.default', function ($view) {

            if (Schema::hasTable('notifications')) {
                $notifications_count = Notification::all()->count();
                $notifications = Notification::orderBy('created_at', 'desc')->paginate(3);
            } else {
                $notifications_count = 0;
                $notifications = [];
            }

            $view->with(compact('notifications', 'notifications_count'));
        });
    }
}
