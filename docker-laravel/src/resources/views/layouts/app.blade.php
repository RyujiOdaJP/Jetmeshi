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
    <script src="{{ asset('js/js/infinite-scroll.pkgd.min.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="drawer drawer--right">
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm drawer-nav">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler drawer-toggle drawer-hamburger" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav drawer-menu mr-auto">
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
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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
