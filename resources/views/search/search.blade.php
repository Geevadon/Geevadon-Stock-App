@extends('layouts.default')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Mot-clé : {{ $query ?: 'aucun' }}</h1>
        <a href="{{ route ('products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Tous les Produits</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-list"></i> Résultat(s) de la recherche</h6>
        </div>
        <div class="card-body">
            @if ($products == null)
                <h5>Aucun résultat pour votre recherche...</h5>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Date</th>
                                <th>Catégorie</th>
                                <th>Marque</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Alerte</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $n = 0 ?>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ ++$n }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ date_format (date_create ($product->added_date), 'd/m/Y') }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ number_format ($product->price, 2, ',', '.'). ' $' }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->alert }}</td>
                                    <td>{!! $product->status == 'not_sufficient' ? "<span class='text-danger font-weight-bold'>Critique</span>" : "<span class='text-success font-weight-bold'>Suffisant</span>" !!}</td>
                                    <td>
                                        <div class="dropleft">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                            </button>
                                            <div class="dropdown-menu border border-dark" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ route ('products.edit', $product->id)}}"><i class="fa fa-edit"></i> Editer</a>

                                                <div class="dropdown-divider"></div>

                                                <a class="dropdown-item" href="{{ route ('products.stock.supply.edit', $product->id)}}"><i class="fa fa-plus"></i> Approvisionner</a>

                                                <div class="dropdown-divider"></div>

                                                <form action="{{ route ('products.destroy', $product->id)}}" method="POST" id="delete-form-{{ $product->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item delete" did="{{ $product->id }}">
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
            @endif
        </div>
    </div>
@endsection
