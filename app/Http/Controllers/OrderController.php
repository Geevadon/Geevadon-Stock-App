<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderDetail;
use App\Rules\GoodPaymentAmount;
use App\Rules\StockSufficient;
use App\StockCard;
use NumberFormatter;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy ('created_at', 'desc')->where ('status', 'paid')->Orwhere ('status', 'not_paid')->get ();

        return view ('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where ('quantity', '>', 0)->get ();

        return view ('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation normale des champs
        request ()->validate([
            'order_added_date' => ['required', 'date'],
            'order_customer_name' => ['required', 'string'],
            'order_product' => ['required'],
            'order_discount' => ['nullable', 'regex:/^\d*(\.\d{2})?$/'],
            'order_workforce' => ['nullable', 'regex:/^\d*(\.\d{2})?$/'],
            'order_paid' => ['nullable', 'regex:/^\d*(\.\d{2})?$/'],
            'order_payment_type' => ['required', 'in:Cash,Carte,Chèque'],
            'order_currency' => ['required', 'in:USD,CDF,EUR'],
            'order_designation' => ['required', 'string']
        ], [
            'order_product.required' => 'Veillez sélectionner au moins un produit.',
            'order_discount.regex' => 'Mettez une valeur numérique entière ou ayant 2 chiffres après la virgule.',
            'order_workforce.regex' => 'Mettez une valeur numérique entière ou ayant 2 chiffres après la virgule.',
            'order_paid.regex' => 'Mettez une valeur numérique entière ou ayant 2 chiffres après la virgule.',
            'order_payment_type.in' => 'Seules les valeurs "Cash", "Carte" et "Chèque" sont valables.',
            'order_currency.in' => 'Seules les valeurs "USD", "CDF" et "EUR" sont valables.'
        ]);

        // Validation de la quantite en stock pour chaque priduit
        $all_products = Product::all ();

        foreach ($all_products as $product) {
            request ()->validate ([
                'order_product_quantity_'.$product->id => [new StockSufficient ($product->id, $product->name, $product->quantity), 'numeric']
            ]);
        }

        // ========================= C'EST PARTI POUR LES CALCULS ========================

        // Calcul du sous-total (prix totals et quantites totales)
        $products = request ()->order_product;
        $prices = [];

        foreach ($products as $k => $v) {
            Product::findOrFail ($v);
        }

        /**
         * Dans une boucle, on verifie si le produit a un stock suffisant pour la quantite souhaitee
         * Si oui, on diminue le stock du produit. Sinon, on revoie un message d'erreur
         *
         * On ajoute dans un tableau $prices chaque produit multiplié par la quantite saisie par l'utilisateur
         * On met aussi a jour le statut du produit selon que son stock devient insuffisant ou pas
         */
        foreach ($products as $k => $v) {

            $given_quantity = intval (request ('order_product_quantity_'.$v));
            $product_stock = Product::findOrFail ($v)->quantity;
            $product_alert = Product::findOrFail ($v)->alert;
            $product_status = Product::findOrFail ($v)->status;

            if ($product_stock >= $given_quantity) {
                // remaining stock = stock restant
                $remaining_stock = $product_stock - $given_quantity;

                // On met a jour le stock du produit pour le diminuer.
                Product::find ($v)->update ([
                    'quantity' => $remaining_stock
                ]);

                // On teste si le stock restant est infereur ou egal au stock d'alerte et si le statut du produit est "sufficient". Si oui, on met a jour le statut à "not_sufficient"
                if ($remaining_stock <= $product_alert && $product_status == 'sufficient') {

                    Product::find ($v)->update ([
                        'status' => 'not_sufficient'
                    ]);

                }

            }

            array_push ($prices, Product::findOrFail ($v)->price * intval (request ('order_product_quantity_'.$v)));
        }

        $sub_total = array_sum ($prices);


        // Calcul du montant net
        $tva = $sub_total * 0.16;
        $discount = request ()->order_discount != null ? intval(request ()->order_discount) : 0;
        $workforce = request ()->order_workforce != null ? intval(request ()->order_workforce) : 0;
        $net_total = ($sub_total + $tva + $workforce) - $discount;

        // Calcul du montant dû
        $paid = request ()->order_paid != null ? intval(request ()->order_paid) : 0;
        $due = $net_total - $paid;

        // On genere le Montant en Lettres
        $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
        $amount_in_letters = ucfirst($f->format ($due));

        // ------------ Insertion des donnees dans la table Orders ------------
        $data = Order::create ([
            'customer_name' => request ()->order_customer_name,
            'added_date' => request ()->order_added_date,
            'sub_total' => $sub_total,
            'tva' => $tva,
            'discount' => $discount,
            'workforce' => $workforce,
            'net_total' => $net_total,
            'paid' => $paid,
            'due' => $due,
            'payment_type' => request ()->order_payment_type,
            'currency' => request ()->order_currency,
            'amount_in_letters' => $amount_in_letters,
            'designation' => request ()->order_designation
        ]);

        //On genere le numero de la commande
        $format_date = date_format (date_create (request ()->order_added_date), 'Y');
        $order_number = "TL".$format_date.'ID'.$data->id;

        //On insere le numero de la commande (order_number) dans la table Orders
        Order::findOrFail ($data->id)->update ([
            'order_number' => $order_number
        ]);

        // ------------ Insertion des donnees dans la table Order_Details ------------
        foreach ($products as $k => $v) {
            OrderDetail::create ([
                'product_name' => Product::findOrFail ($v)->name,
                'product_price' => Product::findOrFail ($v)->price,
                'product_quantity' => request ('order_product_quantity_'.$v) ? request ('order_product_quantity_'.$v) : 0,
                'order_id' => $data->id
            ]);
        }

        // ------------ Insertion des donnees dans la table Stock_Card ------------
        foreach ($products as $k => $v) {
            StockCard::create ([
                'product_id' => Product::findOrFail ($v)->id,
                'product_name' => Product::findOrFail ($v)->name,
                'product_price' => Product::findOrFail ($v)->price,
                'product_quantity' => request ('order_product_quantity_'.$v) ? request ('order_product_quantity_'.$v) : 0,
                'status' => 'out'
            ]);
        }

        set_message_flash ('Commande ajoutée avec succès !');

        return redirect()->route ('orders.index');


        //dd ('Sous total : '. $sub_total, 'TVA : '. $tva, 'Remise : '.$discount, 'Main d\'oeuvre : '.$workforce, 'Total Net : '.$net_total, 'Payé : '.$paid, 'Due : '.$due, 'Montant en lettres : '.$amount_in_letters);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($order = Order::where ('id', $id)->where ('status', 'paid')->orwhere ('status', 'not_paid')->where ('id', $id)->get ()->count () == 0) {

            abort (404);

        }else {

            $order = Order::findOrFail ($id);
            return view ('orders.show', compact ('order'));

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index_order_payment(Request $request, $id)
    {
        $order = Order::findOrFail ($id);

        return view ('payment.index', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_order_payment($id)
    {
        $order = Order::findOrFail ($id);

        request ()->validate([
            'order_payment_amount' => ['required', 'regex:/^\d*(\.\d{2})?$/', new GoodPaymentAmount ($order->due)]
        ], [
            'order_payment_amount.regex' => 'Mettez une valeur numérique entière ou ayant 2 chiffres après la virgule.'
        ]);

        $order->due -= request ()->order_payment_amount;
        $order->save ();

        // On teste si la dette a ete integralement payee pour mettre a jour le statut de la commande
        if ($order->due == 0) {
            $order->update ([
                'status' => 'paid'
            ]);
        }

        set_message_flash('Commande payée avec succès !');

        return redirect()->route ('orders.index');

        // if (Order::where ('status', 'not_paid')->where ('id', $id)->get ()->count () > 0) {

        //     Order::find ($id)->update ([
        //         'status' => 'paid'
        //     ]);

        //     set_message_flash('Commande definie comme payée avec succès !');

        //     return redirect()->route ('orders.index');

        // }else if (Order::where ('status', 'paid')->where ('id', $id)->get ()->count () > 0) {

        //     set_message_flash('Cette commande est déjà payée !', 'danger');

        //     return redirect()->route ('orders.index');

        // }else if (Order::where ('status', 'trash_paid')->orWhere ('status', 'trash_not_paid')->where ('id', $id)->get ()->count () > 0) {

        //     set_message_flash('Cette commande est dans la corbeille !', 'danger');

        //     return redirect()->route ('orders.index');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        // dd (Order::where ('id', $id)->where (function ($query) {
        //     $query->where ('status', 'trash_paid')
        //         ->Orwhere ('status', 'trash_not_paid');
        // })->first ());
        Order::findOrFail ($id);

        if (Order::where ('id', $id)->where (function ($query) {
            $query->where ('status', 'trash_paid')
                ->Orwhere ('status', 'trash_not_paid');
        })->get ()->count () > 0) {

            set_message_flash('Cette commande est déjà en corbeille !', 'danger');

            return redirect()->route ('orders.index');

        }else if (Order::where ('status', 'paid')->where ('id', $id)->get ()->count () > 0) {

            Order::find ($id)->update ([
                'status' => 'trash_paid'
            ]);

            set_message_flash('Commande mise en corbeille avec succès !');

            return redirect()->route ('orders.index');

        }else if (Order::where ('status', 'not_paid')->where ('id', $id)->get ()->count () > 0) {

            Order::find ($id)->update ([
                'status' => 'trash_not_paid'
            ]);

            set_message_flash('Commande mise en corbeille avec succès !');

            return redirect()->route ('orders.index');

        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
