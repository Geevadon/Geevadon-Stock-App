<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Order;
use App\Product;
use App\Category;
use App\ProductHistory;
use App\StockCard;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all ();

        return view ('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all ();
        $brands = Brand::all ();

        return view ('products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'product_added_date' => ['required', 'date'],
            'product_name' => ['required', 'string', 'unique:products,name'],
            'product_category' => ['required'],
            'product_brand' => ['required'],
            'product_price' => ['required', 'regex:/^\d*(\.\d{2})?$/'],
            'product_quantity' => ['required', 'numeric'],
            'product_alert' => ['nullable', 'numeric']
        ], [
            'product_price.regex' => 'Mettez une valeur numérique entière ou ayant 2 chiffres après la virgule.',
            'product_name.unique' => 'Ce nom de produit est déjà pris.'
        ]);

        $alert = request()->product_alert ? : 5;
        $quantity = request()->product_quantity;

        $data = Product::create ([
            'name' => request()->product_name,
            'price' => request()->product_price,
            'quantity' => request()->product_quantity,
            'added_date' => request()->product_added_date,
            'alert' => $alert,
            'status' => $alert >= $quantity ? 'not_sufficient' : 'sufficient',
            'category_id' => request()->product_category,
            'brand_id' => request()->product_brand
        ]);

        // On enregistre les informations de l'approvisionnement dans la table "stock_card"
        $product = Product::findOrFail ($data->id);
        StockCard::create ([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_quantity' => request ('product_quantity'),
            'product_price' => $product->price,
            'status' => 'in'
        ]);

        set_message_flash('Produit ajouté avec succès !');

        return redirect()->route ('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort (404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all ();
        $brands = Brand::all ();
        $product = Product::findOrFail ($id);

        return view ('products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'product_added_date' => ['required', 'date'],
            'product_name' => ['required', 'string', 'unique:products,name,'.$id],
            'product_category' => ['required'],
            'product_brand' => ['required'],
            // 'product_price' => ['required', 'regex:/^\d*(\.\d{2})?$/'],
            // 'product_quantity' => ['required', 'numeric'],
            'product_alert' => ['nullable', 'numeric']
        ], [
            // 'product_price.regex' => 'Mettez une valeur numérique entière ou ayant 2 chiffres après la virgule.',
            'product_name.unique' => 'Ce nom de produit est déjà pris.'
        ]);

        $alert = request()->product_alert ? : 5;
        // $quantity = request()->product_quantity;

        Product::findOrFail ($id)->update ([
            'name' => request()->product_name,
            // 'price' => request()->product_price,
            // 'quantity' => request()->product_quantity,
            'added_date' => request()->product_added_date,
            'alert' => $alert,
            // 'status' => $alert >= $quantity ? 'not_sufficient' : 'sufficient',
            'category_id' => request()->product_category,
            'brand_id' => request()->product_brand
        ]);

        set_message_flash('Produit mis à jour avec succès !');

        return redirect()->route ('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail ($id);

        Product::destroy($id);
        set_message_flash('Produit supprimé avec succès !');

        return redirect()->route ('products.index');
    }

    /**
     * Make Stock Supply the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_stock_supply($id)
    {
        $product = Product::findOrFail ($id);

        return view ('stock-supply.edit', compact('product'));
    }

    /**
     * Update : Make Stock Supply the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_stock_supply($id)
    {
        request ()->validate([
            'product_quantity' => ['required', 'regex:/^\d*(\.\d{2})?$/']
        ], [
            'product_quantity.regex' => 'Mettez une valeur numérique entière ou ayant 2 chiffres après la virgule.'
        ]);

        // On approvisionne le stock du produit en y ajoutant la valeur saisie par l'utilisateur
        $product = Product::findOrFail ($id);

        $product->quantity += request ('product_quantity');

        $product->save ();

        // On verifie si le stock d'alerte est supperieur ou egal a la quantite pour mettre a jour le statut du produit
        if ($product->alert >= $product->quantity && $product->status == 'sufficient') {

            $product->update ([
                'status' => 'not_sufficient'
            ]);

        }else {
            $product->update ([
                'status' => 'sufficient'
            ]);
        }

        // On enregistre les informations de l'approvisionnement dans la table "Stock_Card"
        StockCard::create ([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_quantity' => request ('product_quantity'),
            'product_price' => $product->price,
            'status' => 'in_approv'
        ]);

        set_message_flash('Produit approvisionné avec succès !');

        return redirect()->route ('products.index');
    }

    /**
     * Make Stock Supply the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function card_stock_value($id)
    {

        $stock_cards = StockCard::where ('product_id', $id)->get ();

        $product = StockCard::orderBy ('created_at', 'desc')->where ('product_id', $id)->first ();

        if ($stock_cards->count () == 0) {
            abort (404);
        }

        return view ('products.stock-card-value', compact('stock_cards', 'product'));
    }

    /**
     * Make Stock Supply the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function card_stock_quantity($id)
    {

        $stock_cards = StockCard::orderBy ('created_at', 'asc')->where ('product_id', $id)->get ();

        $product = StockCard::where ('product_id', $id)->first ();

        if ($stock_cards->count () == 0) {
            abort (404);
        }

        return view ('products.stock-card-quantity', compact('stock_cards', 'product'));
    }

}
