@extends('layouts.default')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Historique des Approvisionnements</h1>
        <a href="{{ route ('products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Liste de Produits</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-list"></i> Historique</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Nom du Produit</th>
                            <th>Quantité</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $n = 0 ?>
                        @foreach ($products_history as $product_history)
                            <tr>
                                <td>{{ ++$n }}</td>
                                <td>{{ date_format (date_create ($product_history->created_at), 'd/m/Y à H:i') }}</td>
                                <td>{{ $product_history->product_name }}</td>
                                <td>{{ $product_history->product_quantity }}</td>
                                <td>
                                    <div class="dropup">
                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                        </button>
                                        <div class="dropdown-menu border border-dark" aria-labelledby="dropdownMenuButton">

                                            <form action="{{ route ('product-history.destroy', $product_history->product_id)}}" method="POST" id="delete-form-{{ $product_history->product_id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item delete" did="{{ $product_history->product_id }}">
                                                    <i class="fa fa-trash"></i> Supprimer
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
