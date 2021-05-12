@extends('layouts.default')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Gestion de Commandes</h1>
        <a href="{{ route ('orders.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Liste de Commandes</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info"></i> Détails - {{ $order->order_number }}</h6>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">Numéro de la commande : <b>{{ $order->order_number }}</b></li>
                <li class="list-group-item">Date de la commande : <b>{{ date_format (date_create ($order->added_date), 'd/m/Y') }}</b></li>
                <li class="list-group-item">Nom du client : <b>{{ $order->customer_name }}</b></li>
                <li class="list-group-item">Sous-total : <b>{{ number_format ($order->sub_total, 2, ',', '.'). ' $' }}</b></li>
                <li class="list-group-item">TVA (16%) : <b>{{ number_format ($order->tva, 2, ',', '.'). ' $' }}</b></li>
                <li class="list-group-item">Remise : <b>{{ number_format ($order->discount, 2, ',', '.'). ' $' }}</b></li>
                <li class="list-group-item">Main d'oeuvre : <b>{{ number_format ($order->workforce, 2, ',', '.'). ' $' }}</b></li>
                <li class="list-group-item">Montant net : <b>{{ number_format ($order->net_total, 2, ',', '.'). ' $' }}</b></li>
                <li class="list-group-item">Montant payé : <b>{{ number_format ($order->paid, 2, ',', '.'). ' $' }}</b></li>
                <li class="list-group-item">Montant dû : <b>{{ number_format ($order->due, 2, ',', '.'). ' $' }}</b></li>
                <li class="list-group-item">Montant dû en lettres : <b>{{ $order->amount_in_letters. ' dollars américains' }}</b></li>
                <li class="list-group-item">Devise : <b>{{ $order->currency }}</b></li>
                <li class="list-group-item">Type de paiement : <b>{{ $order->payment_type }}</b></li>
                <li class="list-group-item">Statut : <b>{{ $order->status == 'not_paid' ? 'Non payé' : 'Payé' }}</b></li>
                <li class="list-group-item">Désignation : <b>{{ $order->designation }}</b></li>
                <li class="list-group-item">
                    {{$order->order_details->count () > 1 ? Str::plural ('Produit') : 'Produit' }} :
                    <ul>
                        @foreach ($order->order_details as $detail)
                            <li><b>{{ $detail->product_name }} </b> {{ ' (Quantité : '.$detail->product_quantity. ')' }}</li>
                        @endforeach
                    </ul>
                </li>
              </ul>
        </div>
    </div>
@endsection
