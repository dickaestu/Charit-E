<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CHARIT-E</title>

  	<!-- Jquery Slim JS -->
      <script src="{{url('donasi_assets/assets/js/jquery-3.2.1.slim.min.js')}}"></script>
      <!-- Bootstrap JS -->
        <script src="{{url('donasi_assets/assets/js/bootstrap.min.js')}}"></script>
        <!-- Custom JS -->
        <script src="{{url('donasi_assets/assets/js/custom.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

   	<!-- Bootstrap CSS -->
       <link rel="stylesheet" href="{{url('donasi_assets/assets/css/bootstrap.min.css')}}">
    <!-- Style CSS -->
           <link rel="stylesheet" href="{{url('donasi_assets/assets/css/style.css')}}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" 
                @if ($item->role == 'POSKO')
                href="{{ url('posko/info-posko') }}"
                @elseif($item->role == 'ADMIN')
                href="{{ route('dashboard') }}"
                @elseif($item->role == 'LOGISTIK')
                href="{{ route('dashboard-logistik') }}"
                @else
                href="{{ url('/') }}"
                @endif>
                    <img src="{{url('donasi_assets/assets/img/logo.png')}}" width="200" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
