<!DOCTYPE html>
<html lang="{{ config ('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link rel="icon" type="image/png" href="{{ asset ('images/favicon.png') }}">

  <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
    <link href="{{ asset ('css/sb-admin-2.css') }}" rel="stylesheet">

   {{-- Hide some elements on print screen --}}

   <style>

       @media print {
            .to-hide, .print {
                  visibility: hidden;
            }
        }

   </style>

</head>
<body>
    <div class="container mt-3">
        @yield('content')
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    @include('layouts.partials._print-script');
</body>
</html>
