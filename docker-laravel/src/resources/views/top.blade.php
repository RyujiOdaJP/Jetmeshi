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
        <div class="col-4">
          <a href="{{ url('/post/create') }}" id="post_button" class="btn rounded-circle"
          style="width: 100px; height: 100px; "><p style="margin-top: 40%">投稿する</p></a>
        </div>
        {{-- <div class="col-4"> --}}
          <a href="{{ url('/post') }}" id="show_button" class="btn rounded-circle"
          style="width: 100px; height: 100px;"><p style="margin-top: 40%">飯を見る</p></a>
        {{-- </div> --}}
    </div>
    </div>
</div>

<script src=" {{ asset('js/top.js') }} "></script>
@endsection
