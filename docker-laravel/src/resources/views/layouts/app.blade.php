@php
    // $app_like = new App\Like;
    $app_post = new App\Post;
    $user = new App\User;
@endphp

<!doctype html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/toggler.js') }}"></script>
    <script src="{{ asset('js/lib/infinite-scroll.pkgd.min.js') }}"></script>
    {{-- <script src="{{ asset('js/lib/croppie.js') }}"></script> --}}
    <script src="{{ asset('js/likes-ajax.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('css/bootstrap-Offcanvas.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/croppie.css') }}" > --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="ModalScrollable" tabindex="-1" role="dialog" aria-labelledby="ModalScrollableLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalCenteredLabel">いいねリスト</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="like-list">
                        @foreach ($user->liked_posts_by_user(null) as $liked_post_id)
                        <li id="{{ 'list_' . $liked_post_id['post_id'] }}" class="list-group-item">
                            <img src={{ $app_post->post_thumbnail($liked_post_id) }} alt="thumbnail"
                                class="thumbnail" style="width: 50px;">
                            <a href="{{ url('post/' . $liked_post_id['post_id']) }}">
                                {{ '  ' . $app_post->post_title($liked_post_id) }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- declare swipe senser -->
    　<div id="swipe-aria" class="standby true"></div>

    <nav class="navbar navbar-expand-md fixed-top navbar-light bg-white shadow-sm">
        <div id="inside_nav" class="container">
            <a class="navbar-brand mb-1" href="{{ url('/') }}">
                {{-- {{ config('app.name', 'Laravel') }} --}}
                <img src={{ asset('images/logo3.png') }} height="35" alt="">
            </a>
            <button id="nav-button" type="button" class="navbar-toggler mr-1 not-clicked" data-toggle="button"
                data-target="#js-bootstrap-offcanvas" aria-controls="js-bootstrap-offcanvas" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-light bg-white navbar-collapse navbar-offcanvas
            navbar-offcanvas-right out" role="navigation" id="js-bootstrap-offcanvas">
                <!-- Left Side Of Navbar -->
                <ul id="nav-for-mobile-top" class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/post') }}"><i class="fas fa-search"></i>{{ __(' 飯を見る') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/post/create') }}"><i
                                class="fas fa-arrow-alt-circle-up"></i>{{ __(' 投稿する') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" data-toggle="modal" data-target="#ModalScrollable"><i
                                class="fas fa-heart"></i>{{ __(' いいねリスト') }}</a>
                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul id="nav-for-mobile-bottom" class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i
                                class="fas fa-sign-in-alt"></i>{{ __(' ログイン') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i
                                class="fas fa-user"></i>{{ __(' アカウント作成') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown"> {{-- // TODO: fix drop down menu to behave properly --}}
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('user/' . Auth::id()) }}">{{ __('ユーザ画面') }}</a>
                            <a class="dropdown-item" href="{{ url('changepassword') }}">{{ __('パスワード変更') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                {{ __('ログアウト') }}
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
    <footer>
        <div class="container text-center text-dark">
            <ul class="nav justify-content-md-center">

                <li class=" nav-item"><a class="nav-link" href="{{ url('') }}"><i
                            class="fas fa-info-circle"></i>{{ __(' アプリについて') }}</a></li>
                <li class=" nav-item"><a class="nav-link" href="{{ url('') }}"><i
                            class="fas fa-info-circle"></i>{{ __('プライバシーポリシー') }}</a></li>
            </ul>
            <div class="col-12 nav-item"><a class="nav-link">© 2020 RyujiOdaJP, All rights reserved</a></div>
        </div>
    </footer>

</body>

</html>
