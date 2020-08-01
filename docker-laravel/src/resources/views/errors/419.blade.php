@extends('layouts.error')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="code">
            419
        </div>

        <div class="message" style="padding: 10px;">
            セッションが切れています。<a href="{{ url('login') }}">再度ログイン</a>してください。
        </div>
    </div>
@endsection
