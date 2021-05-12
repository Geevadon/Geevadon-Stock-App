<!DOCTYPE html>
<html lang="{{ config ('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config ('app.name') }}</title>
    <link href="{{ asset ('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/sb-admin-2.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
      <div class="container mt-5">
           <div class="row">
               <div class="col-md-12 mx-auto">
                    @yield('content')
               </div>
           </div>
      </div>
</body>
</html>
