<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} @yield('titulo')</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        
        @yield('css_before')

           {{-- styles  --}}
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        @yield('css_after')
        
        @yield('css_datatable')

    </head>
    <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom:30px">
            <a class="navbar-brand" href="{{route('parameter.index')}}">{{config('app.name', 'Laravel')}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('parameter.index')}}">Listado Parametros<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="">Agregar Parametro</a>
                  </li>
                </ul>
            </div>
        </nav>

        @yield('content')
        
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
        
        <script src="{{ asset('js/app.js')}}"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

        
        @yield('js_after')

    </body>
</html>