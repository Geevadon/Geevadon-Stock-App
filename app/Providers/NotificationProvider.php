<?php

namespace App\Providers;

use App\Product;
use App\Notification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class NotificationProvider extends ServiceProvider
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
        if (Schema::hasTable('product' && Schema::hasTable('notifications'))) {

            $products = Product::all();

            foreach ($products as $product) {

                if ($product->alert >= $product->quantity) {
                    if (Notification::where('product_name', $product->name)->get()->count() == 0) {

                        Notification::create([
                            'product_name' => $product->name,
                            'content' => 'Le stock du produit "' . $product->name . '" est insuffisant. (Stock d\'alerte = ' . $product->alert . ', et Stock actuel = ' . $product->quantity . ').'
                        ]);
                    }
                }
            }
        }
    }
}
