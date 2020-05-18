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
    {{-- <script src="{{ asset('js/bootstrap.js') }}" defer></script> --}}
    {{-- <script src="{{ asset('js/jquery-3.5.1.min.js')}}"></script> --}}
    <script src="{{ asset('js/myscript.js')}}"></script>
    <script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script>
    <script src="{{ asset('js/infinite-scroll.pkgd.min.js')}}"></script>
    {{-- <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> --}}
    {{-- <script src="//code.jquery.com/mobile/1.5.0-alpha.1/jquery.mobile-1.5.0-alpha.1.min.js"></script> --}}
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
                <button id="nav-button" type="button" class="navbar-toggler mr-1 not-clicked"
                data-toggle="button" data-target="#js-bootstrap-offcanvas"
                aria-controls="js-bootstrap-offcanvas"
                aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-light bg-white navbar-collapse navbar-offcanvas
                navbar-offcanvas-right out"
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

<script type="text/javascript">
jQuery(function swipeMenu() {
	$("main").bind("touchstart", onTouchStart);
	$("main").bind("touchmove", onTouchMove);
    $("main").bind("touchend", onTouchEnd);


    $("#nav-button").on("click", function(){
      if ($("#nav-button").hasClass('not-clicked')) {
        $("#js-bootstrap-offcanvas").removeClass('out').addClass('in');
        $("#nav-button").removeClass('not-clicked').addClass('clicked');
        return;
      }
      if ($("#nav-button").hasClass('clicked')) {
        $("#js-bootstrap-offcanvas").removeClass('in').addClass('out');
        $("#nav-button").removeClass('clicked').addClass('not-clicked');
      }
    });

	let status = [], position;

	//スワイプ開始時の横方向の座標を格納
	function onTouchStart(event) {
	    startPosition = getPosition(event);
	}

	//スワイプの方向を取得(数値でトリガー感度を調節)
	function onTouchMove(event) {
        if(startPosition < getPosition(event) + 15){
            status = ['in', 'out', 'clicked', 'not-clicked',];
        }else{
            status = ['out', 'in', 'not-clicked', 'clicked',];
        }

	}

	//スワイプ終了時にstatusをクラス名に指定
	function onTouchEnd(event) {
        $("#js-bootstrap-offcanvas").removeClass(status[0]).addClass(status[1]);
        $('#nav-button').removeClass(status[2]).addClass(status[3]);
	}

	//横方向の座標を取得
	function getPosition(event) {
        console.log('swipingNow');
        let position = event.originalEvent.touches[0].pageX
        console.log(-position);
		return position;
	}
});
</script>
</body>
</html>
