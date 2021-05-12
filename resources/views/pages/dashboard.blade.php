@extends('layouts.default')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
        <a href="{{ route ('global.report') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file text-white-50"></i> Générer un Rapport</a>
    </div>

    {{-- Page Body --}}
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <img class="card-img-top mx-auto mt-2 rounded-circle" src="{{ asset ('storage/'.auth()->user()->profile->photo) }}" style="width:200px">

                <div class="card-body">
                    <h4 class="card-title text-center">Mes informations</h4>
                    <p class="card-text">
                        <i class="fa fa-user-alt"></i> Nom(s) : <b>{{ auth ()->user ()->name }}</b>
                    </p>
                    <p class="card-text">
                        <i class="fa fa-envelope-open-text"></i> Email : <b>{{ auth ()->user ()->email }}</b>
                    </p>
                    <p class="card-text">
                        <i class="fas fa-calendar-week"></i> Création du compte : <b>{{ date_format (date_create (auth ()->user ()->created_at), 'd/m/Y') }}</b>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <!-- Orders Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Commandes (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                 <!-- Products Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Produits (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Category Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Catégories (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $categories }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- Brands Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Marques (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $brands }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-copyright fa-2x text-gray-300"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Non Paid Order Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Commandes impayées (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $not_paid_orders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                 <!-- Product in rupt Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Produits en Rupture (Total)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $out_of_stock_products }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star-half-alt fa-2x text-gray-300"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
