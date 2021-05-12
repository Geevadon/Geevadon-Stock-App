@extends('layouts.auth')

@section('content')

<div class="container-fluid mt-5">

    <!-- 404 Error Text -->
    <div class="text-center">
      <div class="error mx-auto" data-text="404">404</div>
      <p class="lead text-gray-800 mb-5">Page Introuvable</p>
      <p class="text-gray-500 mb-0">Il semblerait que la page à laquelle vous souhaitez accéder n'existe pas...</p>
      <a href="{{ route ('page.dashboard') }}">&larr; Revenir au Tableau de bord</a>
    </div>

  </div>
@endsection
