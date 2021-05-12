<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Order;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function globalReport () {
        $orders = Order::all ()->count ();
        $products = Product::all ()->count ();
        $categories = Category::all ()->count ();
        $brands = Brand::all ()->count ();
        $not_paid_orders = Order::where ('status', 'not_paid')->count ();
        $out_of_stock_products = Product::where ('status', 'not_sufficient')->count ();

        return view ('reports.global-report', compact ('orders', 'products', 'categories', 'brands', 'not_paid_orders', 'out_of_stock_products'));
    }

    public function getInvoice ($id) {

        $order = Order::findOrFail ($id);

        return view ('reports.invoice', compact('order'));
    }
}
