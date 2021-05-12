<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where ('status', 'trash_paid')->orWhere ('status', 'trash_not_paid')->get ();

        return view ('order-history.index', compact ('orders'));
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
        if ($order = Order::where ('id', $id)->where ('status', 'trash_paid')->orwhere ('status', 'trash_not_paid')->where ('id', $id)->get ()->count () == 0) {

            abort (404);

        }else {

            $order = Order::findOrFail ($id);
            return view ('order-history.show', compact ('order'));

        }
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
        $product = Order::findOrFail ($id);

        // Un element de l'histoire doit faire aumoins 32 jours dans l'histoire avant d'etre supprimable
        $date = $product->created_at->addDays(32);
        $now = Carbon::now ();
        $diff = $now->diffInDays ($date, false);

        if ($diff > 0) {

            set_message_flash('Cet élement ne peut pas être supprimé car il n\'a pas encore fait au moins 1 mois dans l\'historique !', 'danger');

            return redirect()->route ('order-history.index');

        }

        if (Order::where ('status', 'trash_paid')->where ('id', $id)->orWhere ('status', 'trash_not_paid')->where ('id', $id)->get ()->count () == 0) {
            set_message_flash('Imposible de supprimer cette commande car elle n\'est pas encore dans la corbeille.', 'danger');

            return redirect()->route ('order-history.index');
        }

        Order::destroy($id);

        set_message_flash('Commande supprimée avec succès !');

        return redirect()->route ('order-history.index');
    }
}
