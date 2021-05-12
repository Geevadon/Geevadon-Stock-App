@extends('layouts.default')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Gestion de Catégories</h1>
        <a href="{{ route ('categories.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Nouvelle Catégorie</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-list"></i> Liste de Catégories</h6>
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
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ ++$n }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{!! $category->status == 'not_used' ? "<span class='text-danger font-weight-bold'>Inactif</span>" : "<span class='text-success font-weight-bold'>Actif</span>" !!}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                        </button>
                                        <div class="dropdown-menu border border-dark" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ route ('categories.edit', $category->id)}}"><i class="fa fa-edit"></i> Editer</a>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route ('categories.destroy', $category->id)}}" method="POST" id="delete-form-{{ $category->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item delete" did="{{ $category->id }}">
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
