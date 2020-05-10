@php
$title = env('APP_NAME');
@endphp

@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid" style="position: relative; height: 100vh; background: url('./img/sample_meshi.jpg') center center; background-size: cover;">
    <div class="container">
        {{-- <img class="img-fluid" src="./img/sample_meshi.jpg" alt=""> --}}
      <h1 class="display-1">Fluid jumbotron</h1>
      <p class="lead">This is a modified jumbotron that occupies
                      the entire horizontal space of its parent.</p>
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
</div>

@endsection
