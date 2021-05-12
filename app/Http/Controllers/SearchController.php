<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search () {
        $query = request ('search_query');

        if ($query == null) {
            $products = null;
        }else {
            $products = Product::where ('name', 'like', '%'.$query.'%')->get ();

            if ($products->count () == 0) {
                $products = null;
            }
        }


        return view('search.search', compact('products', 'query'));
    }
}
