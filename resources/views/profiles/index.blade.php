@extends('layouts.default')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-user"></i>&nbsp; Mon Profil</h6>
        </div>
        <div class="card-body mx-auto text-center">
            <img width="250px" height="250px" class="rounded-circle" src="{{ asset ($user->profile->photo) }}">

            <div class="mt-3 font-weight-bold h4">{{ $user->name }}</div>
            <div class="mt-3 font-weight-bold h6">{{ $user->email }}</div>
            @if ($user->profile->sex)
                <div class="mt-3 font-weight-bold h6">Sexe : {{ $user->profile->sex == 'M' ? 'Masculin' : ($user->profile->sex == 'F' ? 'Féminin' : '') }}</div>
            @endif
            <hr>
            <div class="mt-3 font-weight-bold h6"><u>Description</u></div>
            <div class="mt-3 font-weight-light h6">{{ $user->profile->description }}</div>
            <hr>
            <a href="{{ route ('profile.edit', $user->id) }}" class="btn btn-primary mt-1">Modifier mon Profil</a>
        </div>
    </div>
@endsection
