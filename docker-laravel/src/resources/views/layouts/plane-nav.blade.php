<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-Offcanvas.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-white shadow-sm h-10">

          <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
          </div>
        </nav>
        {{--Flash message--}}
        @if (session('my_status'))
        <div class="container mt-2">
            <div class="alert alert-success">
                {{ session('my_status') }}
            </div>
        </div>
        @endif
        {{-- <main class="py-4"> --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="py-4">
         <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p>© 2020 RyujiOdaJP, All rights reserved</p>
                </div>
            </div>
         </div>
        </footer>
    </div>

</body>
</html>
