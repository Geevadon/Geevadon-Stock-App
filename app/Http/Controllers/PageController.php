<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home () {
        return view ('pages.home');
    }

    public function dashboard () {
        $orders = Order::all ()->count ();
        $products = Product::all ()->count ();
        $categories = Category::all ()->count ();
        $brands = Brand::all ()->count ();
        $not_paid_orders = Order::where ('status', 'not_paid')->count ();
        $out_of_stock_products = Product::where ('status', 'not_sufficient')->count ();

        return view ('pages.dashboard', compact ('orders', 'products', 'categories', 'brands', 'not_paid_orders', 'out_of_stock_products'));
    }

    public function help () {
        return view('pages.help');
    }
}
