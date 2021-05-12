@extends('layouts.report')

@section('content')

    <div class="row mb-3">
        <div class="col-md-6 text-left">
            <h2><i class="fa fa-file-alt"></i>&nbsp; Rapport Global</h2>
        </div>
        <div class="col-md-6 text-right align-self-center to-hide">
            <h6><a href="{{ route ('page.dashboard') }}"><i class="fa fa-arrow-left"></i> Revenir au Tableau de Bord</a></h6>
        </div>
    </div>

    <ul class="list-group">
        <li class="list-group-item">Nombre de commandes : <b>{{ $orders }}</b></li>
        <li class="list-group-item">Nombre de produits : <b>{{ $products }}</b></li>
        <li class="list-group-item">Nombre de catégories : <b>{{ $categories }}</b></li>
        <li class="list-group-item">Nombre de marques : <b>{{ $brands }}</b></li>
        <li class="list-group-item">Nombre de commandes non payées : <b>{{ $not_paid_orders }}</b></li>
        <li class="list-group-item">Nombre de produits en rupture de stock : <b>{{ $out_of_stock_products }}</b></li>
    </ul>

    <div class="text-right">
        <button type="button" class="btn btn-primary mt-2 print"><i class="fa fa-print"></i>&nbsp; Imprimer</button>
    </div>
@endsection
