@extends('layouts.default')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Gestion de Produits</h1>
        <a href="{{ route ('products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Liste de Produits</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit"></i> Approvisionnement de {{ $product->name }}</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route ('products.stock.supply.update', $product->id) }}" novalidate>
                <div class="form-row">
                    <div class="col-md-10 mx-auto">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="number" class="form-control @error('product_quantity') is-invalid @enderror" id="product_quantity" name="product_quantity" placeholder="Tapez la quantité à approvisionner..." value="{{ old ('product_quantity') }}" required>

                            @error('product_quantity')
                                <div class="invalid-feedback text-danger" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-check"></i> Approvisionner
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
