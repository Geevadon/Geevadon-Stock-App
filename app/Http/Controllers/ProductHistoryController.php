<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\ProductHistory;
use App\StockCard;
use Illuminate\Http\Request;

class ProductHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products_history = StockCard::orderBy('created_at', 'desc')
                        ->where ('status', 'in_approv')
                        ->get ();

        return view ('product-history.index', compact('products_history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = StockCard::findOrFail ($id);

        // Un element de l'histoire doit faire aumoins 32 jours dans l'histoire avant d'etre supprimable
        $date = $product->created_at->addDays(32);
        $now = Carbon::now ();
        $diff = $now->diffInDays ($date, false);

        if ($diff > 0) {

            set_message_flash('Cet élement ne peut pas être supprimé car il n\'a pas encore fait au moins 1 mois dans l\'historique !', 'danger');

            return redirect()->route ('product-history.index');

        }

        StockCard::destroy($id);

        set_message_flash('Élement supprimé de l\'historique avec succès !');

        return redirect()->route ('product-history.index');
    }
}
