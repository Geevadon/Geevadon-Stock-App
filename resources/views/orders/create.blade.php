@extends('layouts.default')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Gestion de Commandes</h1>
    <a href="{{ route ('orders.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Liste de Commandes</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-plus"></i> Nouvelle Commande</h6>
    </div>
    <div class="card-body">

        <form method="POST" action="{{ route ('orders.store') }}" novalidate>
            <div class="form-row">
                <div class="col-md-6 px-3">

                    {{-- <div class="form-group row">
                        @csrf
                        <label for="order_product" class="col-md-5 col-form-label col-form-label">Produit(s) <span class="text-danger">*</span></label>

                    </div> --}}

                    <div class="form-group row">
                        @csrf
                        <label for="order_added_date" class="col-md-5 col-form-label col-form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('order_added_date') is-invalid @enderror col-md-7" id="order_added_date" name="order_added_date" value="{{ old ('order_added_date') ?: date ('Y-m-d') }}" required>

                        @error('order_added_date')
                        <div class="invalid-feedback text-danger text-right" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        @csrf
                        <label for="order_customer_name" class="col-md-5 col-form-label col-form-label">Nom(s) du client <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('order_customer_name') is-invalid @enderror col-md-7" id="order_customer_name" name="order_customer_name" value="{{ old ('order_customer_name') }}" autofocus required>

                        @error('order_customer_name')
                        <div class="invalid-feedback text-danger text-right" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="order_product" class="col-md-5">Produit(s) <span class="text-danger">*</span></label>
                        <div class="col-md-7 border border-muted rounded @error('order_product') border-danger @enderror" style="max-height: 230px; overflow: scroll;">

                            <ul class="list-group list-group-flush list-group-item-action">

                                @foreach ($products as $product)
                                    <li class="list-group-item list-group-item-action">
                                        <input type="checkbox" class="form-check-input" value="{{ $product->id }}" id="order_product_{{ $product->id }}" name="order_product[]" {{ old ('order_product') != null && in_array ($product->id, old ('order_product')) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="order_product_{{ $product->id }}">
                                            {{ $product->name }}
                                        </label>
                                        <input type="number" class="form-control form-control-sm @error ('order_product_quantity_'.$product->id) is-invalid @enderror" placeholder="Quantité..." name="order_product_quantity_{{ $product->id }}" value="{{ old ('order_product_quantity_'.$product->id) ?: 1 }}">
                                    </li>

                                @endforeach


                            </ul>

                        </div>

                        @error('order_product')

                            <div class="invalid-feedback text-danger text-right" role="alert">
                                <b>{{ $message }}</b>
                            </div>

                        @enderror

                        @foreach ($products as $product)

                            @error('order_product_quantity_'. $product->id)
                                <div class="invalid-feedback text-danger text-right" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror

                        @endforeach

                    </div>

                </div>

                <div class="col-md-6 px-3">

                    <div class="form-group row">
                        @csrf
                        <label for="order_discount" class="col-md-5 col-form-label col-form-label">Remise</label>
                        <input type="number" class="form-control @error('order_discount') is-invalid @enderror col-md-7" id="order_discount" name="order_discount" value="{{ old ('order_discount') }}">

                        @error('order_discount')
                        <div class="invalid-feedback text-danger text-right" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        @csrf
                        <label for="order_workforce" class="col-md-5 col-form-label col-form-label">Main d'oeuvre</label>
                        <input type="number" class="form-control @error('order_workforce') is-invalid @enderror col-md-7" id="order_workforce" name="order_workforce" value="{{ old ('order_workforce') }}">

                        @error('order_workforce')
                        <div class="invalid-feedback text-danger text-right" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        @csrf
                        <label for="order_paid" class="col-md-5 col-form-label col-form-label">Montant payé</label>
                        <input type="number" class="form-control @error('order_paid') is-invalid @enderror col-md-7" id="order_paid" name="order_paid" value="{{ old ('order_paid') }}">

                        @error('order_paid')
                        <div class="invalid-feedback text-danger text-right" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        @csrf
                        <label for="order_payment_type" class="col-md-5 col-form-label col-form-label">Moyen de paiement <span class="text-danger">*</span></label>
                        <select class="form-control @error('order_payment_type') is-invalid @enderror col-md-7" id="order_payment_type" name="order_payment_type" required>
                            <option value="Cash" {{ old ('order_payment_type') == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Carte" {{ old ('order_payment_type') == 'Carte' ? 'selected' : '' }}>Carte</option>
                            <option value="Chèque" {{ old ('order_payment_type') == 'Chèque' ? 'selected' : '' }}>Chèque</option>
                        </select>

                        @error('order_payment_type')
                        <div class="invalid-feedback text-danger text-right" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        @csrf
                        <label for="order_currency" class="col-md-5 col-form-label col-form-label">Devise <span class="text-danger">*</span></label>
                        <select class="form-control @error('order_currency') is-invalid @enderror col-md-7" id="order_currency" name="order_currency" required>
                            <option value="USD" {{ old ('order_currency') == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="CDF" {{ old ('order_currency') == 'CDF' ? 'selected' : '' }}>CDF</option>
                            <option value="EUR" {{ old ('order_currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                        </select>

                        @error('order_currency')
                        <div class="invalid-feedback text-danger text-right" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        @csrf
                        <label for="order_designation" class="col-md-5 col-form-label col-form-label">Désignation <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('order_designation') is-invalid @enderror col-md-7" id="order_designation" name="order_designation" cols="30" rows="2" required>{{ old ('order_designation') }}</textarea>

                        @error('order_designation')
                        <div class="invalid-feedback text-danger text-right" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Valider la Commande</button>
        </form>
    </div>
</div>
</div>

@endsection
