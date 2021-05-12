<?php

namespace App\Observers;

use App\Brand;
use App\Product;
use App\Category;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        // On met a jour le statut de la marque et de la categorie
        if ($product->category->status != 'used') {
            $product->category->update ([
                'status' => 'used'
            ]);
        }

        if ($product->brand->status != 'used') {
            $product->brand->update ([
                'status' => 'used'
            ]);
        }
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        // Mis a jour du statut de la Categorie
        $category_id = $product->category->id;
        $category = Category::findOrFail ($category_id);

        if ($category->products->count () == 0) {
            $category->update ([
                'status' => 'not_used'
            ]);
        }

        // Mis a jour du statut de la Marque
        $brand_id = $product->brand->id;
        $brand = Brand::findOrFail ($brand_id);

        if ($brand->products->count () == 0) {
            $brand->update ([
                'status' => 'not_used'
            ]);
        }
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
