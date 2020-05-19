@php
$title = env('APP_NAME');
@endphp

@extends('layouts.app')

@section('content')

<div class="justify-content-center jumbotron jumbotron-fluid jumbotron-hero" >
    {{-- style="position:relative; height:100vh; background: url('./img/sample_meshi.jpg') center center; background-size: cover;" --}}
    <div class="container h-100">


        <h1 class="display-1 text-light">Jet Meshi</h1>


        <p class="lead col-md-8 text-light">今すぐ食べたいを叶える</ｐ>


      <div class="row justify-content-around align-content-end h-75" style= "bottom: 0;">
        {{-- <div class="col-4"> --}}
          <button id="post_button" class="btn rounded-circle"
          style="width: 100px; height: 100px;">投稿する</button>
        {{-- </div> --}}
        {{-- <div class="col-4"> --}}
          <button id="show_button" class="btn rounded-circle"
          style="width: 100px; height: 100px;">飯を見る</button>
        {{-- </div> --}}
    </div>


    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
</div>
<script src=" {{ asset('js/top.js') }} "></script>
@endsection
