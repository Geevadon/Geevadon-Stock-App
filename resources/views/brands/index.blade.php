@extends('layouts.default')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Gestion de Marques</h1>
        <a href="{{ route ('brands.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Nouvelle Marque</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-list"></i> Liste de Marques</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $n = 0 ?>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ ++$n }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{!! $brand->status == 'not_used' ? "<span class='text-danger font-weight-bold'>Inactif</span>" : "<span class='text-success font-weight-bold'>Actif</span>" !!}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                        </button>
                                        <div class="dropdown-menu border border-dark" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route ('brands.edit', $brand->id)}}"><i class="fa fa-edit"></i> Editer</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route ('brands.destroy', $brand->id)}}" method="POST" id="delete-form-{{ $brand->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item delete" did="{{ $brand->id }}">
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
