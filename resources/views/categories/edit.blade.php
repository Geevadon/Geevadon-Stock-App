@extends('layouts.default')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Gestion de Catégories</h1>
        <a href="{{ route ('categories.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> Liste de Catégories</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-edit"></i> Edition de la Catégorie - {{ $category->name }}</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route ('categories.update', $category->id) }}" novalidate>
                <div class="form-row">
                    <div class="col-md-10 mx-auto">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"" id="category_name" name="category_name" placeholder="Tapez le nom de la catégorie" value="{{ old ('category_name') ?: $category->name }}" required>

                            @error('category_name')
                                <div class="invalid-feedback text-danger" role="alert">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-check"></i> Mettre à Jour
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
