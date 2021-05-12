@extends('layouts.default')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Gestion de Produits</h1>
        <a href="{{ route ('products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Liste de Produits</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit"></i> Edition du Produit - {{ $product->name }}</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route ('products.update', $product->id) }}" novalidate>
                <div class="form-row">
                    <div class="col-md-6 px-3">

                        <div class="form-group row">
                            @csrf
                            @method('PATCH')
                            <label for="product_added_date" class="col-md-4 col-form-label col-form-label">Date d'entrée <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('product_added_date') is-invalid @enderror col-md-8" id="product_added_date" name="product_added_date" value="{{ old ('product_added_date') ?: $product->added_date }}" required>

                            @error('product_added_date')
                                <div class="invalid-feedback text-danger text-right" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label col-form-label">Nom du Produit <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror col-md-8" id="product_name" name="product_name" value="{{ old ('product_name') ?: $product->name }}" required>

                            @error('product_name')
                                <div class="invalid-feedback text-danger text-right" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="product_category" class="col-md-4 col-form-label col-form-label">Catégorie <span class="text-danger">*</span></label>
                            <select type="text" class="form-control @error('product_category') is-invalid @enderror col-md-8" id="product_category" name="product_category" value="{{ old ('product_category') }}" required>
                                <option value="" selected>Sélectionner...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old ('product_category') == $category->id || $category->id == $product->category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @error('product_category')
                                <div class="invalid-feedback text-danger text-right" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-6 px-3">

                        <div class="form-group row">
                            <label for="product_brand" class="col-md-4 col-form-label col-form-label">Marque <span class="text-danger">*</span></label>
                            <select type="text" class="form-control @error('product_brand') is-invalid @enderror col-md-8" id="product_brand" name="product_brand" value="{{ old ('product_brand') }}" required>
                                <option value="" selected>Sélectionner...</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old ('product_brand') == $brand->id || $brand->id == $product->brand->id ? 'selected' : ''}}>{{ $brand->name }}</option>
                                @endforeach
                            </select>

                            @error('product_brand')
                                <div class="invalid-feedback text-danger text-right" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        {{-- <div class="form-group row">
                            <label for="product_price" class="col-md-4 col-form-label col-form-label">Prix du Produit <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('product_price') is-invalid @enderror col-md-8" id="product_price" name="product_price" value="{{ old ('product_price') ?: $product->price }}" required>

                            @error('product_price')
                                <div class="invalid-feedback text-danger text-right" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="product_quantity" class="col-md-4 col-form-label col-form-label">Quantité <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('product_quantity') is-invalid @enderror col-md-8" id="product_quantity" name="product_quantity" value="{{ old ('product_quantity') ?: $product->quantity }}" required>

                            @error('product_quantity')
                                <div class="invalid-feedback text-danger text-right" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div> --}}

                        <div class="form-group row">
                            <label for="product_alert" class="col-md-4 col-form-label col-form-label">Stock d'alerte</label>
                            <input type="number" class="form-control @error('product_alert') is-invalid @enderror col-md-8" id="product_alert" name="product_alert" value="{{ old ('product_alert') ?: $product->alert }}" placeholder="5">

                            @error('product_alert')
                                <div class="invalid-feedback text-danger text-right" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Valider</button>
                </div>
            </form>
        </div>
    </div>

@endsection
