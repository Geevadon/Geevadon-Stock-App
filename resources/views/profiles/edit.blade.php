@extends('layouts.default')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h6 class="font-weight-bold text-primary"><i class="fa fa-edit"></i>&nbsp; Edition du Profil</h6>
            </div>
            <div class="col-md-6 text-right">
                <h6 class="m-0 font-weight-bold text-primary d-none d-sm-inline-block"><i class="fa fa-arrow-left"></i> <a href="{{ route ('profile.index') }}">Revenir au Profil</a></h6>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h5>Modifier le Mot de Passe</h5>
                <form method="POST" action="{{ route ('profile.change.password') }}" class="mt-3" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <div class="small mb-2">Laissez les champs vides si vous ne comptez pas modifier le mot de passe.</div>
                        <input type="password" name="old_password" id="old_password" class="form-control @error ('old_password') is-invalid @enderror" value="{{ old ('old_password') }}" placeholder="Ancien mot de passe...">

                        @error ('old_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control @error ('password') is-invalid @enderror" value="{{ old ('password') }}" placeholder="Nouveau mot de passe...">

                        @error ('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error ('password_confirmation') is-invalid @enderror" value="{{ old ('password_confirmation') }}" placeholder="Confirmer le mot de passe...">

                        @error ('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Modifier</button>
                </form>

                @if (auth ()->user ()->email == 'admin@admin.com')
                    <h5 class="mt-5 mb-3">Gestion des Utilisateurs</h5>

                    <a href="{{ route ('users.create') }}" type="submit" class="btn btn-primary btn-block delete mb-4"><i class="fa fa-plus"></i> Créer un utilisateur</a>

                    <form method="POST" action="{{ route ('users.delete.user') }}" class="mt-3" id="delete-user-form" novalidate>
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <div class="small mb-2">Séléctionner un utilisateur, puis cliquez sur le bouton de suppression pour le supprimer.</div>
                            <select name="user_id" id="user_id" class="form-control @error ('user_id') is-invalid @enderror" value="{{ old ('user_id') }}" placeholder="Ancien mot de passe...">
                                <option value="">Sélectionner...</option>
                                @foreach ($users as $user)
                                    @if ($user->email !='admin@admin.com')
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error ('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger btn-block" id="delete_user">Supprimer</button>
                    </form>
                @endif
            </div>

            <div class="col-md-8">
                <h5>Modifier mes infos</h5>
                <form method="POST" action="{{ route ('profile.update', auth ()->user ()->id) }}" class="mt-3" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Nom (s)</label>
                        <input type="text" name="name" id="name" class="form-control @error ('name') is-invalid @enderror" value="{{ old ('name') ?: auth ()->user ()->name }}">

                        @error ('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error ('email') is-invalid @enderror" value="{{ auth ()->user ()->email }}" {{ auth ()->user ()->email == 'admin@admin.com' ? 'readonly' : ''}}>

                        @error ('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sex">Sexe</label>
                        <select name="sex" id="sex" class="form-control @error ('sex') is-invalid @enderror">
                            <option value="" selected disabled>Choisir...</option>
                            <option value="M" {{ old ('sex') == 'M' ? 'selected' : (auth ()->user ()->profile->sex == 'M' ? 'selected' : '')}}>Masculin</option>
                            <option value="F" {{ old ('sex') == 'F' ? 'selected' : (auth ()->user ()->profile->sex == 'F' ? 'selected' : '')}}>Féminin</option>
                        </select>

                        @error ('sex')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="photo">Photo de profil</label>
                        <div class="custom-file">
                            <input type="file" name="photo" id="photo" class="custom-file-input @error ('photo') is-invalid @enderror" id="customFile" lang="fr" value="{{ old ('photo') }}">
                            <label class="custom-file-label" for="customFile">Sélectionner un fichier...</label>
                        </div>

                        @error ('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control form-control-sm mt-md-3 @error ('description') is-invalid @enderror" id="description" cols="30" rows="6">{{ old ('description') ?: auth ()->user ()->profile->description }}</textarea>

                        @error ('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Mettre à Jour</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
