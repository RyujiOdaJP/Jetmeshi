<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/js/jquery-3.5.1.min.js')}}"></script> --}}
    <script src="{{ asset('js/infinite-scroll.pkgd.min.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-Offcanvas.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-white shadow-sm">

          <div id="inside_nav" class="container">
                <a class="navbar-brand mb-1" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <img src={{ asset('images/logo3.png') }}  height="35" alt="">
                </a>
                <button type="button" class="navbar-toggler offcanvas-toggle mr-1"
                data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas"
                aria-controls="js-bootstrap-offcanvas"
                aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar-offcanvas
                navbar-offcanvas-touch navbar-offcanvas-right navbar-light bg-white"
                role="navigation" id="js-bootstrap-offcanvas">
                    <!-- Left Side Of Navbar -->
                    <ul id="nav-for-mobile-top" class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/post') }}"><i class="fas fa-search"></i>{{ __(' 投稿を見る') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('') }}"><i class="fas fa-heart"></i>{{ __(' いいねリスト') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('') }}"><i class="fas fa-info-circle"></i>{{ __(' アプリについて') }}</a>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul id="nav-for-mobile-bottom" class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>{{ __(' ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user"></i>{{ __(' アカウント作成') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
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
